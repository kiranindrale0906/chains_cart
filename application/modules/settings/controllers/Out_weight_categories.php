<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Out_weight_categories extends BaseController {
  public function __construct(){
    parent::__construct();
  }

  public function _get_form_data(){
  	$department_name = $this->process_model->get('DISTINCT(department_name) as id,department_name as name',
                                                  array('(out_weight > 0)' => NULL,
                                                        'department_name not in (select department_name from out_weight_categories)'=>NULL),array(),
                                                  array('order_by'=>'department_name asc'));
  	$this->data['department_name'] = $department_name;
 
  }
}