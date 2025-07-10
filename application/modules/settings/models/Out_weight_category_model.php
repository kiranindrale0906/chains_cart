<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Out_weight_category_model extends BaseModel {
  protected $table_name = 'out_weight_categories';
  protected $id = 'id';
  public $router_class = 'out_weight_categories';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass=''){
  	$rules = array(array(
                    'field' => 'out_weight_categories[department_name]',
                    'label' => 'Department name',
                    'rules' => array('trim', 'required')),
                    array(
                    'field' => 'out_weight_categories[name]',
                    'label' => 'Loss category name',
                    'rules' => array('trim', 'required',
                                      array('unique_purity',
                                            array($this, 'check_unique_purity'))),
                    'errors'=> array('unique_purity' => "The combination of department name and  category name already exist.")),
            );
    return $rules;
  }
    public function check_unique_purity(){
    $fields = array('department_name', 'name');
    return parent::check_unique($fields);
  }

}