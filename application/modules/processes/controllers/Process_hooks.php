<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_hooks extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('refresh/refresh_model', 'processes/process_field_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $id=$this->process_field_model->find('',array('process_id'=>$id))['id'];
     parent::edit($id);
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_hooks']['process_id'];
  }
}