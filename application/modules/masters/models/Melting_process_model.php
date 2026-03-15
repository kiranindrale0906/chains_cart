<?php
class Melting_process_model extends BaseModel{
  protected $table_name = 'melting_processes';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'melting_processes[purity]',
                     'label' => 'Purity',
                     'rules' => array('trim','required'));
    $rules[] = array('field' => 'melting_processes[colour]',
                     'label' => 'Colour',
                     'rules' => array('trim','required'));
    $rules[] = array('field' => 'melting_processes[process_name]',
                     'label' => 'Process Name',
                     'rules' => array('trim','required',
                                      array('unique_name', 
                                      array($this, 'check_unique'))),
                     'errors'=> array('required'=>'The Name field is required.',
                                      'unique_name' => "Process name must be unique."));
    return $rules;
  }

  public function check_unique($name) {
    return parent::check_unique('process_name');
  }
}