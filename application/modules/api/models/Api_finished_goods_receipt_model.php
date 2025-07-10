<?php
include_once APPPATH . "modules/receipt_departments/models/Finished_goods_receipt_model.php";
class Api_finished_goods_receipt_model extends Finished_goods_receipt_model {
  public function __construct($data = array()) {
    parent::__construct($data);    
  }
}