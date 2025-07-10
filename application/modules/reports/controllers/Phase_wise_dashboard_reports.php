<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phase_wise_dashboard_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model','processes/process_field_model'));
  }

  public function index() {
    if($_GET['phase']==1){
      $where=array();
      if(!empty($_GET['status'])){
        if($_GET['status']=="In Printing"){
          $where['status']="In Printing";
        }if($_GET['status']=="Tree Making"){
          $where['status in ("Tree Ready","Completed","Print OK")']=Null;
        }if($_GET['status']=="In Investment"){
          $where['status']="In Investment";
        }
      }else{
        $where['status in ("In Printing","Tree Ready","Completed","Print OK")']=Null;
      }
      $this->data['process_wise_dashboard_listing'] = $this->generate_lot_model->get('',$where);
    }else{
	$where=array('balance!='=>0);
      if(empty($_GET['status'])){
        if($_GET['phase']==3){
          $where['department_name in ("Segregation","Grinding","Magnet","Filing","Filing I","Filing II","Filing III","Refiling","Refiling II","Refiling III","Factory Hold","Stone Setting","Meena","Meena Filing","Pasta","Lock Filing")']=NULL;
        }if($_GET['phase']==4){
          $where['department_name in ("Buffing","Correction","Hand Dull","Hand Cutting","Hallmark Out","Buffing Refresh","GPC Rhodium","Packing")']=NULL;
        }
      }else{
          $where['department_name']=$_GET['department_name'];
      }
    $process_wise_dashboard_listing = $this->process_model->get('',$where);
    $processes=array();
    foreach ($process_wise_dashboard_listing as $process_index => $value) {
      $processes[$process_index]=$value;
      $row_ids=explode('-',$value['row_id']);
      $process_detail=$this->process_model->find('date(created_at) created_at',array('department_name in ("Grinding","Filing","Grinding RND","Lock Filing","Hardening","Segregation")'=>NULL,'row_id'=>$row_ids[0].'-'.$row_ids[1]));
      $processes[$process_index]['first_created_at']=!empty($process_detail)?$process_detail['created_at']:"";
   }}
    $this->get_daily_process(7,$processes);
    parent::view(1);
    
  }
  private function get_daily_process($day,$processes) {
    if(!empty($processes)){
      $this->data['process_wise_dashboard_listing']=array();
      foreach ($processes as $index => $process) {
            if((strtotime('-'.$day.' day',strtotime(date('Y-m-d')))>=strtotime($process['first_created_at']))&&$process['department_name']!="Finish Good"){
	      $this->data['process_wise_dashboard_listing'][$index]=$process;
              $this->data['process_wise_dashboard_listing'][$index]['hold_day']=$day."+";
            }else{
//            if((strtotime('-'.$day.' day',strtotime(date('Y-m-d')))==strtotime($process['first_created_at']))&&$process['department_name']!="Finish Good"){
              $this->data['process_wise_dashboard_listing'][$index]=$process;
              $this->data['process_wise_dashboard_listing'][$index]['hold_day']=0;
  //          }
          }
        }
      }
   }
}
