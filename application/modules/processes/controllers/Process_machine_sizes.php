<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_machine_sizes extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('settings/category_model', 'processes/process_model','Ka_chains/ka_chain_factory_order_master_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('',array('id'=>$id));
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$id;
    $this->data['record']['machine_size']=!empty($this->data['record']['machine_size'])?$this->data['record']['machine_size']:$process['machine_size'];
    parent::edit($id);
  }

  public function _get_form_data() {
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$_POST['id'];
    $processes=$this->process_model->find('',array('id'=>$this->data['record']['id']));
    if(HOST=='ARF' && $processes['product_name']=='KA Chain'){
    $this->data['machine_sizes'] = $this->ka_chain_factory_order_master_model->get('gauge as name ,gauge as id', 
                                                                  array(), array(),
                                                                  array('group_by'=>'gauge','order_by'=>'gauge'));

  }else{

    $this->data['machine_sizes']=$this->category_model->get('DISTINCT(category_three) as name,category_three as id',array('product_name'=>$processes['product_name']));
  }  
  }
  
  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_machine_sizes']['id'];
  }
}