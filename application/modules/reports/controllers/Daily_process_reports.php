<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_process_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model','processes/process_field_model'));
  }

  public function index() {

    $this->data['department_name']=$this->process_model->get('distinct(department_name) name,department_name id',array('balance!='=>0));
    $this->data['category_one']=$this->process_model->get('distinct(melting_lot_category_one) name,melting_lot_category_one id',array('balance!='=>0));
    $this->data['purity']=$this->process_model->get('distinct(in_lot_purity) name,in_lot_purity id',array('balance!='=>0));
    $this->data['record']['day']=!empty($_GET['day'])?$_GET['day']:0;
    $this->data['record']['category_one']=!empty($_GET['category_one'])?$_GET['category_one']:"";
    $this->data['record']['in_purity']=!empty($_GET['in_purity'])?$_GET['in_purity']:0;
    $this->data['record']['department_name']=!empty($_GET['department_name'])?$_GET['department_name']:"";
    $this->data['record']['type']=!empty($_GET['type'])?$_GET['type']:'';
    $where=array('balance!='=>0,'department_name not in ("Start","Casting","Melting Start", "Melting")'=>NULL);
    if(!empty($this->data['record']['department_name'])){
      $where['department_name']=$this->data['record']['department_name'];
    }if(!empty($this->data['record']['category_one'])){
      $where['melting_lot_category_one']=$this->data['record']['category_one'];
    }
    if(!empty($this->data['record']['in_purity'])&&$this->data['record']['in_purity']!=0){
      $where['in_lot_purity']=$this->data['record']['in_purity'];
    }
    $process_details = $this->process_model->get('row_id,id,lot_no,product_name,process_name,department_name,tone,balance,balance_fine,balance_gross,created_at,date(created_at) first_creatd_at,in_lot_purity,in_weight,out_weight,melting_lot_category_one as category_one,melting_lot_category_two as category_two,',$where);
    $processes=array();
    foreach ($process_details as $process_index => $value) {
      $processes[$process_index]=$value;
      $row_ids=explode('-',$value['row_id']);
      $process_detail=$this->process_model->find('date(created_at) created_at',array('department_name in ("Grinding","Filing","Grinding RND","Lock Filing")'=>NULL,'row_id'=>$row_ids[0].'-'.$row_ids[1]));
      $processes[$process_index]['first_created_at']=!empty($process_detail)?$process_detail['created_at']:"";
   }
//	pd($processes);
    $this->get_daily_process($_GET['type'],$_GET['day'],$processes);
//pd($this->data['category_one']);
    parent::view(1);
    
  }
  private function get_daily_process($type,$day, $processes) {
    if(!empty($processes)){
      $this->data['daily_process_listing']=array();
      foreach ($processes as $index => $process) {
        if($type=="day_one_records"){
          if((strtotime(date('Y-m-d'))==strtotime($process['first_created_at']))&&$process['department_name']!="Finish Good"){
            $this->data['daily_process_listing'][$index]=$process;
            $this->data['daily_process_listing'][$index]['hold_day']=$day;
          }
        }else{
          if($type=="overdue"){
            if((strtotime('-'.$day.' day',strtotime(date('Y-m-d')))>=strtotime($process['first_created_at']))&&$process['department_name']!="Finish Good"){
              $this->data['daily_process_listing'][$index]=$process;
              $this->data['daily_process_listing'][$index]['hold_day']=$day."+";
            }
          }elseif($type=="finish_good"){
            if($process['department_name']=="Finish Good"){
              $this->data['daily_process_listing'][$index]=$process;
              $this->data['daily_process_listing'][$index]['hold_day']='-';
            }
          }else{
            if((strtotime('-'.$day.' day',strtotime(date('Y-m-d')))==strtotime($process['first_created_at']))&&$process['department_name']!="Finish Good"){
              $this->data['daily_process_listing'][$index]=$process;
              $this->data['daily_process_listing'][$index]['hold_day']=$day;
            }
          }
        }
        
      }
    }
  }
}
