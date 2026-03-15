<?php
class Colour_abbreviation_model extends BaseModel{
  protected $table_name = 'colour_abbreviations';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'colour_abbreviations[colour_name]',
                     'label' => 'colour name',
                     'rules' => array('trim','required',
                                      array('unique_name', 
                                      array($this, 'colour_unique'))),
                     'errors'=> array('required'=>'The colour Name field is required.',
                                      'unique_name' => "colour name must be unique."));
    $rules[] = array('field' => 'colour_abbreviations[abbreviation]',
                     'label' => 'Abbreviations',
                     'rules' => array('trim','required',
                                      array('unique_abbreviation_name', 
                                      array($this, 'abbreviation_name_unique'))),
                     'errors'=> array('required'=>'The Abbreviations field is required.',
                                      'unique_abbreviation_name' => "colour name must be unique."));
    return $rules;
  }

  public function colour_unique($name) {
    return parent::check_unique('colour_name');
  }
  public function abbreviation_name_unique($name) {
    return parent::check_unique('abbreviation');
  }
}