<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Worker_model extends BaseModel {
  protected $table_name = 'workers';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
                  array('field' => 'workers[name]', 'label' => 'Name',
                          'rules' => array('trim', 'required')),
                  array('field' => 'workers[department_name]', 'label' => 'Department name',
                          'rules' => array('trim', 'required')),
                  );
    return $rules;
  }
}
