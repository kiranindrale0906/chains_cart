<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_hallmark_in extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('refresh/refresh_model', 'processes/process_field_model'));
    $this->redirect_after_save = 'view';
  }

  public function update($id) {
    if(isset($_GET['from']) && $_GET['from']=='view') {
      $process = $this->model->find('id', array('id' => $id));
      $process['hallmark_in']=$_GET['in_weight'];
      $process['out_weight']=$_GET['in_weight'];
      $process['status']='Pending';
      $process_archive_obj = new $this->model($process);
//	pd($process_archive_obj);
      $process_archive_obj->before_validate();
      $process_archive_obj->save(true);
      redirect($_SERVER['HTTP_REFERER']);
    } else {
      parent::update($id);
    }
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_hallmark_in']['process_id'];
  }
}
