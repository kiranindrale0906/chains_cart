<?php
include_once APPPATH . "modules/export_internals/models/Export_internal_receipt_model.php";
class Api_export_internal_receipt_model extends Export_internal_receipt_model {
  public function __construct($data = array()) {
    parent::__construct($data); 
  }
}