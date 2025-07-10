<?php
include_once APPPATH . "modules/receipt_departments/models/Hallmark_receipt_model.php";
class Api_hallmark_receipt_model extends Hallmark_receipt_model {
  public function __construct($data = array()) {
    parent::__construct($data);
    
  }
}