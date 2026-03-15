<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Adjustment_record_model extends BaseModel {
  protected $table_name = 'adjustment_records';
  public $router_class = 'adjustment_records';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
              array('field' => 'adjustment_records[balance]', 'label' => 'Balance',
                    'rules' => array('trim', 'required')),
              array('field' => 'adjustment_records[balance_gross]', 'label' => 'Balance Gross','rules' => array('trim', 'required')),
              array('field' => 'adjustment_records[balance_fine]', 'label' => 'Balance Fine','rules' => array('trim', 'required')),
             );
    return $rules;
  }
}