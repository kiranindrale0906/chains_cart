<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rodium_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('processes/process_model');
  }

  public function index(){
  	$this->data['record']['rodium_data'] = $this->process_model->get('id,balance,product_name,process_name,lot_no,in_lot_purity,out_purity,in_weight,out_weight,karigar,design_code,quantity,loss,balance_fine',array('department_name'=>'GPC OR Rodium','balance >'=>0),array(),array('order_by'=>'product_name'));

  	parent::view(1);//
  } 
}