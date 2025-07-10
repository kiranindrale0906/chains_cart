<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Same_karigar_model extends BaseModel {
  protected $table_name = 'karigars';
  public $router_class = 'same_karigars';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
              array('field' => 'same_karigars[product_name]', 'label' => 'product name',
                    'rules' => array('trim', 'required')),
              array('field' => 'same_karigars[process_name]', 'label' => 'process name',
                    'rules' => array('trim', 'required')),
              array('field' => 'same_karigars[department_name]', 'label' => 'department name',
                    'rules' => array('trim', 'required')),
              array('field' => 'same_karigars[due_duration]', 'label' => 'Due duration',
                    'rules' => array('trim', 'required')), 

              /*array('field' => 'same_karigars[capacity]', 'label' => 'Capacity',
                    'rules' => array('trim', 'required')),*/
              array('field' => 'same_karigars[karigar_name]', 'label' => 'karigar name',
                    'rules' => array('trim',
                                      array('unique_karigar',
                                            array($this, 'check_karigar_unique'))),
                    'errors'=> array('unique_karigar' => "The selected combination of product name, process name, department name and karigar name already exist."))
            );
    return $rules;
  }

  public function check_due_date_greater_then($date){
    if(strtotime($date) >= strtotime(date('Y-m-d'))){
      return true;
    }
    return false;
  }

  public function check_karigar_unique(){
    $fields = array('product_name', 'process_name', 'department_name', 'karigar_name');
    return parent::check_unique($fields);
  }

  public function get_product_process_department_data() {
    $rows = $this->get('');
    $data = array();
    foreach ($rows as $key => $row) {
      $data[$row['product_name']][$row['process_name']][$row['department_name']][] = $row['karigar_name'];
    }
    return $data;
  }

  /* functions for dropdowns */

  public function get_product_dropdown(){
    return $this->get_product_process_department_field();
  }

  public function get_process_dropdown($product_name){
    return $this->get_product_process_department_field('dropdown', $product_name);
  }

  public function get_department_dropdown($product_name='', $process_name=''){
    return $this->get_product_process_department_field('dropdown', $product_name, $process_name);
  }

  public function get_karigar_dropdown($product_name, $process_name, $department_name){
    return $this->get_product_process_department_field('dropdown', $product_name, $process_name, $department_name);
  }

  /* end functions for dropdown */

  /* functions for checkbox */

  public function get_product_checkbox(){
    return $this->get_product_process_department_field('checkbox');
  }

  public function get_process_checkbox($product_name){
    return $this->get_product_process_department_field('checkbox', $product_name);
  }

  public function get_department_checkbox($product_name, $process_name){
    return $this->get_product_process_department_field('checkbox', $product_name, $process_name);
  }

  public function get_karigar_checkbox($product_name, $process_name, $department_name){
    return $this->get_product_process_department_field('checkbox', $product_name, $process_name, $department_name);
  }

  /* end functions for checkboxes */


  function get_product_process_department_field($field_type = 'dropdown', $product_name = null, $process_name = null, $department_name = null){

    $data         = $this->get_product_process_department_data();
    $options      = array();
    $option_data = array();

    if($product_name == null && $process_name == null && $department_name == null) {
      $option_data = $data;
    }

    if($product_name !== null && $process_name == null && $department_name == null) {
      if(isset($data[$product_name])){
        $option_data = $data[$product_name];
      }
    }

    if($product_name !== null && $process_name != null && $department_name == null) {
      if(isset($data[$product_name][$process_name]))
        $option_data = $data[$product_name][$process_name];
    }

    if($product_name !== null && $process_name != null && $department_name != null) {
      if(isset($data[$product_name][$process_name][$department_name]))
        $option_data = $data[$product_name][$process_name][$department_name];
    }
    
    $options = generate_options_array($option_data);

    if($field_type == 'dropdown')
      return generate_dropdown($options);
    elseif ($field_type == 'checkbox') {
      return generate_checkboxes($options);
    }
  }

}