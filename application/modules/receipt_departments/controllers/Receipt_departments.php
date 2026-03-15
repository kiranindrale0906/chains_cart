<?php
class Receipt_departments extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('users/account_model','processes/process_field_model','processes/process_archive_model'));
  }

  // public function create() {
  //   if (HOST != 'ARC' && ENVIRONMENT == 'production'){
  //     echo 'Create metal receipts from Accounts.';
  //     die;
  //   }else{
  //     parent::create();
  //   }
  // }

  public function store() {
    ini_set('memory_limit', '-1');
    $this->data['validation_klass'] = 'store';
    parent::store();
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'receipt_departments/receipt_departments';
    return $formdata;
  }
  public function delete($id, $conditions = array(), $permanent_delete = true, $after_delete = true){
    parent::delete($id,$conditions,$permanent_delete,$after_delete);
  } 
}
