<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Gpc_powder_internal_model extends BaseModel {
  protected $table_name = 'gpc_powder_internals';
  protected $id = 'id';
  public $router_class = 'gpc_powder_internals';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass=''){
  	$rules = array(array(
                    'field' => 'gpc_powder_internals[weight]',
                    'label' => 'Weight',
                    'rules' => 'trim|required'));
    return $rules;
  }
}