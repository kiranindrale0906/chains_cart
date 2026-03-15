<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hcl_wastages extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->load->model(array('melting_lots/melting_lot_model','processes/process_model'));
  }
}
