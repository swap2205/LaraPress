<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\AdminRole;
use Swap2205\LaraCRUD\LaraCRUDCMS;
use Theme;
class RoleController extends Controller
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
        Theme::setTitle('Admin Roles')
                    ->asset()->serve('datatables');

        $data = $crud->initList(AdminRole::class)->setPageTitle("Admin Roles")->getViewData();

        $data['datatable_url'] = '/admin/roles/list';
        $data['form_submit_url'] = '/admin/roles';
//        return $data;
        return Theme::of('admin::role',$data)->render();
    }

    /**
     * ajax list functionality
     */

    public function ajax_list(Request $request){
        $query = AdminRole::select('id');
        // $query = $this->get_filters($query);
        $crud = new LaraCRUDCMS();
        $result = $crud->initDatatable(AdminRole::class)->getDataTable($query);

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
            'slug'=> ['required','unique:Modules\Auth\Entities\AdminRole,slug']
        ]);

        $role = AdminRole::create($data);
        return ['status'=>true];
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(AdminRole $role)
    {
        return $role;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(AdminRole $role)
    {
        return $role;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, AdminRole $role)
    {
        $data = $request->validate([
            'name'=> ['required'],
            'slug'=> ['required']
        ]);

        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->save();

        return ['status'=>true];
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(AdminRole $role)
    {
        //
    }
}
