<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Process_details extends BaseController {
	public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_field_model','process_model','processes/process_delete_model'));
    $this->redirect_after_save = 'view';
  }  

  public function delete($id) {
    $select_fields = 'process_id,out_weight,daily_drawer_wastage,melting_wastage,hcl_wastage,ghiss,wastage_au_fe,hook_in,hook_out,tounch_in,gemstone_in,gemstone_out,fe_in,
                      hcl_ghiss,daily_drawer_out_weight,daily_drawer_in_weight,pending_ghiss,loss,in_melting_wastage,customer_out,factory_out,recutting_out,
                      karigar_loss,gpc_out';
    $process_detail = $this->model->find($select_fields,array('id'=>$id));
    $process_id = $process_detail['process_id'];
    unset($process_detail['process_id']);
    foreach ($process_detail as $field => $value) {
      if($value == 0) unset($process_detail[$field]);
    }
    $next_process = $this->process_model->find('id',array('parent_process_detail_id'=>$id));
    if (!empty($next_process)) {
      redirect($_SERVER['HTTP_REFERER']);
      return FALSE;
    }
    $this->model->delete('',array('id'=>$id));
    foreach ($process_detail as $field_name => $field_value) {
      $processes_field = $this->model->find('sum('.$field_name.') as total_weight',array('process_id'=>$process_id));
      $data['id'] = $process_id;
      $data[$field_name] = $processes_field['total_weight'];
      $processes_obj = new process_delete_model($data);
      $processes_obj->before_validate();
      $processes_obj->save(false);
      $this->process_model->compute_process($process_id);
    }
    redirect($_SERVER['HTTP_REFERER']);
  }
}
?>