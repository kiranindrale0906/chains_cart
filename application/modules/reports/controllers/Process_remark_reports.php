<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_remark_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('reports/process_remark_report_model');
  }

  public function index(){
    $where_condition['where'] = array('remark !=' =>""); 
    // $this->data['process_name'] = $this->process_remark_report_model->get('distinct(process_name) as name ,process_name as id',$where_condition,array());

    if(!empty($_GET['process_remark_reports']['product_name'])) {
      $this->data['record']['product_name'] = $_GET['process_remark_reports']['product_name'];
      $product_name = ($_GET['process_remark_reports']['product_name']);
    }

    if(!empty($_GET['process_remark_reports']['process_name'])) {
      $this->data['record']['process_name'] = $_GET['process_remark_reports']['process_name'];
      $process_name = ($_GET['process_remark_reports']['process_name']);
    }

    if(!empty($_GET['process_remark_reports']['department_name'])) {
      $this->data['record']['department_name'] = $_GET['process_remark_reports']['department_name'];
      $department_name = ($_GET['process_remark_reports']['department_name']);
    }

    if(!empty($_GET['process_remark_reports']['in_lot_purity'])) {
      $this->data['record']['in_lot_purity'] = $_GET['process_remark_reports']['in_lot_purity'];
      $in_lot_purity = ($_GET['process_remark_reports']['in_lot_purity']);
    }

    if(!empty($product_name)) $where_condition['processes.product_name'] = $product_name; 
    if(!empty($process_name)) $where_condition['processes.process_name'] = $process_name; 
    if(!empty($department_name)) $where_condition['processes.department_name'] = $department_name; 
    if(!empty($in_lot_purity)) $where_condition['processes.in_lot_purity'] = $in_lot_purity; 

    $this->data['record']['customer_order_data'] = $this->process_remark_report_model->get('id,department_name,product_name,process_name,lot_no,in_weight,out_weight,loss,in_lot_purity,remark,daily_drawer_wastage',$where_condition,array(),array('order_by'=>'product_name'));

    $this->data['product_name'] = array();
    $this->data['process_name'] = array();
    $this->data['department_name'] = array();
    $this->data['in_lot_purity'] = array();

    $product_names = array_unique(array_column($this->data['record']['customer_order_data'], 'product_name'));
    $process_names = array_unique(array_column($this->data['record']['customer_order_data'], 'process_name'));
    $department_name = array_unique(array_column($this->data['record']['customer_order_data'], 'department_name'));
    $in_lot_purity = array_unique(array_column($this->data['record']['customer_order_data'], 'in_lot_purity'));

    foreach ($product_names as $index => $product_name) {
      array_push($this->data['product_name'], array('id'=>$product_name,'name'=>$product_name));
    }
    foreach ($process_names as $index => $process_name) {
      array_push($this->data['process_name'], array('id'=>$process_name,'name'=>$process_name));
    }
    foreach ($department_names as $index => $department_name) {
      array_push($this->data['department_name'], array('id'=>$department_name,'name'=>$department_name));
    }
    foreach ($in_lot_purities as $index => $in_lot_purity) {
      array_push($this->data['in_lot_purity'], array('id'=>$in_lot_purity,'name'=>$in_lot_purity));
    }
    parent::view(1);//
  } 
}
