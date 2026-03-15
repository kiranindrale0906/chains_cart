<?php
class Chain_receipts extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model('users/account_model','processes/process_archive_model');
  }

  // public function create() {
  //   echo 'Create chain receipts from Accounts.';
  //   die;
  // }

  public function store() {
    $this->data['validation_klass'] = 'store';
    parent::store();
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'receipt_departments/chain_receipts';
    return $formdata;
  }
}