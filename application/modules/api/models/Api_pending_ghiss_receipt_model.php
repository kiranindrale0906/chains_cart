<?php
include_once APPPATH . "modules/receipt_departments/models/Pending_ghiss_receipt_model.php";
class Api_pending_ghiss_receipt_model extends Pending_ghiss_receipt_model {
  public function __construct($data = array()) {
    parent::__construct($data);
    
  }
}