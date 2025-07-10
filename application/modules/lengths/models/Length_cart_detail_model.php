<?php 

class Length_cart_detail_model extends BaseModel{
  public $router_class = 'length_cart_details';
  protected $table_name= 'length_cart_details';
  public function __construct($data = array()){
    parent::__construct($data);
    
  }
  
  public function validation_rules($klass='',$index=0) {
    $rules = array();
    /*$rules= array(
              array('field' => 'length_cart_details['.$index.'][quantity]', 'label' => 'No.of Workers',
                        'rules' => 'trim|required|numeric')
            );*/
    return $rules;
  }
}