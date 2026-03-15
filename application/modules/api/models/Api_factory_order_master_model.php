<?php
include_once APPPATH . "modules/ka_chains/models/Ka_chain_factory_order_master_model.php";
class Api_factory_order_master_model extends Ka_chain_factory_order_master_model {
  public function __construct($data = array()) {
    parent::__construct($data);
    
  }
}