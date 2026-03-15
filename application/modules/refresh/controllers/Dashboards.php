<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboards extends BaseController {
  public function __construct(){
    $this->_model = 'refresh_chain_dashboard_model';
    parent::__construct();
    $this->redirect_after_save = 'view';

    $this->load->model(array('users/user_model','processes/process_model','refresh/refresh_model'));
  }

  public function index() {
  	$users = $this->user_model->get('*');
    $dashboard_core_data = $this->refresh_chain_dashboard_model->dashboard_common_data('Refresh');
    foreach($dashboard_core_data as $dashboard_key => $dashboard_value)
      $this->data[$dashboard_key] = $dashboard_value;

    $this->data['process_balance'] = $this->refresh_chain_dashboard_model->process_balance();
    $this->data['deparment_process_balance'] = 
                              $this->refresh_chain_dashboard_model->department_wise_process_balance();

    $this->data['refresh_purity_wise_list'] = $this->process_model->get(
                                                    'sum(balance) as balance,in_lot_purity',
                                                    array('balance >'=>0,'product_name'=>'Refresh'),'',array('group_by'=>'in_lot_purity'));
    $this->data['refresh_design_code_wise_list'] = $this->refresh_model->get(
                                                    'sum(balance) as balance,design_code',
                                                    array('balance >'=>0),'',array('group_by'=>'design_code'));       

    $this->data['refresh_gpc_design_code_wise_list'] = $this->refresh_model->get(
                                                    'sum(balance) as balance,design_code',
                                                    array('balance >'=>0,'department_name'=>'GPC'),'',array('group_by'=>'design_code')); 

    $this->data['refresh_melting_department_wise_list'] = $this->refresh_model->get(
                                                    'sum(balance) as balance,department_name',
                                                    array('balance >'=>0,'department_name'=>'Melting'),'',array('group_by'=>'department_name'));   

    $this->data['refresh_gpc_purity_wise_list'] = $this->refresh_model->get(
                                                    'sum(balance) as balance,in_lot_purity',
                                                    array('balance >'=>0,'department_name'=>'GPC'),'',array('group_by'=>'in_lot_purity'));                                                                

  	parent::view($users[0]['id']);
  }
}