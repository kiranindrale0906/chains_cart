<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_customers extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('refresh/refresh_model', 'processes/process_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('',array('id'=>$id));
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$id;
    $this->data['record']['customer_name']=!empty($this->data['record']['customer_name'])?$this->data['record']['customer_name']:$process['customer_name'];
     parent::edit($id);
  }

  public function _get_form_data() {
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$_POST['id'];
  }
  
  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_customers']['id'];
  }
}