<?php

class Rooms extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model'));
  }

  public function _get_form_data(){
   $this->data['department_names']=$this->process_model->get('distinct(department_name) as name,(department_name) as id',
                                                              array('department_name != '=> 'Start',
                                                                    'department_name not in (select department_name from rooms)' => NULL),
                                                              array(), array('order_by'=>'department_name asc')); 
  }
}
