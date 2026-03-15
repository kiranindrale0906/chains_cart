<?php
include_once APPPATH . "modules/receipt_departments/models/Receipt_department_model.php";
class Api_receipt_department_model extends Receipt_department_model {
  public function __construct($data = array()) {
    parent::__construct($data);
    
  }
}