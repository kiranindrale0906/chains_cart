<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . "modules/core_users/controllers/Core_login.php";
class Login extends Core_login {
  public function __construct() {
    parent::__construct();
    $this->load->helper('core_users/core_login');
  }
}
