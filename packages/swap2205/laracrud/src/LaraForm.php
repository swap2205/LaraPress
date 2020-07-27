<?php

namespace Swap2205\LaraCRUD;

class LaraForm{
    public static function input($type,$name,$val='',$attributes=[]){

    }

    public static function dropdown($name,$val='',$attributes=[]){

    }

    public static function textarea($name,$val='',$attributes=[]){

    }

    public static function get_form($formData,$type='row'){
            $output = '';
            foreach ($formData as $form) {
                if(!(isset($form['type']) && $form['type']=='hidden')){
                $output.='<div class="form-group '.$type.'">
                        <label for="crud_input_'.$form['name'].'" class="'.($type=='row'? 'col-sm-2 col-form-label':'').'">'.$form['label'].'</label>
                        '.($type=='row'? '<div class="col-sm-8">':'');
                    }
                switch ($form['element']) {
                    case 'input':
                        if($form['type']!='hidden'){
                        $output.='<input type="'.$form['type'].'" class="form-control" name="'.$form['name'].'" id="crud_input_'.$form['name'].'"
                                placeholder="'.$form['label'].'">';
                        }
                        else{
                            $output.= '<input type="'.$form['type'].'" name="'.$form['name'].'" id="crud_input_'.$form['name'].'"
                            placeholder="'.$form['label'].'" value="'.$form['values'].'">';
                        }
                        break;

                    case 'textarea':
                        $output.='<textarea class="form-control sn_textarea" name="'.$form['name'].'" id="crud_input_'.$form['name'].'"
                                placeholder="'.$form['label'].'"></textarea>';
                        break;

                    case 'select':
                        $output.='<select class="form-control" name="'.$form['name'].'" id="crud_input_'.$form['name'].'"
                                placeholder="'.$form['label'].'">';
                                $output.= '<option value="">Select '.$form['label'].'</option>';
                                    foreach ($form['values'] as $key => $value) {
                                        $output.= '<option value="'.$key.'">'.$value.'</option>';
                                    }
                                $output.= '</select>';
                        break;

                    default:
                        # code...
                        break;
                }
                if(!(isset($form['type']) && $form['type']=='hidden')){
                    $output .= ($type=='row'? '</div>
                        <div class="col-sm-2"><span class="error invalid-feedback" id="crud_validate_'.$form['name'].'"></span>
                    </div>':'').'</div>';
                }
            }
            return $output;
        }

        public static function get_filter_form($formData,$type=''){
            //create filter form

        }
}
