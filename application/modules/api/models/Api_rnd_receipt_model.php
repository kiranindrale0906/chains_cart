<?php
include_once APPPATH . "modules/rnds/models/Rnd_receipt_model.php";
class Api_rnd_receipt_model extends Rnd_receipt_model {
  public function __construct($data = array()) {
    parent::__construct($data); 
  }
}