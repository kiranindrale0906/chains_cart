<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Huid_quantity_reports extends BaseController {
  public function __construct(){
  	$this->_model = 'buffing_report_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_field_model','users/account_model'));
  
  }

  public function index(){
    $this->data['accounts']=$this->account_model->get('name,name as id');
    
    $where=array('process_details.out_quantity >'=>0,'processes.department_name'=>"HUID",'processes.process_name'=>"HUID Process");
    if(!empty($_GET['huid_quantity_reports']['from_date'])) {
      $this->data['record']['from_date'] = $_GET['huid_quantity_reports']['from_date'];
      $from_date = date('Y-m-d', strtotime($_GET['huid_quantity_reports']['from_date']));
    }

    if(!empty($_GET['huid_quantity_reports']['to_date'])) {
      $this->data['record']['to_date'] = $_GET['huid_quantity_reports']['to_date'];
      $to_date = date('Y-m-d', strtotime($_GET['huid_quantity_reports']['to_date']));
    }
    if(!empty($_GET['huid_quantity_reports']['account'])) {
      $this->data['record']['account'] = $_GET['huid_quantity_reports']['account'];
      $account = $_GET['huid_quantity_reports']['account'];
    }

    if(!empty($from_date))       $where['date(process_details.created_at) >='] = $from_date;
    if(!empty($to_date))         $where['date(process_details.created_at )<='] = $to_date; 
    if(!empty($account))         $where['processes.account'] = $account; 
     
  	$this->data['record']['huid_quantity_data'] = $this->process_field_model->get('date(process_details.created_at) as date,processes.lot_no as lot_no,processes.quantity as quantity,processes.job_card_no as job_card_no,processes.account,processes.gpc_out as out_weight,processes.factory_out as factory_out,process_details.out_quantity as out_quantity',$where,array(array('processes','processes.id=process_details.process_id')),array('order_by'=>'job_card_no'));
  	parent::view(1);//
  } 
}