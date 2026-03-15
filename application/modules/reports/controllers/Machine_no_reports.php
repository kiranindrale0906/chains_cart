<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Machine_no_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model','processes/process_detail_model'));
  }
    public function index(){
  	$where_condition['where'] = array('machine_no >' =>0); 
    $this->data['record']['machine_no_data'] = $this->process_detail_model->get('process_details.machine_no machine_no,processes.product_name product_name,processes.process_name process_name,processes.in_lot_purity in_lot_purity,processes.in_weight in_weight,processes.quantity quantity,processes.loss loss,processes.balance balance,processes.balance_fine balance_fine,processes.design_code design_code,processes.out_weight out_weight,processes.department_name department_name,',$where_condition,array(array('processes','processes.id=process_details.process_id')));
    parent::view(1);//
  } 
}