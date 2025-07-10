<?php
include_once APPPATH . "modules/daily_drawers/models/Daily_drawer_receipt_model.php";
class Api_daily_drawer_receipt_model extends Daily_drawer_receipt_model {
  public function __construct($data = array()) {
    parent::__construct($data);
    
  }
}