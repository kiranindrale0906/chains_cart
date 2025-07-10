<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karigar_report_parent_lot_wise extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model('processes/process_model');
    $this->redirect_after_save = 'view';
  }

 
}