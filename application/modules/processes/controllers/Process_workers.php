<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_workers extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('refresh/refresh_model', 'processes/process_model', 'settings/karigar_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('',array('id'=>$id));
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$id;
    $this->data['record']['worker']=!empty($this->data['record']['worker'])?$this->data['record']['worker']:$process['worker'];
    $this->data['record']['factory_karigar']=!empty($this->data['record']['factory_karigar'])?$this->data['record']['factory_karigar']:$process['factory_karigar'];
     parent::edit($id);
  }

  public function _get_form_data() {
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$_POST['id'];
    $processes=$this->process_model->find('',array('id'=>$this->data['record']['id']));
    $this->data['workers']=array(array('id'=>'Bappy Nawabi-Sisma','name'=>'Bappy Nawabi-Sisma'),
                                  array('id'=>'Ansari','name'=>'Ansari'),
                                  array('id'=>'Pappu','name'=>'Pappu'),
                                  array('id'=>'Kumar','name'=>'Kumar'),
                                  array('id'=>'Office','name'=>'Office'),
                                  array('id'=>'Ganesh Rnd','name'=>'Ganesh Rnd'));
  }
  
  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_workers']['id'];
  }
}
