<?php
class Rhodium_receipts extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model('users/account_model','processes/process_archive_model');
  }

  // public function create() {
  //   echo 'Create rhodium receipts from Accounts.';
  //   die;
  // }

  public function store() {
    $this->data['validation_klass'] = 'store';
    parent::store();
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'receipt_departments/rhodium_receipts';
    return $formdata;
  }
}