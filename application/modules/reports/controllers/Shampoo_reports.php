<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shampoo_reports extends BaseController {
  public function __construct(){
  	$this->_model = 'buffing_report_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('processes/process_model');
  }

  public function index(){
  	$this->data['record']['shampoo_data'] = $this->process_model->get('id,balance,product_name,process_name,lot_no,in_lot_purity,out_purity,in_weight,out_weight,karigar,design_code,quantity,loss,balance_fine',array('department_name'=>'Shampoo','balance >'=>0),array(),array('order_by'=>'product_name'));
  	parent::view(1);//
  } 
}