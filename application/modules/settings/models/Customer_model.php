<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends BaseModel {
  protected $table_name = 'customers';
  protected $id = 'id';
  public $router_class = 'customers';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass=''){
  	$rules = array(array(
                    'field' => 'customers[name]',
                    'label' => 'Customer name',
                    'rules' => 'trim|required'));
    return $rules;
  }
}