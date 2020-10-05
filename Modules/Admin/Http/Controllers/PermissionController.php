<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Admin;
use Modules\Auth\Entities\AdminPermission;
use Swap2205\LaraCRUD\LaraCRUDCMS;
use Theme;

class PermissionController extends Controller
{
    public function __construct()
    {
        Theme::uses('admin');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(LaraCRUDCMS $crud)
    {
        Theme::setTitle('Admin Permissions')
                    ->asset()->serve('datatables');

        $data = $crud->initList(AdminPermission::class)
                ->setPageTitle("Admin Permissions")
                ->getViewData();

        $data['datatable_url'] = '/admin/permissions/list';
        $data['form_submit_url'] = '/admin/permissions';
//        return $data;
        return Theme::of('admin::permission',$data)->render();
    }

        /**
     * ajax list functionality
     */

    public function ajax_list(LaraCRUDCMS $crud){
        $query = AdminPermission::select('id');
        // $query = $this->get_filters($query);
        $result = $crud->initDatatable(AdminPermission::class)->getDataTable($query);

        return $result;
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=> ['required'],
            'slug'=> ['required','unique:Modules\Auth\Entities\AdminPermission,slug']
        ]);

        $permission = AdminPermission::create($data);
        return ['status'=>true];
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(AdminPermission $permission)
    {
        return $permission;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(AdminPermission $permission)
    {
        return $permission;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, AdminPermission $permission)
    {
        $data = $request->validate([
            'name'=> ['required'],
            'slug'=> ['required']
        ]);

        $permission->name = $request->name;
        $permission->slug = $request->slug;
        $permission->save();
        
        return ['status' => true];
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
}
