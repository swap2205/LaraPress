<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CMS\Entities\PageType;
use Swap2205\LaraCRUD\LaraCRUDCMS;
use Theme;
use Str;

class PageTypeController extends Controller
{

    public function __construct()
    {
        $this->theme = Theme::uses('admin');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $crud = new LaraCRUDCMS();
        $pageTitle = 'Page Type';
        //initialise datatable
        $data = $crud->initList(PageType::class)->setPageTitle($pageTitle)->getViewData();

        $data['datatable_url'] = '/admin/page_type/list';
        $data['form_submit_url'] = '/admin/page_type';

        //set the theme data
        $this->theme->setTitle($pageTitle);
        $this->theme->asset()->serve('datatables');

        return $this->theme->of('cms::page_type',$data)->render();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'alpha_dash',
        ]);

        $data['slug'] = empty($request->input('slug')) ? Str::slug($data['title']) : Str::slug($data['slug']);

        $cms = PageType::create($data);
        return [
            'status' => 1,
            'cms'=>$cms
        ];
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(PageType $pageType)
    {
        return $pageType;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(PageType $pageType)
    {
        return $pageType;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, PageType $pageType)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'alpha_dash',
        ]);

        $pageType->slug = empty($request->input('slug')) ? Str::slug($data['title']) : Str::slug($data['slug']);
        $pageType->title = $data['title'];
        $stat = $pageType->save();

        return [
            'status' => $stat,
            'cms'=>$pageType
        ];
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajax_list(Request $request){
        $query = PageType::select('id');
        // $query = $this->get_filters($query);
        $crud = new LaraCRUDCMS();
        $result = $crud->initDatatable(PageType::class)->getDataTable($query);

        return $result;
    }
}
