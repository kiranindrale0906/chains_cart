<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process_outsides extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('settings/category_four_model', 'processes/process_model'));
    $this->redirect_after_save = 'view';
  }
  
  public function _after_save($formdata, $action){
    $this->data['redirect_url']= $_SERVER['HTTP_REFERER'];
    return $formdata;
  }
}