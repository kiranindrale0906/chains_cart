<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Daily_process_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('users/user_model','processes/process_model','processes/process_field_model'));
  }

  public function index() {
   $users = $this->user_model->get('*');
   $processes = $this->process_model->get('department_name,process_name,balance,balance_gross,balance_fine,date(created_at) created_at,row_id',array('balance!='=>0,'department_name not in ("Start","Casting","Melting Start", "Melting")'=>NULL));
   foreach ($processes as $process_index => $value) {
    $row_ids=explode('-',$value['row_id']);
    $process_detail=$this->process_model->find('date(created_at) created_at',array('department_name in ("Grinding","Filing","Grinding RND","Lock Filing")'=>NULL,'row_id'=>$row_ids[0].'-'.$row_ids[1]));
    $processes[$process_index]['first_created_at']=!empty($process_detail)?$process_detail['created_at']:"";
   }
//	pd($processes);
   $balance_day_one=$balance_fine_day_one=$balance_gross_day_one=0;
   $balance_day_two=$balance_fine_day_two=$balance_gross_day_two=0;
   $balance_day_three=$balance_fine_day_three=$balance_gross_day_three=0;
   $balance_day_four=$balance_fine_day_four=$balance_gross_day_four=0;
   $balance_day_five=$balance_fine_day_five=$balance_gross_day_five=0;
   $balance_day_six=$balance_fine_day_six=$balance_gross_day_six=0;
   $balance_day_seven=$balance_fine_day_seven=$balance_gross_day_seven=0;
   $balance_overdue=$balance_fine_overdue=$balance_gross_overdue=0;
   $balance_finish_good=$balance_fine_finish_good=$balance_gross_finish_good=0;
   $count_day_one=$count_day_two=$count_day_three=$count_day_four=$count_day_five=$count_day_six=$count_day_seven=$count_overdue=$count_finish_good=$i=0;

    foreach ($processes as $index => $value) {
       if((strtotime(date('Y-m-d'))==strtotime($value['first_created_at']))&&$value['department_name']!="Finish Good"){
          $count_day_one+=count($index);
          $balance_day_one+=$value['balance'];
          $balance_gross_day_one+=$value['balance_gross'];
          $balance_fine_day_one+=$value['balance_fine'];
          
       }
       if((strtotime('-1 day',strtotime(date('Y-m-d')))==strtotime($value['first_created_at']))&&$value['department_name']!="Finish Good"){
          $count_day_two+=count($index);
          $balance_day_two+=$value['balance'];
          $balance_gross_day_two+=$value['balance_gross'];
          $balance_fine_day_two+=$value['balance_fine'];

       }
       if((strtotime('-2 day',strtotime(date('Y-m-d')))==strtotime($value['first_created_at']))&&$value['department_name']!="Finish Good"){
          $count_day_three+=count($index);
          $balance_day_three+=$value['balance'];
          $balance_gross_day_three+=$value['balance_gross'];
          $balance_fine_day_three+=$value['balance_fine'];
       }
       if((strtotime('-3 day',strtotime(date('Y-m-d')))==strtotime($value['first_created_at']))&&$value['department_name']!="Finish Good"){
          $count_day_four+=count($index);
          $balance_day_four+=$value['balance'];
          $balance_gross_day_four+=$value['balance_gross'];
          $balance_fine_day_four+=$value['balance_fine'];
       }
       if((strtotime('-4 day',strtotime(date('Y-m-d')))==strtotime($value['first_created_at']))&&$value['department_name']!="Finish Good"){
          $count_day_five+=count($index);
          $balance_day_five+=$value['balance'];
          $balance_gross_day_five+=$value['balance_gross'];
          $balance_fine_day_five+=$value['balance_fine'];
       }
       if((strtotime('-5 day',strtotime(date('Y-m-d')))==strtotime($value['first_created_at']))&&$value['department_name']!="Finish Good"){
          $count_day_six+=count($index);
          $balance_day_six+=$value['balance'];
          $balance_gross_day_six+=$value['balance_gross'];
          $balance_fine_day_six+=$value['balance_fine'];
       }if((strtotime('-6 day',strtotime(date('Y-m-d')))==strtotime($value['first_created_at']))&&$value['department_name']!="Finish Good"){
          $count_day_seven+=count($index);
          $balance_day_seven+=$value['balance'];
          $balance_gross_day_seven+=$value['balance_gross'];
          $balance_fine_day_seven+=$value['balance_fine'];
       }
       if((strtotime('-7 day',strtotime(date('Y-m-d')))>=strtotime($value['first_created_at']))&&$value['department_name']!="Finish Good"){

          $count_overdue+=count($index);
          $balance_overdue+=$value['balance'];
          $balance_gross_overdue+=$value['balance_gross'];
          $balance_fine_overdue+=$value['balance_fine'];
       }
       if($value['department_name']=="Finish Good"){
          $count_finish_good+=count($index);
          $balance_finish_good+=$value['balance'];
          $balance_gross_finish_good+=$value['balance_gross'];
          $balance_fine_finish_good+=$value['balance_fine'];
       }
    }
    $this->data['day_one_records']['balance']=$balance_day_one;
    $this->data['day_one_records']['balance_gross']=$balance_gross_day_one;
    $this->data['day_one_records']['balance_fine']=$balance_fine_day_one;
    $this->data['day_two_records']['balance']=$balance_day_two;
    $this->data['day_two_records']['balance_gross']=$balance_gross_day_two;
    $this->data['day_two_records']['balance_fine']=$balance_fine_day_two;
    $this->data['day_three_records']['balance']=$balance_day_three;
    $this->data['day_three_records']['balance_gross']=$balance_gross_day_three;
    $this->data['day_three_records']['balance_fine']=$balance_fine_day_three;
    $this->data['day_four_records']['balance']=$balance_day_four;
    $this->data['day_four_records']['balance_gross']=$balance_gross_day_four;
    $this->data['day_four_records']['balance_fine']=$balance_fine_day_four;
    $this->data['day_five_records']['balance']=$balance_day_five;
    $this->data['day_five_records']['balance_gross']=$balance_gross_day_five;
    $this->data['day_five_records']['balance_fine']=$balance_fine_day_five;
    $this->data['day_six_records']['balance']=$balance_day_six;
    $this->data['day_six_records']['balance_gross']=$balance_gross_day_six;
    $this->data['day_six_records']['balance_fine']=$balance_fine_day_six;
    $this->data['day_seven_records']['balance']=$balance_day_seven;
    $this->data['day_seven_records']['balance_gross']=$balance_gross_day_seven;
    $this->data['day_seven_records']['balance_fine']=$balance_fine_day_seven;
    $this->data['overdues']['balance']=$balance_overdue;
    $this->data['overdues']['balance_gross']=$balance_gross_overdue;
    $this->data['overdues']['balance_fine']=$balance_fine_overdue;
    $this->data['finish_goods']['balance']=$balance_finish_good;
    $this->data['finish_goods']['balance_gross']=$balance_gross_finish_good;
    $this->data['finish_goods']['balance_fine']=$balance_fine_finish_good;
    $this->data['finish_goods']['balance_fine']=$balance_fine_finish_good;
    $this->data['count']['count_day_one']=$count_day_one;
    $this->data['count']['count_day_two']=$count_day_two;
    $this->data['count']['count_day_three']=$count_day_three;
    $this->data['count']['count_day_four']=$count_day_four;
    $this->data['count']['count_day_five']=$count_day_five;
    $this->data['count']['count_day_six']=$count_day_six;
    $this->data['count']['count_day_seven']=$count_day_seven;
    $this->data['count']['count_overdue']=$count_overdue;
    $this->data['count']['count_finish_good']=$count_finish_good;


    $this->data['total_balance']=$balance_day_one+$balance_day_two+$balance_day_three+$balance_day_four+$balance_day_five+$balance_day_six+$balance_day_seven+$balance_overdue+$balance_finish_good;
    $this->data['total_balance_gross']=$balance_gross_day_one+$balance_gross_day_two+$balance_gross_day_three+$balance_gross_day_four+$balance_gross_day_five+$balance_gross_day_six+$balance_gross_day_seven+$balance_gross_overdue+$balance_gross_finish_good;
    $this->data['total_balance_fine']=$balance_fine_day_one+$balance_fine_day_two+$balance_fine_day_three+$balance_fine_day_four+$balance_fine_day_five+$balance_fine_day_six+$balance_fine_day_seven+$balance_fine_overdue+$balance_fine_finish_good;
  
   parent::view($users[0]['id']);
  }
}
