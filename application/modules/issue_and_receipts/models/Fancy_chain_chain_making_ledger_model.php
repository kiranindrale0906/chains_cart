<?php 
include_once APPPATH . "modules/issue_and_receipts/models/Ledger_model.php";
class Fancy_chain_chain_making_ledger_model extends Ledger_model{
  protected $table_name= 'processes';
  
  public function __construct($data = array()){
    parent::__construct($data);
  }
}