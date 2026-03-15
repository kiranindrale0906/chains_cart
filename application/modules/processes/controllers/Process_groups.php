<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Process_groups extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model', 'processes/process_group_model'));
  }

  public function store() {
    if (!isset($_POST['process_ids'])) $_POST['process_ids'] = '';
    parent::store();
  }

  public function _after_save($formdata) {
    $this->data['redirect_url']= ADMIN_PATH.'rope_chains/ag_flattings';
    return $formdata;
  }

  public function _get_form_data() {
    $product_name = (isset($_GET['product_name'])) ? $_GET['product_name'] : $_POST['product_name'];
    $process_name = (isset($_GET['process_name'])) ? $_GET['process_name'] : $_POST['process_name'];
    $where['where']=array('product_name' => $product_name,
                          'out_weight >' => 0, 'balance' => 0);

    $where['where_in'] = array('process_name' => array('"'.$process_name.'"'));
   if ($product_name=='Casting Process')              $where['department_name'] = 'Melting';
    $processes = $this->process_model->get('id, department_name, process_name', $where); //array('product_name' => $product_name,
                                                          //'department_name' => $department_name));
    
    if (!empty($processes)) {
      $process_ids = array_column($processes, 'id');
      $process_fields = $this->process_group_model->get('process_id', array('where_in' => array('process_id' => $process_ids)));
      $used_process_ids = array_column($process_fields, 'process_id');
      if (!empty($used_process_ids)) $where['where_not_in']=array('id' => $used_process_ids);
    }

    $select = 'id, parent_id, lot_no, melting_lot_id, product_name, parent_lot_id, parent_lot_name, department_name,input_type';
    
    $this->data['flatting_processes'] = $this->process_model->get($select, $where);
    
    
    $this->data['process_name'] = $process_name;
  }
}