<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pending_balance_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('processes/process_model');
  }
}