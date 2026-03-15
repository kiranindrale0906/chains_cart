<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Overall_rolling_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('issue_departments/issue_department_model'));
  }

  public function index(){
    $this->data['balance']=$this->model->get_total_balance_from_argold_ledger();
    $this->data['gpc_out_balance']=$this->issue_department_model->find('SUM(in_weight) as balance',array('where_in'=>array('account_id'=>array("'OUTSIDE PARTY'","'IMPORTED GOODS'","'TANISHQ'","'EXPORT ACCOUNT'","'KT INTERNATIONAL'","'MKORE LLC USA'","'EXPORT DIFF.'","'TITAN DIFF.'")),'where'=>array('product_name'=>'GPC Out','date(created_at)'=>date('Y-m-d'))))['balance'];
    if(!empty($_GET['overall_rolling'])&&$_GET['overall_rolling']==1){
    	echo json_encode(array('data'    => $this->data,
                           'status'      => 'success',
                           'open_modal'  => FALSE));
    	die;
    }
    $this->load->render('stock_summary_reports/overall_rolling_reports/index',$this->data); 
  }
}