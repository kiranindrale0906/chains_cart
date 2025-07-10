<?php
class Refresh_departments extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('refresh/refresh_hold_model','refresh/refresh_internal_gpc_process_model', 'processes/process_model'));
    $this->redirect_after_save = 'view';
  }

  // public function create() {
  //   echo 'Create Refresh receipts from Accounts.';
  //   die;
  // }

  public function store() {
    $this->data['validation_klass'] = 'store';
    parent::store();
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'refresh/refresh_departments/';
  }
}