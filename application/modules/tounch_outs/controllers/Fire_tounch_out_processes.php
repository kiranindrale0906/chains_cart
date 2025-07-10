<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fire_tounch_out_processes extends BaseController {	
	public function __construct(){
    $this->_model='fire_tounch_out_process_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('tounch_outs/fire_tounch_out_melting_process_model',
                             'processes/process_model', 'processes/process_out_wastage_detail_model'));
  } 

  public function index() { 
    redirect(base_url().'tounch_outs/fire_tounch_out_processes/create');
  } 

  public function _get_form_data() {
    $where = array('balance_fire_tounch_out >' => 0);
    $this->data['processes'] = $this->process_model->get('', $where);
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'tounch_outs/fire_tounch_out_melting_processes';
    return $formdata;
  }


}
