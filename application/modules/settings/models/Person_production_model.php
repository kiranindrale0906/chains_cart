<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Person_production_model extends BaseModel {
  protected $table_name = 'person_productions';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
                  array('field' => 'person_productions[process_name]', 'label' => 'Process Name','rules' => array('trim', 'required')),
                  array('field' => 'person_productions[department_name]', 'label' => 'Department name',
                          'rules' => array('trim', 'required')),
                   array('field' => 'person_productions[no_of_person]', 'label' => 'No of Person',
                          'rules' => array('trim', 'required')),
                  );
    return $rules;
  }
}
