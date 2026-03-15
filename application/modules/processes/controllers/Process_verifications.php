<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_verifications extends BaseController {
    public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/category_model'));
    $this->redirect_after_save = 'view';
  }
  public function _get_form_data(){
    $this->data['record']['process_id']=!empty($_GET['process_id'])?$_GET['process_id']:0;
    if(!empty($_POST)&&$_POST['process_verifications']['process_id']){
    $this->data['record']['process_id']=!empty($_POST['process_verifications']['process_id'])?$_POST['process_verifications']['process_id']:0;
    }
  }
  public function _after_save($formdata, $action){
    $this->data['redirect_url'] = base_url().'stock_summary_reports/stock_reports';
  }
}