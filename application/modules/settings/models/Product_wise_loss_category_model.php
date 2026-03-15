<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_wise_loss_category_model extends BaseModel {
  protected $table_name = 'product_wise_loss_categories';
  public $router_class = 'product_wise_loss_categories';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
              array('field' => 'product_wise_loss_categories[product_name]', 'label' => 'product name',
                    'rules' => array('trim', 'required')),
              array('field' => 'product_wise_loss_categories[process_name]', 'label' => 'process name',
                    'rules' => array('trim', 'required')),
              array('field' => 'product_wise_loss_categories[department_name]', 'label' => 'department name',
                    'rules' => array('trim', 'required')),
              array('field' => 'product_wise_loss_categories[category]', 'label' => 'Category',
                    'rules' => array('trim',array('unique_category',
                                            array($this, 'check_category_unique'))),
                    'errors'=> array('unique_category' => "The selected combination of product name, process name, department name and category name already exist."))
            );
    return $rules;
  }

  public function check_category_unique(){
    $fields = array('product_name', 'process_name', 'department_name', 'category');
    return parent::check_unique($fields);
  }
 

}