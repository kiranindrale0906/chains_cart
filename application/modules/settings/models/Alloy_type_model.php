<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Alloy_type_model extends BaseModel {
  protected $table_name = 'alloy_types';
  protected $id = 'id';
  public $router_class = 'alloy_types';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass=''){
  	$rules = array(array(
                    'field' => 'alloy_types[alloy_name]',
                    'label' => 'Alloy name',
                    'rules' => 'trim|required|is_unique[alloy_types.alloy_name]'));
    return $rules;
  }

  function maximumCheck($num){
    if ($num > 100) return FALSE;
    else return TRUE;
	}

}