<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parent_lot_wise_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('processes/process_model');
  }

  public function index(){
  	$this->data['record']['parent_lot_wise_data'] = $this->process_model->get('
  																																					product_name,parent_lot_name,SUM(balance) as balance',
  																																					array('balance >'=>0,'parent_lot_name !=' =>''),array(),
  																																					array('group_by'=>'parent_lot_name,product_name','order_by'=>'product_name'));
  	parent::view(1);
  }
}