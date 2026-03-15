<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_change_rolling_balance_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('processes/process_model');
  }

  public function index(){
    $this->data['chain_name']=$this->daily_change_rolling_balance_report_model->get('distinct(product_name) as name, product_name as id ',array('product_name!='=>""));
  	$where_condition['where'] = array('balance_gross >' =>0,'product_name!=' =>""); 
    if(!empty($_GET['chain_name'])){
     $where_condition['where']['product_name'] = $_GET['chain_name'];
     $this->data['record']['chain_name'] = $_GET['chain_name'];
    }
    $rolling_data = $this->daily_change_rolling_balance_report_model->get('',$where_condition,array(),array('order_by'=>'created_at asc'));

    foreach ($rolling_data as $key => $value) {
      $year=date("Y-m",strtotime($value['transaction_date']));
      $this->data['record']['rolling_data'][$year][$key]=$value;
    }
  	parent::view(1);//
  } 
}
