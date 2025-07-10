<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Wastage_melting_dashboards extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
 		
  }

  public function index() {
  	$users = $this->user_model->get('*');
    $dashboard_core_data = $this->wastage_melting_dashboard_model->dashboard_common_data('','Wastage Melting');
    foreach($dashboard_core_data as $dashboard_key => $dashboard_value)
      $this->data[$dashboard_key] = $dashboard_value;
    
    parent::view($users[0]['id']);
  }
}