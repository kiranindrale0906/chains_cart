<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Process_ledgers extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model'));
  }

  public function index() {
    if (isset($_GET['rebuild'])) {
      $this->model->create_ledger_entries();
      redirect(ADMIN_PATH.'processes/process_ledgers');
    }

    $this->data['product_name'] = $_GET['product_name'] ?? '';
    $this->data['lot_no'] = $_GET['lot_no'] ?? '';
    $this->data['field_name'] = $_GET['field_name'] ?? '';
    $this->data['lot_process_group'] = $_GET['lot_process_group'] ?? 'lot_no';
    $this->data['process_id'] = $_GET['process_id'] ?? 0;
    $this->data['field_breakup_for_lot_group'] = $_GET['field_breakup_for_lot_group'] ?? 'id';
    
    $fields = 'sum(in_weight - out_weight) as weight_difference, product_name';
    $this->data['ledger_summary_records'] = $this->model->get($fields, array(), array(), 
                                                            array('group_by' => 'product_name', 
                                                                  'having' => 'weight_difference != 0'));
    
    if (!empty($this->data['product_name']) && $this->data['lot_process_group']=='lot_no') {
      $fields .= ', lot_no';
      $this->data['lot_summary_records'] = $this->model->get($fields, array('product_name' => $this->data['product_name']), array(), 
                                                            array('group_by' => 'lot_no', 
                                                                  'having' => 'weight_difference != 0'));
      
    }

    if (!empty($this->data['product_name'])) {
      $fields .= ', '.$this->data['lot_process_group'];
      $this->data['lot_summary_records'] = $this->model->get($fields, array('product_name' => $this->data['product_name']), array(), 
                                                            array('group_by' => $this->data['lot_process_group'], 
                                                                  'having' => 'weight_difference != 0'));
      
    }

    if (!empty($this->data['lot_no'])) {
      $this->data['lotwise_process_records'] = $this->model->check_process_balance_by_lot_no($this->data['lot_no']);

      $fields = 'lot_no, sum(in_weight) as in_weight, sum(out_weight) as out_weight, field_name ';
      $this->data['lot_field_summary_records'] = $this->model->get($fields, array('product_name' => $this->data['product_name'],
                                                                             'lot_no' => $this->data['lot_no']), array(), 
                                                            array('group_by' => 'field_name'));
      
    }

    if (!empty($this->data['field_name'])) {
      
      $where = array('product_name' => $this->data['product_name'],
                     'lot_no' => $this->data['lot_no'],
                     '(in_weight !=0 or out_weight != 0)' => NULL);
      if($this->data['field_name']!='All Fields')
        $where['field_name'] = $this->data['field_name'];

      $group_order_by = array('order_by' => 'process_id');
      $group_order_by['group_by'] = $this->data['field_breakup_for_lot_group'];
      
      $fields = 'process_id, process_name, department_name, field_name, sum(in_weight) as in_weight, sum(out_weight) as out_weight ';
      $this->data['field_breakup_for_lot_records'] = $this->model->get($fields, $where, array(), $group_order_by);
      
    }

    if ($this->data['process_id'] != 0) {
      $fields = 'process_id, department_name, field_name, in_weight, out_weight ';
      $this->data['field_breakup_for_process_records'] = $this->model->get($fields, array('product_name' => $this->data['product_name'],
                                                                               'process_id' => $this->data['process_id'],
                                                                               '(in_weight !=0 or out_weight != 0)' => NULL), array());
      
    }

    $this->load->render('processes/process_ledgers/index', $this->data);
  }
}
