<?php
    function get_message($msg){
        return $msg;
    }

    function get_dataTable($url,$columns){
        $output = '<div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped table-sm datatable"
                data-url="'.$url.'">
                <thead>
                    <tr>';
                    foreach ($columns as $item)
                        {$output .= "<th>{$item}</th>";}

            $output .= '</tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                <tr>';
                foreach ($columns as $item)
                    {$output .= "<th>{$item}</th>";}

        $output .= '</tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>';
    return $output;
    }

    function crud_form_generator($data){
        $output = '';
        foreach ($data as $form) {
            switch ($form['element']) {
                case 'input':
                    if($form['type']!='hidden'){
                    $output.='<div class="form-group row">
                    <label for="crud_input_'.$form['name'].'" class="col-sm-2 col-form-label">'.$form['label'].'</label>
                    <div class="col-sm-10">
                        <input type="'.$form['type'].'" class="form-control" name="'.$form['name'].'" id="crud_input_'.$form['name'].'"
                            placeholder="'.$form['label'].'">
                        <span class="error invalid-feedback"></span>
                    </div>
                </div>';
                    }
                    else{
                        $output.= '<input type="'.$form['type'].'" name="'.$form['name'].'" id="crud_input_'.$form['name'].'"
                        placeholder="'.$form['label'].'" value="'.$form['value'].'">';
                    }
                    break;

                case 'textarea':
                    $output.='<div class="form-group row">
                    <label for="crud_input_'.$form['name'].'" class="col-sm-2 col-form-label">'.$form['label'].'</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="'.$form['name'].'" id="crud_input_'.$form['name'].'"
                            placeholder="'.$form['label'].'"></textarea>
                        <span class="error invalid-feedback"></span>
                    </div>
                </div>';
                    break;

                case 'select':
                    $output.='<div class="form-group row">
                    <label for="crud_input_'.$form['name'].'" class="col-sm-2 col-form-label">'.$form['label'].'</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="'.$form['name'].'" id="crud_input_'.$form['name'].'"
                            placeholder="'.$form['label'].'">';
                            $output.= '<option value="">Select '.$form['label'].'</option>';
                                foreach ($form['values'] as $key => $value) {
                                    $output.= '<option value="'.$key.'">'.$value.'</option>';
                                }
                            $output.= '</select>
                        <span class="error invalid-feedback"></span>
                    </div>
                </div>';
                    break;

                default:
                    # code...
                    break;
            }
        }
        return $output;
    }


