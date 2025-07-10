<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_rolling_model extends BaseModel {
  protected $table_name = 'product_rollings';
  public $router_class = 'product_rollings';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
              array('field' => 'product_rollings[chain_name]', 'label' => 'Chain name',
                    'rules' => array('trim', 'required')),
              array('field' => 'product_rollings[balance_gross]', 'label' => 'Balance Gross',
                    'rules' => array('trim', 'required'))
            );
    return $rules;
  }
}