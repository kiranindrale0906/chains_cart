<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Length_cart_model extends BaseModel {
  protected $table_name = 'length_carts';
  public $router_class = 'length_carts';
  //protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }
  
  public function validation_rules($klass='') {//pd($this->formdata);
    $rules = array();
    $rules= array(
              array('field' => $this->router_class.'[length_cart_details][quantity]', 'label' => 'Quantity',
                        'rules' => 'trim')
            );
//    $rules = $this->association_validation_rules($rules,'length_cart_details','length_cart_detail_model');
    return $rules;
  }
          
    function after_save($action) {//pd($this->formdata);
    if (isset($this->formdata['length_cart_details'])) {
      foreach ($this->formdata['length_cart_details'] as $index => $length_cart_detail) {
        if(!empty($length_cart_detail['design_code'])){
          $length_cart_detail_obj = new length_cart_detail_model($length_cart_detail);
          $length_cart_detail_obj->attributes['length_cart_id'] = $this->formdata['length_carts']['id'];
          $length_cart_detail_obj->save();
        }
      }
    }
  }
}