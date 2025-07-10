<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Person_productions extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model'));
  }
  public function _get_form_data(){
   $this->data['department_names']=$this->process_model->get('distinct(department_name) as name,(department_name) as id',array('department_name!='=>'Start'),array(),array('order_by'=>'department_name asc')); 
  }
}
