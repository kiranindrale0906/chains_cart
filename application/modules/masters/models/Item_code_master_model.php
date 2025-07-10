<?php
class Item_code_master_model extends BaseModel{
  protected $table_name = 'item_code_masters';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'item_code_masters[product_name]',
                     'label' => 'Product name',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Product Name field is required.'));
    $rules[] = array('field' => 'item_code_masters[melting]',
                     'label' => 'Melting',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Melting field is required.'));
    $rules[] = array('field' => 'item_code_masters[item_code]',
                     'label' => 'Item Code',
                     'rules' => array('trim','required'),
                     'errors'=> array('required'=>'The Item Code field is required.'));
    return $rules;
  }
}