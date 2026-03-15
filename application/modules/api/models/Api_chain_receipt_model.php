<?php
include_once APPPATH . "modules/receipt_departments/models/Chain_receipt_model.php";
class Api_chain_receipt_model extends Chain_receipt_model {
  public function __construct($data = array()) {
    parent::__construct($data);
    
  }
}