<?php
class Processes_name_model extends BaseModel{
  protected $table_name = 'processes_name';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'processes_name[process_name]',
                     'label' => 'Process name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Process Name field is required.'));
    $rules[] = array('field' => 'processes_name[product_name]',
                     'label' => 'Product name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Product Name field is required.'));
    $rules[] = array('field' => 'processes_name[module_name]',
                     'label' => 'Module name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Module Name field is required.'));
    $rules[] = array('field' => 'processes_name[model_name]',
                     'label' => 'Model name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Model Name field is required.'));
    $rules[] = array('field' => 'processes_name[controller_name]',
                     'label' => 'Controller name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Controller Name field is required.'));
    return $rules;
  }
}