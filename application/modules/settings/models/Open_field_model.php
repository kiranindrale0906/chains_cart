<?php 

class Open_field_model extends BaseModel{
  protected $table_name = 'open_fields';

  public function __construct($data = array()){
    parent::__construct($data);
    
  }
  
  public function validation_rules($klass='') {
    $rules = array(
              array(
                  'field' => 'open_fields[in]',
                  'label' => 'IN Weight',
                  'rules' => array('trim','required','numeric')
              ),
              array(
                  'field' => 'open_fields[description]',
                  'label' => 'Description',
                  'rules' => array('trim','required')
              ),
              array(
                  'field' => 'open_fields[purity]',
                  'label' => 'Purity',
                  'rules' => array('trim','required','numeric')
              )
            );
    return $rules;
  }
}