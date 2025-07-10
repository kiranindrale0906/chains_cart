<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_design_codes extends BaseController {
    public function __construct() {
    parent::__construct();
    $this->load->model(array('settings/category_four_model', 'processes/process_model','Ka_chains/ka_chain_factory_order_master_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('',array('id'=>$id));
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$id;
    $this->data['record']['design_code']=!empty($this->data['record']['design_code'])?$this->data['record']['design_code']:$process['design_code'];
    parent::edit($id);
  }

  public function _get_form_data() {
    $this->data['record']['id']=!empty($this->data['record']['id'])?$this->data['record']['id']:$_POST['id'];
    $processes=$this->process_model->find('',array('id'=>$this->data['record']['id']));
    if(HOST == 'ARF' && $processes['product_name']=='KA Chain'){

    $this->data['design_codes'] = $this->ka_chain_factory_order_master_model->get('distinct(design_name) as id, design_name as name',
                                                                        array(), array(),
                                                                        array('group_by'=>'design_name','order_by'=>'design_name'));
    $this->data['lines'] = $this->ka_chain_factory_order_master_model->get('distinct(line) as id, line as name',
                                                                        array(), array(),
                                                                        array('group_by'=>'line','order_by'=>'line')); 
    }else{

    $this->data['design_codes']=$this->category_four_model->get('(category) as name,category as id',
                                      array('product_name'=>$processes['product_name'],
                                           ));
    }
  }
  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_design_codes']['id'];
  }
}