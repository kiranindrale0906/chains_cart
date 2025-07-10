<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . "modules/reports/controllers/Department_reports.php";

class Timing_reports extends Department_reports {
  public function __construct(){
    parent::__construct();
  }

  public function index() { 
    $this->department_report_dropdown_data();
    $this->get_department_timing_reports();
    $this->load->render('reports/timing_reports/index',$this->data);
  }
  
  private function get_department_timing_reports() {
    if(!empty($this->data['record']['product_name']))   $where['processes.product_name'] = $this->data['record']['product_name'];
    if(!empty($this->data['record']['process_name']))   $where['processes.process_name'] = $this->data['record']['process_name'];
    if(!empty($this->data['record']['department_name']))$where['processes.department_name'] = $this->data['record']['department_name']; 
    if(!empty($this->data['record']['from_date']))      $where['date(processes.completed_at) >='] = date('Y-m-d',strtotime($this->data['record']['from_date']));
    if(!empty($this->data['record']['to_date']))        $where['date(processes.completed_at )<='] = date('Y-m-d',strtotime($this->data['record']['to_date']));

    if(!empty($this->data['record']['department_name'])){
      $this->data['process_details'] = $this->model->get('design_code,machine_size,parent_lot_name,lot_no,product_name,process_name,department_name,in_weight,
                                                          out_weight,created_at,completed_at,TIMESTAMPDIFF(HOUR,created_at,completed_at) as diff',$where,array());
    }
  }
}