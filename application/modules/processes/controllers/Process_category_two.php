<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_category_two extends BaseController {
    public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/category_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('',array('id'=>$id));
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$id;
    $this->data['record']['product_name']=$process['product_name'];
    $this->data['record']['melting_lot_category_two']=!empty($this->data['record']['melting_lot_category_two'])?$this->data['record']['melting_lot_category_two']:$process['melting_lot_category_two'];
    parent::edit($id);
  }

  public function _get_form_data() {
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$_POST['id'];
    $processes=$this->process_model->find('',array('id'=>$this->data['record']['id']));
    $this->data['category_two']=$this->category_model->get('DISTINCT(category_two) as name,category_two as id',
                                      array('category_one'=>$processes['melting_lot_category_one'],
                                              ));
  }
  
  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_category_two']['id'];
  }
}