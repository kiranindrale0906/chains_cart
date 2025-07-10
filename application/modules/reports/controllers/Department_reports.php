<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH . "modules/reports/helpers/department_reports_helper.php");

class Department_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/same_karigar_model','settings/department_worker_model','settings/department_model','processes/process_field_model'));
  }

  protected function department_report_dropdown_data() { 
    $this->data['layout']       = 'application';
    $this->data['products']     = $this->process_model->get('distinct(product_name) as name,product_name as id');
    $this->data['processes']    = $this->process_model->get('distinct(process_name) as name,process_name as id');
    $this->data['departments']  = $this->process_model->get('distinct(department_name) as name,department_name as id');
    $this->data['karigars']    = $this->process_model->get('distinct(karigar) as name,karigar as id');
    // $data['departments']  = array();
    $group_by = array();
    
    $this->get_department_filter_data();
  }
  
  private function get_department_filter_data() {
    $this->data['record']['product_name']     = !empty($_GET[$this->router->class]['product_name'])    ? $_GET[$this->router->class]['product_name'] : '';
    $this->data['record']['process_name']     = !empty($_GET[$this->router->class]['process_name']) ? $_GET[$this->router->class]['process_name'] : '';
    $this->data['record']['department_name']  = !empty($_GET[$this->router->class]['department_name'])    ? $_GET[$this->router->class]['department_name'] : '';
    $this->data['record']['karigar_name']     = !empty($_GET[$this->router->class]['karigar_name'])    ? $_GET[$this->router->class]['karigar_name'] : '';
    $this->data['record']['hours']            = !empty($_GET[$this->router->class]['hours'])    ? $_GET[$this->router->class]['hours'] : '';
    $this->data['record']['from_date']        = !empty($_GET[$this->router->class]['from_date'])    ? $_GET[$this->router->class]['from_date'] : '';
    $this->data['record']['to_date']          = !empty($_GET[$this->router->class]['to_date'])    ? $_GET[$this->router->class]['to_date'] : '';
  }
}