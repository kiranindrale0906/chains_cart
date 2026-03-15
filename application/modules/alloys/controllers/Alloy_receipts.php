<?php
class Alloy_receipts extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('settings/alloy_type_model','users/account_model','processes/process_archive_model'));
  }

  public function store() {
    $this->data['validation_klass'] = 'store';
    parent::store();
  }
  public function _get_form_data(){
    $this->data['alloy_types'] = $this->alloy_type_model->get('alloy_name as id,alloy_name as name');
  
  }

  public function _after_save($formdata, $action){
    $this->data['redirect_url']= ADMIN_PATH.'alloys/alloy_receipts';
    return $formdata;
  }
}