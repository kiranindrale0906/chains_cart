<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Melting_lot_alloy_details extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model'));
  }

}
