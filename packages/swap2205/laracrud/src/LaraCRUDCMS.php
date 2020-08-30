<?php

namespace Swap2205\LaraCRUD;

use Swap2205\LaraCRUD\GetDatatables;

class LaraCRUDCMS{

    use GetDatatables;

    protected $model;
    protected $selectColumns;
    protected $filterColumns;
    protected $tableColumns;
    protected $formFields;
    protected $viewFields;
    protected $pageTitle;

    public function setModel($model){
        $this->model = $model;
        return $this;
    }

    public function getModel(){
        return $this->model;
    }

    public function setFormFields($formFields){
        $this->formFields = $formFields;
        //dd($this);
        return $this;
    }

    public function getFormFields(){
        return $this->formFields;
    }

    public function setViewFields($viewFields){
        $this->viewFields = $viewFields;
        return $this;
    }

    public function getViewFields(){
        return $this->viewFields;
    }

    public function setTableColumns($tableColumns){
        $this->tableColumns = $tableColumns;
        return $this;
    }

    public function getSelectColumns(){
        return $this->selectColumns;
    }

    public function setSelectColumns($tableColumns){
        $this->selectColumns = $tableColumns;
        return $this;
    }

    public function getTableColumns(){
        return $this->tableColumns;
    }

    public function setSearchColumns($searchColumns){
        $this->searchColumns = $searchColumns;
        return $this;
    }

    public function setFilterColumns($filterColumns){
        $this->filterColumns = $filterColumns;
        return $this;
    }

    public function getFilterColumns(){
        return $this->filterColumns;
    }

    public function setPageTitle($pageTitle){
        $this->pageTitle = $pageTitle;
        return $this;
    }

    public function getPageTitle(){
        return $this->pageTitle;
    }

    public function setTableAction(){
        if(isset($this->model::$dataTable_action)){
            $action = $this->model::$dataTable_action;
            unset($action['add']);
            if(!empty($action)){
                array_push($this->tableColumns,'Action');
            }
        }
    }

    public function initList($model){
        $this->setModel($model);
        $this->setFormFields($this->model::$form_fields);
        $this->setFilterColumns($this->model::$dataTable_filters);
        $this->setTableColumns($this->model::$dataTable_columns);
        $this->setTableAction();
        $this->setViewFields(array_column($this->formFields,'label','name'));
        return $this;
    }

    public function initDatatable($model){
        $this->setModel($model);
        $this->setTableColumns($this->model::$dataTable_columns);
        $this->setSelectColumns($this->model::$dataSelect_columns);
        $this->setFilterColumns($this->model::$dataTable_filters);
        $this->setSearchColumns(array_keys($this->model::$dataTable_filters));
        return $this;
    }

    public function getList(){
        // return view('laracrud::index');
        return [
            'view_fields'=>$this->getViewFields(),
            'form_fields'=>$this->getFormFields(),
            'datatable_columns'=>$this->getTableColumns(),
        ];
    }

    public function getViewData(){
        return  [
            'view_fields'=>$this->getViewFields(),
            'form_fields'=>LaraForm::get_form($this->getFormFields()),
            'datatable_columns'=>$this->getTableColumns(),
            'page_title'=>$this->getPageTitle(),
            'filter_data'=>LaraForm::get_form($this->getFilterColumns(),'col-sm-3'),
            'has_add'=>isset($this->model::$dataTable_action['add'])
        ];



    }

    public function getDataTable($query){
        $columns = array_keys($this->tableColumns);
        // initiate the query here

        foreach (array_keys($this->selectColumns) as $col) {
            $query = $query->addSelect($col);
        }

        //get the result from trait
        $result = $this->get_data_query($query);
            // dd($result);
        $data = [];
        //populate the datatable results
        foreach ($result['result'] as $key => $value) {
            $row = [];
            foreach (array_keys($this->tableColumns) as $col) {
                if($col=='page_type'){
                    $col = 'pageType->title';
                }
// // echo $col;continue;
                if(count(explode('->', $col))>1){
                    $col_val = $value;
                    foreach(explode('->', $col) as $itm) {
                        $col_val = $col_val->$itm;
                    }
                    $row[] = $col_val;

                }else{
                    $row[] = $value->$col;
                }// dd($value);
            }
            //check for action
            $data_action = isset($this->model::$dataTable_action) ? $this->model::$dataTable_action : [];
            unset($data_action['add']);
            $action = '';
            if(isset($data_action['view']))
            {
                $action .= "<a href='javascript:void(0);' onclick='crud_view({$value->id})' class='btn btn-sm btn-info'><i class='fa fa-eye'></i></i> {$data_action['view']}</a>";
            }
            if(isset($data_action['edit']))
            {
                $action .= " <a href='javascript:void(0);' onclick='crud_edit({$value->id})' class='btn btn-sm btn-primary'><i class='fa fa-pen'></i></i> {$data_action['edit']}</a>";
            }
            if(isset($data_action['delete']))
            {
                $action .= " <a href='javascript:void(0);' onclick='crud_delete({$value->id})' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></i> {$data_action['delete']}</a>";
            }
            if(!empty($data_action)){
                $row[] = $action;
            }

            $data[] = $row;
        }

        return [
            "draw"=>intval(request()->input('draw')),
            "recordsTotal"=>intval($result['total_results']),
            "recordsFiltered"=>intval($result['total_results']),
            "data"=>$data
        ];
    }

    public function get_filters($query)
    {
        foreach ($this->getFilterColumns() as $key => $value) {
            # code...
            if(request()->input($key)!=''){
                $query = $query->where($key,request()->input($key));
            }
        }
        return $query;
    }
}
