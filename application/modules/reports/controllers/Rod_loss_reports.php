<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rod_loss_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('settings/rod_model', 'processes/process_model'));
  }

  public function index() { 
    $this->data['lot_loss_records'] = array();
		$this->get_rod_loss_report_details();
    $this->load->render('reports/rod_loss_reports/index', $this->data);    
  } 

  private function get_rod_loss_report_details() {
    $rod_name=$this->rod_model->get('name');


    $this->data['rod_loss_reports']=$this->process_model->get('sum(in_weight) as in_weight,
                                                                sum(in_rod) as in_rod,
                                                                sum(out_rod) as out_rod,
                                                                sum(out_weight) as out_weight,
                                                                sum(loss) as loss,
                                                                rod_id,
                                                                rods.name as name
                                                                ',
                                                                array('department_name'=>'Melting','rod_id!='=>0),
                                                                array(array('rods',  'processes.rod_id=rods.id')),
                                                                array('group_by'=>'rod_id'));


  }
}