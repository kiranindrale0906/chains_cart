<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_descriptions extends BaseController {
    public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/category_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('',array('id'=>$id));
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$id;
    $this->data['record']['description']=!empty($this->data['record']['description'])?$this->data['record']['description']:$process['description'];
    parent::edit($id);
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_descriptions']['id'];
  }
}