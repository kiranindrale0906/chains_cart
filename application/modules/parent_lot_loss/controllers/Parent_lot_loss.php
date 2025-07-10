<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parent_lot_loss extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('melting_lots/melting_lot_model', 'processes/process_model',
                             'rope_chains/rope_chain_final_process_model'));
  }

  public function index() { 
    $this->data['lot_loss_records'] = array();
    $this->data['process_name'] = get_parent_lot_process();
    $this->data['product_name'] = !empty($_GET['product_name']) ? $_GET['product_name']:'';
    $this->data['with_detail'] = !empty($_GET['detail']) ? $_GET['detail'] : '';
    $this->data['type'] = !empty($_GET['type']) ? $_GET['type'] : '';
    if (!empty($this->data['product_name'])) 
      $this->data['lot_loss_records'] = $this->model->get_parent_lot_loss($this->data['product_name'],$this->data['type'],$this->data['with_detail']);
    $this->load->render('parent_lot_loss/parent_lot_loss/index', $this->data);    
  } 

  

  
}
