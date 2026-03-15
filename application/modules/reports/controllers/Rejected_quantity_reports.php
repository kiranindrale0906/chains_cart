<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rejected_quantity_reports extends BaseController {
  public function __construct(){
  	$this->_model = 'buffing_report_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_field_model','users/account_model'));
  }

  public function index(){
    $this->data['accounts']=$this->account_model->get('name,name as id');
    
    $where=array('process_details.rejected_qty >'=>0);
    if(!empty($_GET['rejected_quantity_reports']['from_date'])) {
      $this->data['record']['from_date'] = $_GET['rejected_quantity_reports']['from_date'];
      $from_date = date('Y-m-d', strtotime($_GET['rejected_quantity_reports']['from_date']));
    }

    if(!empty($_GET['rejected_quantity_reports']['to_date'])) {
      $this->data['record']['to_date'] = $_GET['rejected_quantity_reports']['to_date'];
      $to_date = date('Y-m-d', strtotime($_GET['rejected_quantity_reports']['to_date']));
    }if(!empty($_GET['rejected_quantity_reports']['account'])) {
      $this->data['record']['account'] = $_GET['rejected_quantity_reports']['account'];
      $account = ($_GET['rejected_quantity_reports']['account']);
    }

    if(!empty($from_date))       $where['date(process_details.created_at) >='] = $from_date;
    if(!empty($to_date))         $where['date(process_details.created_at )<='] = $to_date; 
    if(!empty($account))         $where['processes.account'] = $account; 
     
  	$this->data['record']['rejected_quantity_data'] = $this->process_field_model->get('date(process_details.created_at) as date,processes.lot_no as lot_no,processes.quantity as quantity,processes.job_card_no as job_card_no,processes.account,processes.out_weight as out_weight,process_details.rejected_qty as rejected_quantity ',$where,array(array('processes','processes.id=process_details.process_id')),array('order_by'=>'job_card_no'));
  	parent::view(1);//
  } 
}