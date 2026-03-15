<?php
include_once APPPATH . "modules/domestic_internals/models/Domestic_internal_receipt_model.php";
class Api_domestic_internal_receipt_model extends Domestic_internal_receipt_model {
  public function __construct($data = array()) {
    parent::__construct($data); 
  }
}