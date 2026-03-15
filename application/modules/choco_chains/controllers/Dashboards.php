<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboards extends BaseController {
  public function __construct(){
    $this->_model = 'choco_chain_dashboard_model';
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('users/user_model','processes/process_model','choco_chains/choco_chain_machine_process_model','choco_chains/choco_chain_final_process_model','choco_chain_ag_model'));
    
  }

  public function index() {
  	$users = $this->user_model->get('*');

    $dashboard_core_data = $this->choco_chain_dashboard_model->dashboard_common_data('Choco Chain');
    foreach($dashboard_core_data as $dashboard_key => $dashboard_value)
      $this->data[$dashboard_key] = $dashboard_value;

    $this->data['process_balance'] = $this->choco_chain_dashboard_model->process_balance();

    $this->data['deparment_process_balance'] = 
                              $this->choco_chain_dashboard_model->department_wise_process_balance();

    $this->data['chain_making'] = $this->choco_chain_machine_process_model->get('sum(balance) as balance ,karigar,in_lot_purity',array('balance>'=>0),array(),array('group_by'=>'karigar,in_lot_purity'));


    $this->data['final_processes'] = $this->choco_chain_final_process_model->get('sum(balance) as balance,department_name',array('department_name!='=>'Start','balance>'=>0),array(),array('group_by'=>'department_name,id','order_by'=>'id'));
  

    $this->data['chain_making_count'] = $this->choco_chain_machine_process_model->find('sum(balance) as balance ,karigar,in_lot_purity','','',array('group_by'=>'karigar,in_lot_purity'))['balance'];

  	parent::view($users[0]['id']);
  }

  
}