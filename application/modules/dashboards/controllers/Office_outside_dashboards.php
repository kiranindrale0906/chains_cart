<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Office_outside_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('users/user_model'));
 		
  }

  public function index() {
  	$users = $this->user_model->get('*');
    $dashboard_core_data = $this->office_outside_dashboard_model->dashboard_common_data('','Office Outside');
    foreach($dashboard_core_data as $dashboard_key => $dashboard_value)
      $this->data[$dashboard_key] = $dashboard_value;
    
    parent::view($users[0]['id']);
  }
}