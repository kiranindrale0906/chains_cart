<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_machine_no extends BaseController {
    public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','masters/machine_master_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('product_name, process_name, department_name, machine_no', array('id' => $id));
    $this->data['record']['id'] = !empty($this->data['record']['id']) ? $this->data['record']['id'] : $id;
    $this->data['record']['product_name'] = $process['product_name'];
    $this->data['record']['machine_no'] = !empty($this->data['record']['machine_no']) ? $this->data['record']['machine_no'] : $process['machine_no'];
    parent::edit($id);
  }

  public function _get_form_data() {
    $this->data['record']['id'] = !empty($this->data['record']['id']) ? $this->data['record']['id'] : $_POST['id'];
    $processes=$this->process_model->find('product_name, process_name, department_name, machine_no', array('id' => $this->data['record']['id']));
    
    $this->data['machine_names'] = $this->machine_master_model->get('DISTINCT(machine_name) as name, machine_name as id', 
                                                                    array('product_name'=>$processes['product_name'],
                                                                          'process_name'=>$processes['process_name'],
                                                                          'department_name'=>$processes['department_name']));
  }
  
  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_machine_no']['id'];
  }
}