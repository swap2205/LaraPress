<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\Page;
use Theme;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Page $page)
    {
        Theme::setTitle($page->title);
        Theme::set('featured_image',$page->featured_image);
        $layout = file_exists(public_path('themes\\'.config('theme.themeDefault').'\layouts\\'.$page->template_name.'.blade.php')) ? $page->template_name : 'layout';
        // return(public_path('themes\\'.config('theme.themeDefault').'\layouts\\'.$page->template_name.'.blade.php'));

        return Theme::view(['view'=>'cms::frontend.page','layout'=>$layout,'args'=>$page]);
    }

    public function home()
    {
        Theme::setTitle('Swapnil | Home')->set('IsHome',true);
        return Theme::view('cms::frontend.index');
    }

}
