<?php 

class Length_model extends BaseModel{
  protected $table_name = 'lengths';

  public function __construct($data = array()){
    parent::__construct($data);
    
  }
  
  public function validation_rules($klass='') {
    $rules = array(
        array(
          'field' => 'lengths[design_code]',
          'label' => 'Design Code',
          'rules' => array('trim', 'required', 'max_length[255]')
          ),
        array(
          'field' => 'lengths[range]',
          'label' => 'Range',
          'rules' => array('trim', 'required')
          ),
        array(
          'field' => 'lengths[weight]',
          'label' => 'Weight',
          'rules' => array('trim', 'required', 'numeric')
          ),
        array(
          'field' => 'lengths[length]',
          'label' => 'Length',
          'rules' => array('trim', 'required', 'numeric')
          )
        );
    return $rules;
  }
}