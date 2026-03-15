<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hcl_lot_wise_reports extends BaseController {
  
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model(array('processes/process_out_wastage_detail_model'));
  
  }

  public function index(){
  	$get_hcl_wastage = $this->process_out_wastage_detail_model->get('process_out_wastage_details.out_weight,
  																																	proc.lot_no,processes.product_name,processes.process_name,processes.department_name',
  														array(),
  														array(
  															array('processes','process_out_wastage_details.parent_id = processes.id','INNER JOIN'),
  															array('processes as proc','process_out_wastage_details.process_id = proc.id','LEFT JOIN'),
  														));
  	
  	$this->data['record']['hcl_wastage_data'] = $get_hcl_wastage;
  	parent::view(1);
  }
}