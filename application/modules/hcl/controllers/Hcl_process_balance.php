<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hcl_process_balance extends BaseController {
  
  public function __construct(){

    parent::__construct();
    $this->redirect_after_save = 'index';
    $this->load->model(array('processes/process_model'));
  
  }
}