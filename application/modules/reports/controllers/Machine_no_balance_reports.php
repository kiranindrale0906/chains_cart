<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Machine_no_balance_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model'));
  }

  public function index() {
    $this->get_department_balance();
    $this->load->render('reports/machine_no_balance_reports/index',$this->data);
  }

  function get_department_balance() {
    $balances = $this->process_model->get('product_name, department_name, SUM(balance) as balance, SUM(balance_gross) as balance_gross, SUM(balance_fine) as balance_fine', array('balance >' => 0,'machine_no!=' =>''), '', array('group_by' => array('product_name', 'department_name')));
    $this->data['machine_no_details'] = $balances;
  }
}