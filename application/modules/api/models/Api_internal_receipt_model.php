<?php
include_once APPPATH . "modules/internals/models/Internal_receipt_model.php";
class Api_internal_receipt_model extends Internal_receipt_model {
  public function __construct($data = array()) {
    parent::__construct($data); 
  }
}