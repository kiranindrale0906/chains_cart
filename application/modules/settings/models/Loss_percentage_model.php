<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Loss_percentage_model extends BaseModel {
  protected $table_name = 'loss_percentages';
  protected $id = 'id';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules() {
    $rules = array(
              array('field' => 'loss_percentages[product_name]', 'label' => 'product name',
                    'rules' => array('trim', 'required')),
              array('field' => 'loss_percentages[process_name]', 'label' => 'process name',
                    'rules' => array('trim', 'required')),
              array('field' => 'loss_percentages[department_name]', 'label' => 'department name',
                    'rules' => array('trim', 'required')),
              array('field' => 'loss_percentages[karigar_name]', 'label' => 'karigar_name',
                    'rules' => array('trim', 
                                      array('unique_karigar',
                                            array($this, 'check_karigar_unique'))),
                    'errors'=> array('unique_karigar' => "The selected combination of product name, process name and department name and karigar name already exist.")),
              array('field' => 'loss_percentages[loss_percentage]', 'label' => 'loss percentage',
                    'rules' => array('trim', 'required', 'numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]')),
              array('field' => 'loss_percentages[max_loss_percentage]', 'label' => ' max loss percentage',
                    'rules' => array('trim', 'required', 'numeric', 'greater_than_equal_to[0]', 'less_than_equal_to[100]')),
            );
    return $rules;
  }

  public function check_karigar_unique(){
    $fields = array('product_name', 'process_name', 'department_name','karigar_name');
    return parent::check_unique($fields);
  }
}

