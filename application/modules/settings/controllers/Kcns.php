<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kcns extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('settings/city_model'));
  }
}
