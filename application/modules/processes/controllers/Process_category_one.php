<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_category_one extends BaseController {
    public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/category_model','Ka_chains/ka_chain_factory_order_master_model'));
    $this->redirect_after_save = 'view';
  }

  public function edit($id){
    $this->data['id']=$id;
    $process=$this->process_model->find('', array('id' => $id));
    $this->data['record']['id'] = !empty($this->data['record']['id']) ? $this->data['record']['id'] : $id;
    $this->data['record']['product_name'] = $process['product_name'];
    $this->data['record']['melting_lot_category_one'] = !empty($this->data['record']['melting_lot_category_one']) ? $this->data['record']['melting_lot_category_one'] : $process['melting_lot_category_one'];
    parent::edit($id);
  }

  public function _get_form_data() {
    $this->data['record']['id'] = !empty($this->data['record']['id']) ? $this->data['record']['id'] : $_POST['id'];
    $processes=$this->process_model->find('',array('id' => $this->data['record']['id']));
    
    if(HOST=='ARF' && $processes['product_name']=='KA Chain'){
      $this->data['category_ones'] = $this->ka_chain_factory_order_master_model->get('category_name as name ,category_name as id', 
                                                                  array(), array(),
                                                                  array('group_by'=>'category_name','order_by'=>'category_name'));
    }else{

      $this->data['category_ones'] = $this->category_model->get('DISTINCT(category_one) as name, category_one as id', array('product_name'=>$processes['product_name']));
    }
        
  }
  
  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'processes/processes/view/'.$formdata['process_category_one']['id'];
  }
}