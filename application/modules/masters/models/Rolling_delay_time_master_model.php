<?php
class Rolling_delay_time_master_model extends BaseModel{
  protected $table_name = 'rolling_delay_time_masters';

  public function __construct($data=array()) {
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {
    $rules[] = array('field' => 'rolling_delay_time_masters[product_name]',
                     'label' => 'Product name',
                     'rules' => array('trim','required'),
                    );
    return $rules;
  }

  public function category_unique($name) {
    return parent::check_unique('product_name');
  }
}