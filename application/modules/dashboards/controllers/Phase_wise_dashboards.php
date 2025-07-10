<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Phase_wise_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('users/user_model','processes/process_model','processes/process_field_model','arc_orders/generate_lot_model'));
  }

  public function index() {
   $users = $this->user_model->get('*');
   $phase_one_wise_count = $this->generate_lot_model->get('sum(lot_weight) total_lot_weight,count(*) count_weight,status',array(),array(),array('group_by'=>'status'));
   foreach($phase_one_wise_count as $index=>$value){
	$count=$value['count_weight'];
	$balance=$value['total_lot_weight'];
	if ($count > 0)
        $this->data['cards'][$value['status']]['weight'] = $balance;
        $this->data['cards'][$value['status']]['count'] = $count;
   }
   $this->get_dashboard_report_card_data();

    parent::view($users[0]['id']);
  }
  private function get_dashboard_report_card_data(){
    $department_names = $this->process_model->get('DISTINCT(department_name) as department_name',array('department_name != "" and department_name!="Start"'=>NULL));
    
    $total_balance=$total_balance_fine=$total_balance_gross=0;
    foreach($department_names as $department_key => $department_name){
      $where_condition = array();
      $where_condition['where'] = array('balance >' =>0,'department_name!=' =>"Start"); 
      if($department_name['department_name'] == 'Melting'){
        $where_condition['where_in'] = array('department_name' =>array('"Melting"', '"PL Melting"', '"AG Melting"')); 
      }elseif($department_name['department_name'] == "Buffing"){
        $where_condition['where_in'] = array('department_name' =>array('"Buffing"', '"Buffing II"', '"PL Buffing"')); 
      }elseif($department_name['department_name'] == "Buffing Hold"){
        $where_condition['where_in'] = array('department_name' =>array('"Buffing Hold"', '"Buffing Hold I"')); 
      }elseif($department_name['department_name'] == "Hand Cutting"){
        $where_condition['where_in'] = array('department_name' =>array('"Hand Cutting"', '"Hand Cutting II"'));
      }elseif($department_name['department_name'] == "HCL"){
        $where_condition['where_in'] = array('department_name' =>array('"HCL Process"','"HCL"')); 
      }elseif($department_name['department_name'] == "GPC"){
        $where_condition['where_in'] = array('department_name' =>array('"GPC"', '"Bunch GPC"', '"GPC OR Rodium"')); 
      }else{
        $where_condition = array('balance >' => 0, 'department_name' => $department_name['department_name']);
      }

      if (!(empty($this->data['lot_no']))) $where_condition['lot_no'] = $this->data['lot_no'];
      if (!(empty($this->data['record']['in_lot_purity']))) $where_condition['in_lot_purity'] = $this->data['record']['in_lot_purity'];
//echo "<pre>". $department_name['department_name'];      
      $department_records = $this->process_model->find('count(*) as count, round(sum(balance), 4) as balance,round(sum(balance_gross), 4) as balance_gross,round(sum(balance_fine), 4) as balance_fine',$where_condition);

      $count = $department_records['count'];
      $balance = $department_records['balance'];
      $total_balance +=$department_records['balance'];
      $total_balance_fine +=$department_records['balance_fine'];
      $total_balance_gross +=$department_records['balance_gross'];
      if(empty($balance))
        $balance = '0.00';
      $make_department_name = '';
      if(!empty($department_name['department_name']))
        $make_department_name = str_replace(" ","_",strtolower($department_name['department_name']));
      //if(!empty($make_department_name))
      //  $make_department_name = $make_department_name;   
//      if ($count > 0)
        $this->data['cards'][$make_department_name]['weight'] = $balance;
        $this->data['cards'][$make_department_name]['count'] = $count;

    }
//pd($this->data['cards']);
    $this->data['phase_1']['weight']=(!empty($this->data['cards']['In Printing']['weight'])?$this->data['cards']['In Printing']['weight']:0)
                                    +(!empty($this->data['cards']['Tree Ready']['weight'])?$this->data['cards']['Tree Ready']['weight']:0)
                                    +(!empty($this->data['cards']['Completed']['weight'])?$this->data['cards']['Completed']['weight']:0)
                                    +(!empty($this->data['cards']['Print OK']['weight'])?$this->data['cards']['Print OK']['weight']:0);

   $this->data['phase_2']['weight']=(!empty($this->data['cards']['In Investment']['weight'])?$this->data['cards']['In Investment']['weight']:0
                                    )+(!empty($this->data['cards']['melting']['weight'])?$this->data['cards']['melting']['weight']:0
                                    )+(!empty($this->data['cards']['hardening']['weight'])?$this->data['cards']['hardening']['weight']:0
                                    )+(!empty($this->data['cards']['casting']['weight'])?$this->data['cards']['casting']['weight']:0);  

   $this->data['phase_3']['weight']=(!empty($this->data['cards']['segregation']['weight'])?$this->data['cards']['segregation']['weight']:0
                                  )+(!empty($this->data['cards']['factory_hold']['weight'])?$this->data['cards']['factory_hold']['weight']:0
                                  )+(!empty($this->data['cards']['grinding']['weight'])?$this->data['cards']['grinding']['weight']:0
                                  )+(!empty($this->data['cards']['filing']['weight'])?$this->data['cards']['filing']['weight']:0
                                  )+(!empty($this->data['cards']['filing_ii']['weight'])?$this->data['cards']['filing_ii']['weight']:0
                                  )+(!empty($this->data['cards']['filing_iii']['weight'])?$this->data['cards']['filing_iii']['weight']:0
                                  )+(!empty($this->data['cards']['lock_filing']['weight'])?$this->data['cards']['lock_filing']['weight']:0
                                  )+(!empty($this->data['cards']['magnet']['weight'])?$this->data['cards']['magnet']['weight']:0
                                  )+(!empty($this->data['cards']['refiling']['weight'])?$this->data['cards']['refiling']['weight']:0
                                  )+(!empty($this->data['cards']['refiling_ii']['weight'])?$this->data['cards']['refiling_ii']['weight']:0
                                  )+(!empty($this->data['cards']['refiling_iii']['weight'])?$this->data['cards']['refiling_iii']['weight']:0
                                  )+(!empty($this->data['cards']['stone_setting']['weight'])?$this->data['cards']['stone_setting']['weight']:0
                                  )+(!empty($this->data['cards']['meena']['weight'])?$this->data['cards']['meena']['weight']:0
                                  )+(!empty($this->data['cards']['meena_filing']['weight'])?$this->data['cards']['meena_filing']['weight']:0
                                  )+(!empty($this->data['cards']['pasta']['weight'])?$this->data['cards']['pasta']['weight']:0);
//pd($this->data['cards']);
   $this->data['phase_4']['weight']=(!empty($this->data['cards']['correction']['weight'])?$this->data['cards']['correction']['weight']:0
                                )+(!empty($this->data['cards']['buffing']['weight'])?$this->data['cards']['buffing']['weight']:0
                                )+(!empty($this->data['cards']['hand_dull']['weight'])?$this->data['cards']['hand_dull']['weight']:0
                                )+(!empty($this->data['cards']['hand_cutting']['weight'])?$this->data['cards']['hand_cutting']['weight']:0
                                )+(!empty($this->data['cards']['hallmark_out']['weight'])?$this->data['cards']['hallmark_out']['weight']:0
                                )+(!empty($this->data['cards']['buffing_refresh']['weight'])?$this->data['cards']['buffing_refresh']['weight']:0
                                )+(!empty($this->data['cards']['gpc_rhodium']['weight'])?$this->data['cards']['gpc_rhodium']['weight']:0
                                )+(!empty($this->data['cards']['packing']['weight'])?$this->data['cards']['packing']['weight']:0);


    $this->data['phase_1']['count']=$this->data['cards']['In Printing']['count']+$this->data['cards']['Tree Ready']['count']+$this->data['cards']['Completed']['count']+$this->data['cards']['Print OK']['count'];

   $this->data['phase_2']['count']=$this->data['cards']['In Investment']['count']+$this->data['cards']['melting']['count']+$this->data['cards']['hardening']['count']+$this->data['cards']['casting']['count'];
   
   $this->data['phase_3']['count']=$this->data['cards']['segregation']['count']+$this->data['cards']['factory_hold']['count']+$this->data['cards']['grinding']['count']+$this->data['cards']['filing']['count']+$this->data['cards']['filing_ii']['count']+$this->data['cards']['filing_iii']['count']+$this->data['cards']['lock_filing']['count']+$this->data['cards']['magnet']['count']+$this->data['cards']['refiling']['count']+$this->data['cards']['refiling_ii']['count']+$this->data['cards']['refiling_iii']['count']+$this->data['cards']['stone_setting']['count']+$this->data['cards']['meena']['count']+$this->data['cards']['meena_filing']['count']+$this->data['cards']['pasta']['count'];
   
   $this->data['phase_4']['count']=$this->data['cards']['correction']['count']+$this->data['cards']['buffing']['count']+$this->data['cards']['hand_dull']['count']+$this->data['cards']['hand_cutting']['count']+$this->data['cards']['hallmark_out']['count']+$this->data['cards']['buffing_refresh']['count']+$this->data['cards']['gpc_rhodium']['count']+$this->data['cards']['packing']['count'];


    $this->data['total_of_balance']['balance']=$total_balance;
    $this->data['total_of_balance']['balance_gross']=$total_balance_gross;
    $this->data['total_of_balance']['balance_fine']=$total_balance_fine;
  }
}
