<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design_wise_order_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('arc_orders/order_detail_model');
  }

  public function index(){
  	$where_condition['where'] = array();  
  	$this->data['record']['design_wise_order_reports'] = $this->order_detail_model->get('sum(quantity) order_qty,sum(weight) order_wt,item_code',array(),array(),array('group_by'=>'item_code'));
  	parent::view(1);
  } 
}