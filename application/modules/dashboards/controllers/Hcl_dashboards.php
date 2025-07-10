<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hcl_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_model'));
 		
  }

  public function index() {
  	$users = $this->user_model->get('*');
    $dashboard_core_data = $this->hcl_dashboard_model->dashboard_common_data();
    foreach($dashboard_core_data as $dashboard_key => $dashboard_value)
      $this->data[$dashboard_key] = $dashboard_value;
    $this->data['hcl_wastage_list'] = $this->process_model->get('sum(balance_hcl_wastage) as balance_hcl_wastage, lot_no',array('balance_hcl_wastage >'=>0),'',array('group_by'=>'lot_no'));
  
    $this->data['hcl_process_list'] = $this->process_model->get('sum(balance) as balance, lot_no',array('product_name'=>'HCL'),'',array('group_by'=>'lot_no'));

    $this->data['rope_ghiss_process_list'] = $this->process_model->get('sum(balance_hcl_ghiss) as balance_hcl_ghiss, lot_no',array('balance_hcl_ghiss >'=>0),'',array('group_by'=>'lot_no'));
   
    parent::view($users[0]['id']);
  }
}