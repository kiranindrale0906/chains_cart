<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Department_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model'));
  }

  public function index() {
    $this->data['lot_no'] = isset($_POST['lot_no']) ? $_POST['lot_no'] : '';
    if(!empty($this->data['lot_no'])){
      $this->data['lot_no']=$this->data['lot_no'];
    }elseif(!empty($_GET['lot_no'])){
      $this->data['lot_no']=$_GET['lot_no'];
    }
    $this->data['in_lot_purity'] = $this->process_model->get('distinct(in_lot_purity) as name,in_lot_purity as id');
    $this->data['record']['in_lot_purity'] = isset($_GET['in_lot_purity']) ? $_GET['in_lot_purity'] : '';
    $this->get_dashboard_report_card_data();
    parent::view($_SESSION['user_id']);
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
        $where_condition['where_in'] = array('department_name' =>array('"Hand Cutting"'));
      }elseif($department_name['department_name'] == "Hand Cutting II"){
        $where_condition['where_in'] = array('department_name' =>array('"Hand Cutting II"'));
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
      if ($count > 0)
        $this->data['cards'][$make_department_name] = $balance.' ('.$count.')';
    }

    $this->data['total_of_balance']['balance']=$total_balance;
    $this->data['total_of_balance']['balance_gross']=$total_balance_gross;
    $this->data['total_of_balance']['balance_fine']=$total_balance_fine;
  }
}
