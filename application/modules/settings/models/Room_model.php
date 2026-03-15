<?php 

class Room_model extends BaseModel {
  protected $table_name = 'rooms';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
      array('field' => 'rooms[name]', 'label' => 'Name',
              'rules' => array('trim', 'required')),
      array('field' => 'rooms[department_name]', 'label' => 'Department name',
              'rules' => array('trim', 'required')),
    );
    return $rules;
  }
}
