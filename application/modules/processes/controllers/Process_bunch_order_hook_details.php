<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_bunch_order_hook_details extends BaseController {	
	public function __construct(){
    $this->_model='Process_bunch_order_hook_detail_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model', 'processes/process_out_wastage_detail_model', 'processes/process_factory_order_detail_model', 'processes/process_field_model', 'processes/process_model','ka_chains/ka_chain_factory_order_detail_model','ka_chains/ka_chain_factory_order_model'));
  }  
  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'ka_chains/hook_processes';
    return $formdata;
  }
}