<?php
class Customer_abbreviation_model extends BaseModel{
  protected $table_name = 'customer_abbreviations';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'customer_abbreviations[customer_name]',
                     'label' => 'Customer name',
                     'rules' => array('trim','required',
                                      array('unique_name', 
                                      array($this, 'customer_unique'))),
                     'errors'=> array('required'=>'The Customer Name field is required.',
                                      'unique_name' => "Customer name must be unique."));
    $rules[] = array('field' => 'customer_abbreviations[abbreviation]',
                     'label' => 'Abbreviations',
                     'rules' => array('trim','required',
                                      array('unique_abbreviation_name', 
                                      array($this, 'abbreviation_name_unique'))),
                     'errors'=> array('required'=>'The Abbreviations field is required.',
                                      'unique_abbreviation_name' => "Customer name must be unique."));
    return $rules;
  }

  public function customer_unique($name) {
    return parent::check_unique('customer_name');
  }
  public function abbreviation_name_unique($name) {
    return parent::check_unique('abbreviation');
  }
}