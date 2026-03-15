<?php
include_once APPPATH . "modules/receipt_departments/models/Stone_receipt_model.php";
class Api_stone_receipt_model extends Stone_receipt_model {
  public function __construct($data = array()) {
    parent::__construct($data); 
  }
}