<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Melting_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('processes/process_model');
  }

  public function index(){
  	$where_condition['where'] = array('balance >' =>0); 
    $where_condition['where_in'] = array('department_name' =>array('"Melting"','"PL Melting"','"AG Melting"')); 
  	$this->data['record']['melting_data'] = $this->process_model->get('id,balance,product_name,process_name,lot_no,in_weight,out_weight,design_code,quantity,department_name,loss,balance_fine,in_lot_purity,tounch_in,tounch_no,ghiss',$where_condition,array(),array('order_by'=>'product_name'));

  	parent::view(1);//
  } 
}