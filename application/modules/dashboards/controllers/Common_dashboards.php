<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_dashboards extends BaseController {
  public function __construct(){

    parent::__construct();
    $this->redirect_after_save = 'view';
 		
  }

  public function index() {
    // $qr_code = generate_qrcode('ThisisdemotextThisisbhaskar','37.79');
    // echo $qr_code2;die;
  	$users = $this->user_model->get('*');
    $dashboard_core_data = $this->common_dashboard_model->dashboard_common_data();
    foreach($dashboard_core_data as $dashboard_key => $dashboard_value)
      $this->data[$dashboard_key] = $dashboard_value;

    $model_names = model_names();
    foreach($model_names as $model_name){
    	$this->load->model($model_name[0].'/'.$model_name[1]);
    	$model_name_set = $model_name[1];
    	$this->data['process_balance_custom'][$model_name[0]] = $this->$model_name_set->process_balance();

    	$this->data['deparment_process_balance_custom'][$model_name[0]] = 
              $this->$model_name_set->department_wise_process_balance($model_name[0]);
                     
    }
  	
    parent::view($users[0]['id']);
  }
}