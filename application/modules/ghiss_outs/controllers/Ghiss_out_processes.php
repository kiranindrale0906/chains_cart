<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ghiss_out_processes extends BaseController {  
  public function __construct(){
    $this->_model='ghiss_out_process_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('ghiss_outs/ghiss_out_melting_process_model',
                             'processes/process_model', 'processes/process_out_wastage_detail_model'));
  } 

  public function index() { 
    redirect(base_url().'ghiss_outs/ghiss_out_processes/create');
  } 

  public function create() {
    $this->data['record']['department_name'] = (isset($_GET['department_name']) ? $_GET['department_name'] : '');
    parent::create();
  }

  public function _get_form_data() {

    $this->data['department_names'] = get_ghiss_department();
    if (!empty($this->data['record']['department_name'])) {
      $department_name=explode(',', $this->data['record']['department_name']);
      $where['where'] = array('balance_ghiss >' => 0,
                              'wastage_purity >' => 0,
                              'wastage_lot_purity >' => 0);
      $where['where_in'] =array('department_name'=>'"'.implode('", "', $department_name).'"') ;
      $this->data['processes'] = $this->process_model->get('', $where);
    }
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'ghiss_outs/ghiss_out_melting_processes';
    return $formdata;
  }


}
