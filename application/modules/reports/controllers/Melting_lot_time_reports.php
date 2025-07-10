
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Melting_lot_time_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('melting_lots/melting_lot_model','processes/process_model', 'settings/karigar_model','arc_orders/generate_lot_model'));
  }

  public function index(){
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', '0');
    $this->data['record']['in_process_balance_data']=array();

    $melting_lot_ids=$this->process_model->get('melting_lot_id',array('melting_lot_id!='=>0,'balance >'=>0));
    $melting_lot_ids=array_column($melting_lot_ids,'melting_lot_id');
  	$where_condition['where'] = array('balance >' =>0); 
    $where_condition['melting_lot_id !='] = 0; //$melting_lot_ids; 
    $process_where_condition=$where_condition;
    if(!empty($_GET['product_name'])){
      $where_condition['product_name'] = $_GET['product_name'];
      $this->data['record']['product_name']= $_GET['product_name'];
    }if(!empty($_GET['genarate_lot_no'])){
      $where_condition['account'] = $_GET['genarate_lot_no'];
      $this->data['record']['genarate_lot_no']= $_GET['genarate_lot_no'];
    }if(!empty($_GET['customer_name'])){
      $this->data['record']['customer_name']= $_GET['customer_name'];
    }if(!empty($_GET['order_type'])){
     $this->data['record']['order_type']= $_GET['order_type'];
    }
     $in_process_balance_data = $this->process_model->get('processes.department_name department_name,processes.process_name process_name,processes.balance balance,processes.melting_lot_id melting_lot_id,processes.id id,product_name as product_name,processes.created_at as melting_date,processes.in_weight as melting_weight ,processes.in_lot_purity lot_purity,processes.created_at created_at,melting_lots.created_at melting_created_date,processes.account as genarate_lot_no',$where_condition,array(array('melting_lots','melting_lots.id=processes.melting_lot_id')),array('order_by'=>"melting_lots.created_at"));
//pd($in_process_balance_data);
     $order_type_filter = isset($_GET['order_type']) ? $_GET['order_type'] : '';
     $customer_name_filter = isset($_GET['customer_name']) ? $_GET['customer_name'] : '';

// Initialize the filtered array
$filtered_in_process_balance_data = [];
    $this->data['product_names'] = $this->process_model->get('product_name as name,product_name id',array('melting_lot_id!='=>0,'balance!='=>0),array(),array('group_by'=>'product_name'));
    $this->data['genarate_lots'] = $this->process_model->get('account as name,account id',array('account!='=>""),array(),array('group_by'=>'account'));
    $this->data['order_types'] = $this->generate_lot_model->get('order_type as name,order_type id',array('order_type!='=>""),array(),array('group_by'=>'order_type'));
    $this->data['customer_names'] = $this->generate_lot_model->get('customer_name as name,customer_name id',array('customer_name!='=>""),array(),array('group_by'=>'customer_name'));
    foreach ($in_process_balance_data as $in_process_balance_index => $in_process_balance_value) { 
      $melting_lot=$this->melting_lot_model->find('',array('id'=>$in_process_balance_value['melting_lot_id'],'gross_weight >'=>0),array(),array('order_by'=>'created_at asc'));
      $generate_lot=$this->generate_lot_model->find('',array('lot_no'=>$in_process_balance_value['genarate_lot_no']));

      $matches_order_type = empty($order_type_filter) || $generate_lot['order_type'] == $order_type_filter;
      $matches_customer_name = empty($customer_name_filter) || $generate_lot['customer_name'] == $customer_name_filter;

    // Check if either filter matches
    if ($matches_order_type && $matches_customer_name) {
      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]=$in_process_balance_value;
      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['lot_no']=$melting_lot['lot_no'];
      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['melting_date']=$melting_lot['created_at'];
      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['department_name']=$in_process_balance_value['department_name'];
      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['process_name']=$in_process_balance_value['process_name'];
      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['balance']=$in_process_balance_value['balance'];
      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['customer_name']=$generate_lot['customer_name'];
      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['order_date']=$generate_lot['order_date'];
      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['order_type']=$generate_lot['order_type'];
      $today_date = date('Y-m-d');
      $date1 = date('Y-m-d',strtotime($in_process_balance_value['melting_created_date']));
      $date2 = date('Y-m-d',strtotime($today_date));
      $diff = abs(strtotime($date2) - strtotime($date1));
      $delay_diff = abs(strtotime($date2) - strtotime($today_date));
      $delay_years = floor($delay_diff / (365*60*60*24));
      $years = floor($diff / (365*60*60*24));
      $delay_months = floor(($delay_diff - $delay_years * 365*60*60*24) / (30*60*60*24));
      $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
      $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
      $delay_days = floor(($delay_diff - $delay_years * 365*60*60*24 - $delay_months*30*60*60*24)/ (60*60*24));
      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['diff_melting_date_with_complted_date']='years: '.$years.' months: '.$months.' days: '.$days;
      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['live_date']=$today_date;

      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['delay']=$delay_days;
      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['is_out_off_time']=($months!=0 || $days>10)?1:0;

      $this->data['record']['in_process_balance_data'][$in_process_balance_value['product_name']][date('d-m-Y',strtotime($melting_lot['created_at']))][$melting_lot['id']][$in_process_balance_index]['is_out_off_delay_time']=($delay_days>2)?1:0;
}}

//pd($this->data['record']['in_process_balance_data']);
$melting_lot_detail = $this->process_model->get('product_name as product_name',$where_condition,array(),array('group_by'=>"product_name"));

    $process_karigars=$this->process_model->get('karigar',array('karigar!=""'=>NULL),array(),array('group_by'=>"karigar"));
    $process_karigars=array_column($process_karigars,'karigar');
//pd($process_karigars);
      foreach ($melting_lot_detail as $melting_lot_detail_key => $melting_lot_detail_value) {
      $karigars = $this->karigar_model->get('karigar_name,hook_kdm_purity,chain_name',array("chain_name"=>$melting_lot_detail_value['product_name'],"hook_kdm_purity!="=>0,"karigar_name"=>$process_karigars));
//      pd($karigars);	//      lq();
       foreach ($karigars as $karigar_key => $karigar_value) {
        $process_dd_karigar_detail=$this->process_model->find('sum((daily_drawer_in_weight - ((hook_in - hook_out)+(sisma_in - sisma_out) + daily_drawer_out_weight)))-sum(spring_vatav) as balance,
                          sum((daily_drawer_in_weight - ((hook_in - hook_out)+(sisma_in - sisma_out) + daily_drawer_out_weight)))-sum(spring_vatav) as balance_gross,
                          sum((daily_drawer_in_weight - ((hook_in - hook_out)+(sisma_in - sisma_out) + daily_drawer_out_weight)) * hook_kdm_purity / 100)-sum((spring_vatav)* hook_kdm_purity / 100) as balance_fine',array('type!='=>"GPC Powder",'karigar'=>$karigar_value['karigar_name'],'hook_kdm_purity'=>$karigar_value['hook_kdm_purity']));

//pd($process_dd_karigar_detail);  
      if(!empty($process_dd_karigar_detail['balance'])&&$process_dd_karigar_detail['balance']!=0){
           $this->data['record']['in_process_balance_dd_karigar_data'][$melting_lot_detail_value['product_name']][$karigar_value['karigar_name'].':'.$karigar_value['hook_kdm_purity']]=$process_dd_karigar_detail;
        }
      }
    }
//pd($this->data['record']);  
	parent::view(1);//
  } 
}
