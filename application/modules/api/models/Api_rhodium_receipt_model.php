<?php
include_once APPPATH . "modules/receipt_departments/models/Rhodium_receipt_model.php";
class Api_rhodium_receipt_model extends Rhodium_receipt_model {
  public function __construct($data = array()) {
    parent::__construct($data);
    
  }
}