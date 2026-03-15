<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customers extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('settings/customer_model'));
  }
}
