<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Completed_melting_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('melting_lots/melting_lot_model','processes/process_model'));
  }

 /*public function index(){
    $where_condition['where'] = array('gpc_out >' =>0); 
    $this->data['record']['completed_melting_data'] = $this->process_model->get('',$where_condition,array(),array('group_by'=>'lot_no,melting_lot_id'));
    foreach ($this->data['record']['completed_melting_data'] as $index => $value) {
      $melting_lot_detail=$this->melting_lot_model->find('',array('id'=>$value['melting_lot_id']));
      $this->data['record']['completed_melting_data'][$index]['melting_date']=$melting_lot_detail['created_at'];
      $this->data['record']['completed_melting_data'][$index]['melting_weight']=$melting_lot_detail['gross_weight'];
      $date1 = date('Y-m-d',strtotime($melting_lot_detail['created_at']));
      $date2 = date('Y-m-d',strtotime($value['completed_at']));
      $diff = abs(strtotime($date2) - strtotime($date1));
      $years = floor($diff / (365*60*60*24));
      $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
      $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
      $this->data['record']['completed_melting_data'][$index]['diff_melting_date_with_complted_date']='years: '.$years.' months: '.$months.' days: '.$days;
    
    }
  	parent::view(1);//
  }*/
  public function index(){
    $melting_lot_ids=$this->process_model->get('melting_lot_id',array('melting_lot_id!='=>0,'gpc_out >'=>0));
    $melting_lot_ids=array_column($melting_lot_ids,'melting_lot_id');
    $where_condition['where'] = array('gross_weight >' =>0); 
    $where_condition['id'] = $melting_lot_ids; 
    $process_where_condition=$where_condition;
    if(!empty($_GET['product_name'])){
      $where_condition['process_name'] = $_GET['product_name'];
      $this->data['record']['product_name']= $_GET['product_name'];
    }
    $completed_melting_data = $this->melting_lot_model->get('id,process_name as product_name,created_at as melting_date,gross_weight as melting_weight',$where_condition,array(),array('order_by'=>"created_at"));
    $this->data['product_names'] = $this->melting_lot_model->get('process_name as name,process_name id
      ',$process_where_condition,array(),array('group_by'=>'process_name'));
    foreach ($completed_melting_data as $index => $value) {
      $this->data['record']['completed_melting_data'][$value['product_name']][date('d-m-Y',strtotime($value['melting_date']))][$index]=$value;
      $process_detail=$this->process_model->find('',array('melting_lot_id'=>$value['id'],'gpc_out >'=>0));
      $this->data['record']['completed_melting_data'][$value['product_name']][date('d-m-Y',strtotime($value['melting_date']))][$index]['lot_no']=$process_detail['lot_no'];
      $this->data['record']['completed_melting_data'][$value['product_name']][date('d-m-Y',strtotime($value['melting_date']))][$index]['completed_at']=$process_detail['completed_at'];
      $this->data['record']['completed_melting_data'][$value['product_name']][date('d-m-Y',strtotime($value['melting_date']))][$index]['gpc_out']=$process_detail['gpc_out'];
      $this->data['record']['completed_melting_data'][$value['product_name']][date('d-m-Y',strtotime($value['melting_date']))][$index]['department_name']=$process_detail['department_name'];
      $this->data['record']['completed_melting_data'][$value['product_name']][date('d-m-Y',strtotime($value['melting_date']))][$index]['out_put']=(($process_detail['gpc_out']/$value['melting_weight'])*100);
      $this->data['record']['completed_melting_data'][$value['product_name']][date('d-m-Y',strtotime($value['melting_date']))][$index]['balance']=$process_detail['balance'];
      $date1 = date('Y-m-d',strtotime($value['melting_date']));
      $date2 = date('Y-m-d',strtotime($process_detail['completed_at']));
      $diff = abs(strtotime($date2) - strtotime($date1));
      $years = floor($diff / (365*60*60*24));
      $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
      $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
      $this->data['record']['completed_melting_data'][$value['product_name']][date('d-m-Y',strtotime($value['melting_date']))][$index]['diff_melting_date_with_complted_date']='years: '.$years.' months: '.$months.' days: '.$days;
      $this->data['record']['completed_melting_data'][$value['product_name']][date('d-m-Y',strtotime($value['melting_date']))][$index]['is_out_off_time']=($days>10)?1:0;
    }
    parent::view(1);//
  }
}
