<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Internal_wastage_model extends BaseModel {
  protected $table_name = 'internal_wastages';
  public $router_class = 'internal_wastages';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
              array('field' => 'internal_wastages[name]', 'label' => 'Name',
                    'rules' => array('trim', 'required')),
              array('field' => 'internal_wastages[wastage]', 'label' => 'Wastage',
                    'rules' => array('trim', 'required')),
            );
    return $rules;
  }

}