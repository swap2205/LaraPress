<?php
/*
* We will use this trait to get & set the admin user permissions & roles details
*/
namespace Swap2205\LaraCRUD;

trait GetDatatables{

    public function get_data_query($query){
        $limit = request()->input('length');
        $start = request()->input('start');
        if(request()->input('order.0.column')!=null){
            $order = array_keys($this->tableColumns)[request()->input('order.0.column')];
            $dir = request()->input('order.0.dir');
        }else{
            $order = 'updated_at';
            $dir = 'desc';
        }

        // dd(request()->input('order.0.column'),$order,$dir,array_keys($this->tableColumns));
        $query = $query->offset($start)->limit($limit);
        $query = $this->get_filters($query);

        if(request()->input('search.value')){
            $src_columns = $this->searchColumns;
            $search = request()->input('search.value');
            $query = $query->where(function ($qry) use ($src_columns,$search){
                foreach($src_columns as $col){
                    $qry = $qry->orWhere($col,'LIKE',"%{$search}%");
                }
            });
        }

        $result = $query->orderBy($order,$dir)->get();
        $total = $query->count();

        return [
            'result'=>$result,
            'total_results'=>$total
        ];
    }

    public function get_filters($columns){

    }
}
