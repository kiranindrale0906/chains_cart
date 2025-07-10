<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_order_out_weight_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('ka_chains/ka_chain_customer_order_process_model');
  }

  public function index(){
  	$where_condition['where'] = array('out_weight >' =>0); 
    $this->data['customer_names'] = $this->ka_chain_customer_order_process_model->get('distinct(customer_name) as name ,customer_name as id',$where_condition,array());
    if(!empty($_GET['customer_order_out_weight_reports']['from_date'])) {
      $this->data['record']['from_date'] = $_GET['customer_order_out_weight_reports']['from_date'];
      $from_date = date('Y-m-d', strtotime($_GET['customer_order_out_weight_reports']['from_date']));
    }

    if(!empty($_GET['customer_order_out_weight_reports']['to_date'])) {
      $this->data['record']['to_date'] = $_GET['customer_order_out_weight_reports']['to_date'];
      $to_date = date('Y-m-d', strtotime($_GET['customer_order_out_weight_reports']['to_date']));
    }if(!empty($_GET['customer_order_out_weight_reports']['customer_name'])) {
      $this->data['record']['customer_name'] = $_GET['customer_order_out_weight_reports']['customer_name'];
      $customer_name = ($_GET['customer_order_out_weight_reports']['customer_name']);
    }

    if(!empty($from_date))       $where_condition['date(processes.created_at) >='] = $from_date;
    if(!empty($to_date))         $where_condition['date(processes.created_at )<='] = $to_date; 
    if(!empty($customer_name))         $where_condition['processes.customer_name'] = $customer_name; 

    $this->data['record']['customer_order_data'] = $this->ka_chain_customer_order_process_model->get('id,department_name,product_name,process_name,lot_no,in_weight,out_weight,design_code,quantity,loss,in_lot_purity,customer_name',$where_condition,array(),array('order_by'=>'product_name'));

  	parent::view(1);//
  } 
}