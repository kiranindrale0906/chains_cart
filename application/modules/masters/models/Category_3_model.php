<?php
class Category_3_model extends BaseModel{
  protected $table_name = 'category_3';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'category_3[category_name]',
                     'label' => 'Category name',
                     'rules' => array('trim','required',
                                      array('unique_name', 
                                      array($this, 'category_unique'))),
                     'errors'=> array('required'=>'The Category Name field is required.',
                                      'unique_name' => "Category name must be unique."));
    $rules[] = array('field' => 'category_3[chain_name]',
                     'label' => 'Chain name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Chain Name field is required.'));
    return $rules;
  }

  public function category_unique($name) {
    return parent::check_unique('category_name');
  }
}