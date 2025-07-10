<?php
class Chain_model extends BaseModel{
  protected $table_name = 'chains';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'chains[name]',
                     'label' => 'name',
                     'rules' => array('trim','required',
                                      array('unique_name', 
                                      array($this, 'chain_unique'))),
                     'errors'=> array('required'=>'The Name field is required.',
                                      'unique_name' => "name must be unique."));
    return $rules;
  }

  public function chain_unique($name) {
    return parent::check_unique('name');
  }
}