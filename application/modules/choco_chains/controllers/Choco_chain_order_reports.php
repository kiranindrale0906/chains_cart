<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Choco_chain_order_reports extends BaseController {
  public function __construct(){
    parent::__construct();
  }

  public function index(){
    $this->data['orders'] = $this->model->get_order_details();
    $this->load->render('choco_chain_order_reports/report',$this->data);
  }
}