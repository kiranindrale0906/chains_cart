<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Monthly_targets extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('settings/monthly_target_model'));
  }
}
