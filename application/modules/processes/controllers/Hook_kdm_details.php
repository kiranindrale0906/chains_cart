<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hook_kdm_details extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_field_model'));
  }
  public function create($id='') {
   $this->data['record']['process_id'] = $id;
    $this->data['record']['product_name'] = @$_GET['product_name'];
    $this->data['record']['process_name'] = @$_GET['process_name'];
    $this->data['record']['department_name'] = @$_GET['department_name'];
    parent::create($this->data);
  }
  public function _get_form_data() {
    $this->data['record']['product_name'] =  isset($_GET['product_name']) ? $_GET['product_name'] : ''; 
    $this->data['record']['process_name'] =  isset($_GET['process_name']) ? $_GET['process_name'] : ''; 
    $this->data['record']['department_name'] =  isset($_GET['department_name']) ? $_GET['department_name'] : ''; 
    $where = array('process_id' =>$this->data['record']['process_id']);

    $select_in = 'id ,hook_in,daily_drawer_type,created_at';
    $this->data['hook_in_details'] = $this->process_field_model->get($select_in,$where);
    $select_out = 'id ,hook_out,daily_drawer_type,created_at';
    $this->data['hook_out_details'] = $this->process_field_model->get($select_out,$where);
  }
}