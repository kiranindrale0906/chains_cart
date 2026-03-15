<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buffing_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('processes/process_model');
  }

  public function index(){
  	$where_condition['where'] = array('balance >' =>0); 
    $where_condition['where_in'] = array('department_name' =>array('"Buffing"','"Buffing II"','"PL Buffing"')); 
  	$this->data['record']['buffing_data'] = $this->process_model->get('id,department_name,balance,product_name,process_name,lot_no,in_weight,out_weight,design_code,quantity,loss,balance_fine,in_lot_purity',$where_condition,array(),array('order_by'=>'product_name'));

  	parent::view(1);//
  } 
}