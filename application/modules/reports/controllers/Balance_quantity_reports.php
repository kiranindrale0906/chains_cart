<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balance_quantity_reports extends BaseController {
  public function __construct(){
  	$this->_model = 'buffing_report_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model','users/account_model'));
  }

  public function index(){
    $this->data['accounts']=$this->account_model->get('name,name as id');
    $where=array('processes.balance_quantity >'=>0);
    if(!empty($_GET['balance_quantity_reports']['from_date'])) {
      $this->data['record']['from_date'] = $_GET['balance_quantity_reports']['from_date'];
      $from_date = date('Y-m-d', strtotime($_GET['balance_quantity_reports']['from_date']));
    }

    if(!empty($_GET['balance_quantity_reports']['to_date'])) {
      $this->data['record']['to_date'] = $_GET['balance_quantity_reports']['to_date'];
      $to_date = date('Y-m-d', strtotime($_GET['balance_quantity_reports']['to_date']));
    }if(!empty($_GET['balance_quantity_reports']['account'])) {
      $account = $_GET['balance_quantity_reports']['account'];
      $this->data['record']['account'] = $_GET['balance_quantity_reports']['account'];
    }

    if(!empty($from_date))       $where['date(processes.completed_at) >='] = $from_date;
      if(!empty($to_date))         $where['date(processes.completed_at )<='] = $to_date; 
      if(!empty($account))         $where['processes.account'] = $account; 
      
  	$this->data['record']['balance_quantity_data'] = $this->process_model->get('date(processes.completed_at) as date,processes.lot_no as lot_no,processes.department_name as department_name,sum(processes.quantity) as quantity,processes.job_card_no as job_card_no,processes.account,sum(processes.balance) as out_weight,sum(processes.balance_quantity) as balance_quantity ',$where,array(),array('order_by'=>'job_card_no','group_by'=>'processes.department_name,processes.account'));
  	$this->load->render('reports/balance_quantity_reports/index',$this->data);    
 
  } 
  public function view($id){
    $this->data['accounts']=$this->account_model->get('name,name as id');
    $where=array('processes.balance_quantity >'=>0);
    if(!empty($_GET['balance_quantity_details']['from_date'])) {
      $this->data['record']['from_date'] = $_GET['balance_quantity_details']['from_date'];
      $from_date = date('Y-m-d', strtotime($_GET['balance_quantity_details']['from_date']));
    }

    if(!empty($_GET['balance_quantity_details']['to_date'])) {
      $this->data['record']['to_date'] = $_GET['balance_quantity_details']['to_date'];
      $to_date = date('Y-m-d', strtotime($_GET['balance_quantity_details']['to_date']));
    }
    if(!empty($_GET['balance_quantity_details']['account'])) {
      $account = $_GET['balance_quantity_details']['account'];
    }
    if(!empty($account))         $where['processes.account'] = $account; 
      

    if(!empty($from_date))       $where['date(processes.completed_at) >='] = $from_date;
    if(!empty($to_date))         $where['date(processes.completed_at )<='] = $to_date; 
    if(!empty($to_date))         $where['date(processes.completed_at )<='] = $to_date; 
    if(!empty($_GET['account'])){$where['processes.account'] =$_GET['account'];}
     $this->data['record']['balance_quantity_data'] = $this->process_model->get('date(processes.completed_at) as date,processes.lot_no as lot_no,processes.department_name as department_name,(processes.quantity) as quantity,processes.job_card_no as job_card_no,processes.account,(processes.out_weight) as out_weight,(processes.balance_quantity) as balance_quantity ',$where,array(),array('order_by'=>'job_card_no'));
    parent::view(1);//
  } 
}