<?php
class Process_detail_field_model extends BaseModel{
  protected $table_name = 'process_detail_fields';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'process_detail_fields[process_name]',
                     'label' => 'Process name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Process Name field is required.'));
    $rules[] = array('field' => 'process_detail_fields[product_name]',
                     'label' => 'Product name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Product Name field is required.'));
    $rules[] = array('field' => 'process_detail_fields[department_name]',
                     'label' => 'Module name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Department Name field is required.'));
    $rules[] = array('field' => 'process_detail_fields[field_name]',
                     'label' => 'Model name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Field Name field is required.'));
    return $rules;
  }
}