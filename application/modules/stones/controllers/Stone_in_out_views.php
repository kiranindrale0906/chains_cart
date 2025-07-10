<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stone_in_out_views extends BaseController {	
	
  public function __construct(){
	 parent::__construct();
	 $this->load->model(array('processes/process_model', 'processes/process_field_model','daily_drawers/view_daily_drawer_summary_model',
                              'daily_drawers/daily_drawer_receipt_model','issue_departments/issue_department_model'));
  } 

  public function index() {
    $where = array();
    $this->data['column'] = (isset($_GET['column']) ? $_GET['column'] : '');

    $type = str_replace('_', ' ', $_GET['type']);
    $where = array('in_lot_purity' => $_GET['purity']);
    // if (HOST != 'ARF')
      // $where['type'] = '"'.$type.'"';


    if(isset($_GET['karigar'])){
        $karigar = str_replace('_', ' ', $_GET['karigar']);
        $where['karigar']=$karigar;
    }

    if(isset($_GET['column'])&&$_GET['column']=='in_weight')             $where['stone_out !=']= 0;
    if(isset($_GET['column'])&&$_GET['column']=='out_weight')            $where['stone_in !=']= 0;
    if(!empty($_GET['chain_name']))                                      $where['chain_name']=str_replace('_',' ',$_GET['chain_name']);
    
      $this->data['stones']=$this->process_model->get('`processes`.`id` AS `process_id`, `processes`.`lot_no` AS `lot_no`, `processes`.`product_name` AS `product_name`, `processes`.`department_name` AS `department_name`, `processes`.`stone_out` AS `in_weight`, `processes`.`stone_in` AS `out_weight`, `processes`.`issue_daily_drawer_wastage` AS `issue_daily_drawer_wastage`, `processes`.`hook_kdm_purity` AS `hook_kdm_purity`, `processes`.`process_name` AS `daily_drawer_type`, `processes`.`type` AS `type`, `processes`.`karigar` AS `karigar`, `processes`.`chain_name` AS `chain_name`, `processes`.`created_at` AS `created_at`, `processes`.`is_delete` AS `is_delete`', $where,array(),array('order_by'=>'created_at desc'));
      // pd($this->data['stones']);
    
    $this->load->render('stone_in_out_views/index', $this->data);
  }
}

 
  
