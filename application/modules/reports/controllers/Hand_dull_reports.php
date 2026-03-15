<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hand_dull_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('processes/process_model');
  }

  public function index(){
  	$this->data['record']['hand_dull_data'] = $this->process_model->get('id,balance,product_name,process_name,lot_no,in_weight,out_weight,design_code,quantity,karigar,loss,balance_fine,in_lot_purity,tounch_in,tounch_no,ghiss',array('department_name'=>'Hand Dull','balance >'=>0),array(),array('order_by'=>'product_name'));

  	parent::view(1);//
  } 
}