<?php
class Stock_abbreviation_model extends BaseModel{
  protected $table_name = 'stock_abbreviations';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'stock_abbreviations[name]',
                     'label' => 'Customer name',
                     'rules' => array('trim','required',
                                      array('unique_name', 
                                      array($this, 'name_unique'))),
                     'errors'=> array('required'=>'The Name field is required.',
                                      'unique_name' => "Name must be unique."));
    $rules[] = array('field' => 'stock_abbreviations[abbreviation]',
                     'label' => 'Abbreviations',
                     'rules' => array('trim','required',
                                      array('unique_abbreviation_name', 
                                      array($this, 'abbreviation_name_unique'))),
                     'errors'=> array('required'=>'The Abbreviations field is required.',
                                      'unique_abbreviation_name' => "Customer name must be unique."));
    return $rules;
  }

  public function name_unique($name) {
    return parent::check_unique('name');
  }
  public function abbreviation_name_unique($name) {
    return parent::check_unique('abbreviation');
  }
}