<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kcn_model extends BaseModel {
  protected $table_name = 'kcns';
  protected $id = 'id';
  public $router_class = 'kcns';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass=''){
  	$rules = array(array(
                    'field' => 'kcns[weight]',
                    'label' => 'Weight',
                    'rules' => 'trim|required'));
    return $rules;
  }
}