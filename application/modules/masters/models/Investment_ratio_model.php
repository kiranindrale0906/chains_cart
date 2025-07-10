<?php
class Investment_ratio_model extends BaseModel{
  protected $table_name = 'investment_ratios';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'investment_ratios[purity]',
                     'label' => 'Purity',
                     'rules' => array('trim','required'));
    $rules[] = array('field' => 'investment_ratios[colour]',
                     'label' => 'Colour',
                     'rules' => array('trim','required'));
    $rules[] = array('field' => 'investment_ratios[ratio]',
                     'label' => 'Ratio',
                     'rules' => array('trim','required'));
    return $rules;
  }
}