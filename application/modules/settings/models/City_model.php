<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends BaseModel {
  protected $table_name = 'cities';
  protected $id = 'id';
  public $router_class = 'cities';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass=''){
  	$rules = array(array(
                    'field' => 'cities[name]',
                    'label' => 'City name',
                    'rules' => 'trim|required'));
    return $rules;
  }
}