<?php
class Pushnotification_logs extends BaseController {
  public function __construct() {
    parent::__construct();
  }
  public function view($id=''){
  	$data = $_SERVER['REQUEST_URI'];
  	pr($data);
  }
}