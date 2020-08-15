<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Modules\CMS\Entities\Page;
use Modules\CMS\Entities\PageType;
use Theme;
use Str;
use Swap2205\LaraCRUD\LaraCRUD;
use Swap2205\LaraCRUD\LaraCRUDCMS;
use Swap2205\LaraCRUD\LaraForm;

class CMSController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    // use GetDatatables;

    public function __construct()
    {
        $this->theme = Theme::uses('admin');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */


    // admin controller - starts
    public function list($type='page')
    {
        $crud = new LaraCRUDCMS();
        // dd(Page::$form_fields);

        $layout_dir = scandir(public_path('themes'.DIRECTORY_SEPARATOR.config('theme.themeDefault').DIRECTORY_SEPARATOR.'layouts'));
        unset($layout_dir[0],$layout_dir[1]);
        $template = [];
        foreach ($layout_dir as $value) {
            // $template[$value] = ucwords(str_replace('_',' ',substr($value,0,strpos($value,'.'))));
            $val = ucwords(str_replace('_',' ',substr($value,0,strpos($value,'.'))));
            $template[$val] = $val;
        }
        // dd($template);
        // $layout_dir = dir(public_path().'\themes\admin\layout');

        $data = $crud->initList(Page::class)->setPageTitle($type)->getFormFields();
        //set custom values to the form data
        $data['template_name']['values'] = $template;
        $data['page_type']['values'] = $type;
        $data['parent_id']['values'] = array_merge($data['parent_id']['values'],array_column(json_decode(Page::select('id','title')->where('page_type',$type)->get(),1),'title','id'));

        $filter = $crud->getFilterColumns();
        $filter['page_type']['values'] = $type;
        $data = $crud->setFormFields($data)->setFilterColumns($filter)->getViewData();

        $data['datatable_url'] = '/admin/cms/list';
        $data['form_submit_url'] = '/admin/cms';

        $this->theme->setTitle(Str::of($type)->plural()->title());
        $this->theme->asset()->serve('datatables');
        $this->theme->asset()->serve('summernote');
        $this->theme->asset()->writeScript('inline-script', '
            $(function() {
                $(".sn_textarea").summernote();
            })', []);

        // $this->theme->asset()->add('cms-js', mix('js/cms.js'));
        return $this->theme->of('cms::cms',$data)->render();
    }
    // admin controller - starts
    public function list_old($type='page')
    {
        // dd(Page::$form_fields);
        $data['page_type'] = $type;
        $formdata = Page::$form_fields;
        $data['view_fields'] = array_column($formdata,'label','name');

        $formdata['parent_id']['values'] = array_column(
            json_decode(Page::select('id','title')->where('page_type',$type)->get(),1),
            'title','id');
        // return($data);
        $data['form_fields'] = crud_form_generator($formdata);
        $data['datatable_columns'] = Page::$dataTable_columns;
        if(isset(Page::$dataTable_action) && !empty(Page::$dataTable_action)){
            $data['datatable_columns'][] = 'Action';
        }
        $this->theme->setTitle(Str::of($type)->plural()->title());
        $this->theme->asset()->serve('datatables');
        // return $this->theme->of('cms::index',$data)->render();
        return $this->theme->of('cms::page',$data)->render();
        //Arr::pluck($array, 'developer.name', 'developer.id');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = Page::where('page_type','news')->first();
        return $page->pageType;
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
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'slug' => 'alpha_dash',
            'content' => 'required',
            'template_name' => 'required',
            'parent_id' => 'required',
            'featured_image' => 'image',
        ]);

        $data['status'] = 1;
        $data['slug'] = empty($request->input('slug')) ? Str::slug($data['title']) : Str::slug($data['slug']);
        $data['page_type'] = $request->input('page_type');
        $data['created_by'] = auth('admin')->user()->id;
        $data['updated_by'] = auth('admin')->user()->id;
        if($request->hasFile('featured_image')){
            $data['featured_image'] = $request->file('featured_image')->store('images','public');
        }
        $cms = Page::create($data);
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
    public function show(Page $page)
    {
        $page->file_exists = Storage::disk('public')->exists($page->featured_image);
        $page->featured_image = Storage::url($page->featured_image);
        return $page;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Page $page)
    {
        // echo (Storage::url($page->featured_image));die;
        $page->file_exists = Storage::disk('public')->exists($page->featured_image);
        $page->featured_image = Storage::url($page->featured_image);
        return $page;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'slug' => 'required|alpha_dash',
            'content' => 'required',
            'template_name' => 'required',
            'parent_id' => 'required',
            'featured_image'=>'image'
        ]);
        if($request->hasFile('featured_image')){
            if(Storage::disk('public')->exists($page->featured_image)){
                Storage::disk('public')->delete($page->featured_image);
            }
            $page->featured_image = $request->file('featured_image')->store('images','public');
        }
        $page->title = $data['title'];
        $page->meta_keywords = $data['meta_keywords'];
        $page->meta_description = $data['meta_description'];
        $page->slug = $data['slug'];
        $page->content = $data['content'];
        $page->template_name = $data['template_name'];
        $page->parent_id = $data['parent_id'];
        $page->status = 1;
        $page->page_type = $request->input('page_type');
        $page->updated_by = auth('admin')->user()->id;

        $stat = $page->save();
        return ['status'=>$stat];
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
        $query = Page::select('id');
        // $query = $this->get_filters($query);
        $query = $query->with('pageType');
        $crud = new LaraCRUDCMS();
        $result = $crud->initDatatable(Page::class)->getDataTable($query);

        return $result;
    }

    // custom datatable filters - controller specific - to be used with the GetDatatables Trait
    protected function get_filters($query){
        /* if(request()->input('page_type')){
            $query = $query->where('page_type',request()->input('page_type'));
        } */
        return $query;
    }

}
