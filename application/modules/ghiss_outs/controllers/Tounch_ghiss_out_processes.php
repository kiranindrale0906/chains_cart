<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tounch_ghiss_out_processes extends BaseController {	
	public function __construct(){
    $this->_model='tounch_ghiss_out_process_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('ghiss_outs/ghiss_out_melting_process_model',
                             'processes/process_model', 'processes/process_out_wastage_detail_model'));
  } 

  public function index() { 
    redirect(base_url().'ghiss_outs/tounch_ghiss_out_processes/create');
  } 

  /*public function create() {
    $this->data['record']['department_name'] = (isset($_GET['department_name']) ? $_GET['department_name'] : '');
    parent::create();
  }*/

  public function _get_form_data() {
    /*$where = array('department_name' => @$this->data['record']['department_name'], 
                   'balance_tounch_ghiss >' => 0);
    $this->data['processes'] = $this->process_model->get('', $where);
    
    $this->data['department_name'] = $this->process_model->get('DISTINCT(department_name) as id, department_name as name', 
                                                                array('balance_tounch_ghiss > ' => 0));*/

    $this->data['processes'] = $this->process_model->get('id, product_name, process_name, department_name, tounch_ghiss, balance_tounch_ghiss, lot_no, design_code, in_purity, in_lot_purity', 
                                                            array('balance_tounch_ghiss !=' => 0));

  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'ghiss_outs/ghiss_out_melting_processes';
    return $formdata;
  }


}
