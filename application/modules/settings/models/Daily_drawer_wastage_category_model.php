<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_drawer_wastage_category_model extends BaseModel {
  protected $table_name = 'daily_drawer_wastage_categories';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
              array('field' => 'daily_drawer_wastage_categories[product_name]', 'label' => 'product name',
                    'rules' => array('trim', 'required')),
              array('field' => 'daily_drawer_wastage_categories[process_name]', 'label' => 'process name',
                    'rules' => array('trim', 'required')),
              array('field' => 'daily_drawer_wastage_categories[department_name]', 'label' => 'department name',
                    'rules' => array('trim', 'required',array('unique_department',
                                            array($this, 'check_department_unique'))),
                    'errors'=> array('unique_department' => "The selected combination of product name, process name and department name  already exist.")),
              
              array('field' => 'daily_drawer_wastage_categories[name]', 'label' => 'Category Name',
                    'rules' => array('trim', 'required'))
            );
    return $rules;
  }

  public function check_department_unique(){
    $fields = array('product_name', 'process_name', 'department_name');
    return parent::check_unique($fields);
  }
}

