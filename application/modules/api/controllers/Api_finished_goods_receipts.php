<?php
include_once APPPATH . "modules/receipt_departments/controllers/Finished_goods_receipts.php";
class Api_finished_goods_receipts extends Finished_goods_receipts {
  public function __construct() {
    parent::__construct();
  }
}