<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Loss_category_model extends BaseModel {
  protected $table_name = 'loss_categories';
  protected $id = 'id';
  public $router_class = 'loss_categories';

  function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass=''){
  	$rules = array(array(
                    'field' => 'loss_categories[department_name]',
                    'label' => 'Department name',
                    'rules' => array('trim', 'required')),
                    array(
                    'field' => 'loss_categories[name]',
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