<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_chain_names extends BaseController {
    public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('',array('id'=>$id));
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$id;
    $this->data['record']['product_name']=$process['product_name'];
    $this->data['record']['melting_lot_chain_name']=!empty($this->data['record']['melting_lot_chain_name'])?$this->data['record']['melting_lot_chain_name']:$process['melting_lot_chain_name'];
    parent::edit($id);
  }

  public function _get_form_data() {
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$_POST['id'];
    $processes=$this->process_model->find('',array('id'=>$this->data['record']['id']));
    $this->data['chain_name']=get_ka_chain_options();
  }
  
  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_chain_names']['id'];
  }
}