<?php
class Domestic_category_master_model extends BaseModel{
  protected $table_name = 'domestic_category_masters';

  public function __construct($data=array()) {
    parent::__construct($data);
  }

  public function before_validate() {
    $this->attributes['design_code']=trim($this->attributes['design_code']);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'domestic_category_masters[product_name]',
                     'label' => 'Product name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Product Name field is required.'));
    $rules[] = array('field' => 'domestic_category_masters[design_code]',
                     'label' => 'Design name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Design Code field is required.'));
    $rules[] = array('field' => 'domestic_category_masters[rate_per_gram]',
                     'label' => 'Rate Per Gram',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Rate Per Gram field is required.'));
    $rules[] = array('field' => 'domestic_category_masters[account_name]',
                     'label' => 'Account name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Account Name field is required.'));
    return $rules;
  }
}