<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Truncate_ci_sessions extends BaseController {
  public function __construct(){
    parent::__construct();
  }
  public function index() {
    pd('hii');
    $this->db->truncate('ci_sessions');
  }
}