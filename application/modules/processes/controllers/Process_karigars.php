<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_karigars extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('refresh/refresh_model', 'processes/process_model', 'settings/karigar_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('',array('id'=>$id));
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$id;
    $this->data['record']['karigar']=!empty($this->data['record']['karigar'])?$this->data['record']['karigar']:$process['karigar'];
    $this->data['record']['factory_karigar']=!empty($this->data['record']['factory_karigar'])?$this->data['record']['factory_karigar']:$process['factory_karigar'];
     parent::edit($id);
  }

  public function _get_form_data() {
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$_POST['id'];
    $processes=$this->process_model->find('',array('id'=>$this->data['record']['id']));
    if($processes['product_name']=='Daily Drawer Receipt' || ($processes['product_name']=='Issue' && $processes['process_name']=='Daily Drawer Issue')){
      //$this->data['karigars']=get_karigars();
      $this->data['karigars'] = $this->karigar_model->get('karigar_name as name, karigar_name as id', array(), array(), array('group_by' => 'karigar_name'));
    }else{
    $this->data['karigars']=$this->same_karigar_model->get('DISTINCT(karigar_name) as name,karigar_name as id',
                                      array('product_name'=>$processes['product_name'],
                                            'process_name'=>$processes['process_name'],
                                            'department_name'=>$processes['department_name'],
                                              ));
    }
  }
  
  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_karigars']['id'];
  }
}