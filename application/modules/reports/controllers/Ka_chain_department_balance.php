<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ka_chain_department_balance extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model'));
  }

  public function index() {
    $this->get_department_balance();
    if(isset($_GET['return']) && $_GET['return'] == 'json')
      echo json_encode($this->data);
    else
      $this->load->render('reports/ka_chain_department_balance/index',$this->data);
  }

  function get_department_balance() {
    $balances = $this->process_model->get('product_name, department_name, SUM(balance) as balance, SUM(balance_gross) as balance_gross, SUM(balance_fine) as balance_fine', array('balance >' => 0,'product_name'=>'KA Chain'), '', array('group_by' => array('department_name')));
    $department_balance = array();
    foreach ($balances as $balance) {
      $department_name = $balance['department_name'];
      unset($balance['product_name'], $balance['department_name']);
      $department_balance[$department_name] = $balance;
    }
    $this->data['department_balance'] = $department_balance;
  }
}