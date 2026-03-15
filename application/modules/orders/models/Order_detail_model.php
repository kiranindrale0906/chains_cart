<?php
class order_detail_model extends BaseModel{
  protected $table_name = 'order_details';
  protected $id = 'id';
  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function validation_rules($klass='', $index=0) {
    $rules = array(array( 
      'field' => 'order_details[value]',
      'label' => 'Value',
      'rules' => array('trim')));
    return $rules;
  }
}