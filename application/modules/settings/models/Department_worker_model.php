<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_worker_model extends BaseModel {
  public $router_class = 'department_workers';
  protected $table_name= 'department_workers';
  public function __construct($data = array()){
      parent::__construct($data);
  }

  public function validation_rules($klass='',$index=0) {
    $rules= array(
              array('field' => 'department_workers['.$index.'][date]', 'label' => 'Date',
                        'rules' => 'trim|required'),
              array('field' => 'department_workers['.$index.'][worker_count]', 'label' => 'No.of Workers',
                        'rules' => 'trim|required|numeric')
            );
    return $rules;
  }
}