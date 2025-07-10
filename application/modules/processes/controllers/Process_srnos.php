<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_srnos extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('refresh/refresh_model', 'processes/process_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('',array('id'=>$id));
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$id;
    $this->data['record']['srno']=!empty($this->data['record']['srno'])?$this->data['record']['srno']:$process['srno'];
    
     parent::edit($id);
  }

  public function _get_form_data() {
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$_POST['id'];
    $processes=$this->process_model->find('',array('id'=>$this->data['record']['id']));
    
  }
  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_srnos']['id'];
  }
}