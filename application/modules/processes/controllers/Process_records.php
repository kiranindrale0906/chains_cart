<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_records extends BaseController {
  public function __construct(){
    $this->_model = 'process_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
  }

  public function view($id){
    $this->data['record']['id'] = $id;
    parent::view($id);
  }

  public function _get_view_data(){
    $process_data = $this->process_model->find_process_data($this->data['record']['id']);
   
    $selected_columns = 'id,in_weight,hook_in,fe_in,out_weight,daily_drawer_wastage,melting_wastage,hcl_wastage,tounch_in,loss,ghiss,hcl_ghiss,balance,balance_fine,balance_gross,parent_id,product_name,process_name,department_name';

   
    $process_detail_next = $this->process_model->find($selected_columns,array('parent_id'=>$process_data['id']));
  
    if(isset($process_detail_next['parent_id']))
      $parent_id  = $process_detail_next['parent_id'];
    else{
      $parent_id = $process_data['id'];
    }
    $process_detail_current = $this->process_model->find($selected_columns,array('id'=>$parent_id));
    
    $this->data['process_data'] = array('current_process'=>$process_detail_current,
                                          'next_process'=>$process_detail_next);
    
  }

}