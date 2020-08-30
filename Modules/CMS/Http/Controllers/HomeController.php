<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Modules\CMS\Entities\Page;
use Modules\CMS\Entities\PageType;
use Theme;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($slug)
    {
        $page = PageType::where('slug',$slug)->first();
        // return($page);
        if(!empty($page)){
            
            $pages = Page::where('page_type',$slug)->paginate(2);
            // return($pages);
            if(request()->ajax()){
                $res['data'] = (string)View::make('cms::frontend.page_type_ajax',['pages'=>$pages]);
                $res['paging'] = (string)$pages->links();
                return $res;
            }

            Theme::setTitle($page->title)->set('page_type',$slug);
            Theme::asset()->add('paginate','js/paginate.js',['scripts']);
            return Theme::view(['view'=>'cms::frontend.page_type','layout'=>'sidebar','args'=>['pages'=>$pages]]);
        }
        
        $page = Page::where('slug',$slug)->firstOrFail();
        Theme::setTitle($page->title)->set('page_type',$page->page_type);
        Theme::set('featured_image',$page->featured_image);
        $layout = file_exists(public_path('themes'.DIRECTORY_SEPARATOR.config('theme.themeDefault').DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR.$page->template_name.'.blade.php')) ? $page->template_name : 'layout';
        // return(public_path('themes\\'.config('theme.themeDefault').'\layouts\\'.$page->template_name.'.blade.php'));

        return Theme::view(['view'=>'cms::frontend.page','layout'=>$layout,'args'=>$page]);
    }

    public function home()
    {
        Theme::setTitle('Swapnil | Home')->set('IsHome',true);
        return Theme::view('cms::frontend.index');
    }

    public function contact(){
        Theme::setTitle('Contact Us')->set('IsHome',false);
        return Theme::view('cms::frontend.contact');
    }

    public function send_email(Request $req)
    {
        $req->validate(['email' => "required|email:rfc,dns"]);
        $data = [
            "user" => "swapnil",
            "title" => "Hey!! Welcome to LaraPress!!",
            "msg" => "Thanks for subscribing with LaraPress!!",
        ];
        Mail::send('cms::emails.email1', $data, function ($message) {
            // $message->from('john@johndoe.com', 'John Doe');
            // $message->sender('john@johndoe.com', 'John Doe');
            $message->to('john@johndoe.com', 'John Doe');
            $message->cc('john@johndoe.com', 'John Doe');
            $message->bcc('john@johndoe.com', 'John Doe');
            $message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Welcome to LaraPress!!');
        });
        return redirect('/contact')->with('message','Email Sent');
    }
}