<?php
include_once APPPATH . "modules/hallmarking/models/Hallmark_receipt_process_model.php";
class Api_hallmark_receipt_process_model extends Hallmark_receipt_process_model {
  public function __construct($data = array()) {
    parent::__construct($data); 
  }
}