<?php

namespace Modules\CMS\Http\Controllers\api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Entities\Admin;
use Modules\CMS\Entities\Page;
use Modules\CMS\Entities\PageType;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($slug)
    {
        $page = PageType::whereSlug($slug)->first();
        if($page){
            $pages = Page::wherePageType($slug)->paginate(3);
            foreach ($pages as $key => $page) {
                $pages[$key]->featured_image = url(Storage::url($page->featured_image));
            }
            return $pages;
        }
        $page = Page::whereSlug($slug)->firstOrFail();
        $page->featured_image = url(Storage::url($page->featured_image));
        return $page;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return Admin::first();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        return ['name'=>$request->name];
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('cms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('cms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    /**
     * API login
     */
    public function login(Request $request){
        $login = $request->validate([
            'email'=> 'required|email',
            'password' => 'required'
        ]);

        if(!auth('admin')->attempt($login)){
            return ['status'=>false, 'message'=>'Invalid Credentials'];
        }

        $accessToken = auth('admin')->user()->createToken('authToken')->accessToken;

        return ['status'=>true, 'message'=>'Logged in Successfully','token'=>$accessToken];
    }
}
