<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Machine_no_production_reports extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model', 'processes/process_detail_model',
                             'masters/machine_master_model', 'masters/process_detail_field_model'));
  }
  
  public function index() {
    $this->get_search_dropdowns();
    $this->set_data_parameters();
    
    if (   !empty($this->data['record']['product_name'])
        && !empty($this->data['record']['process_name'])
        && !empty($this->data['record']['department_name'])) {
      $this->get_machine_details();
      $this->get_date_range(); 
      $this->get_date_wise_process_outweights();
      $this->get_utilization_wise_process_outweights();
    }

    $this->load->render('reports/machine_no_production_reports/index', $this->data);
  }

  private function get_search_dropdowns() {
    $where=array('machine_no!='=>'');
    $this->data['product_names'] = $this->process_model->get('distinct(product_name) as name, product_name as id', $where);
    $this->data['process_names'] = $this->process_model->get('distinct(process_name) as name, process_name as id', $where);
    $this->data['department_names'] = $this->process_model->get('distinct(department_name) as name, department_name as id', $where);
    $this->data['machine_nos']  = $this->process_model->get('distinct(machine_no) as name, (machine_no) as id', $where);
  }

  private function set_data_parameters() {
    $this->data['record']['product_name'] = $_GET['machine_no_production_reports']['product_name'] ?? '';
    $this->data['record']['process_name'] = $_GET['machine_no_production_reports']['process_name'] ?? '';
    $this->data['record']['department_name'] = $_GET['machine_no_production_reports']['department_name'] ?? '';
    $this->data['record']['machine_no'] = $_GET['machine_no_production_reports']['machine_no'] ?? '';
    $this->data['record']['from_date'] = $_GET['machine_no_production_reports']['from_date'] ?? '';
    $this->data['record']['to_date'] = $_GET['machine_no_production_reports']['to_date'] ?? '';
    $this->data['record']['under_utilization'] = $_GET['machine_no_production_reports']['under_utilization'] ?? '';
    $this->data['record']['group_by'] = $_GET['machine_no_production_reports']['group_by'] ?? '';
  }

  private function get_machine_details() {
    $where = array();

    if (!empty($this->data['record']['product_name'])) $where['product_name'] = $this->data['record']['product_name'];
    if (!empty($this->data['record']['process_name'])) $where['process_name'] = $this->data['record']['process_name'];
    if (!empty($this->data['record']['department_name'])) $where['department_name'] = $this->data['record']['department_name'];
    if (!empty($this->data['record']['machine_no'])) $where['machine_name'] = $this->data['record']['machine_no'];
    
    $machines = $this->machine_master_model->get('machine_name, machine_size, out_capacity, machine_count', $where);

    $this->data['machines'] = array();
    foreach ($machines as $machine) {
      $group_by = ($this->data['record']['group_by']=='Machine Size') ? 'machine_size' : 'machine_name';
      if (!isset($this->data['machines'][$machine[$group_by]]))
        $this->data['machines'][$machine[$group_by]] = array('out_capacity' => 0, 'machine_count' => 0);
                                                              
      $this->data['machines'][$machine[$group_by]]['out_capacity'] = $machine['out_capacity'];
      $this->data['machines'][$machine[$group_by]]['machine_count'] += $machine['machine_count'];
    }
  }

  private function get_process_out_weights() {
    if (!empty($this->data['record']['product_name']))
        $where['processes.product_name'] = $this->data['record']['product_name'];

    if (!empty($this->data['record']['process_name']))
      $where['processes.process_name'] = $this->data['record']['process_name'];
    
    if (!empty($this->data['record']['department_name']))
      $where['processes.department_name'] = $this->data['record']['department_name'];

    if (!empty($this->data['record']['machine_no']))
      $where['processes.machine_no'] = $this->data['record']['machine_no'];
    else
      $where['processes.machine_no != '] = '';

    $process_detail_field = $this->process_detail_field_model->find('id', array('product_name' => $this->data['record']['product_name'],
                                                                      'process_name' => $this->data['record']['process_name'],
                                                                      'department_name' =>$this->data['record']['department_name'],
                                                                      'field_name' => 'out_weight'));

    $group_by = ($this->data['record']['group_by']=='Machine Size') ? 'processes.machine_size' : 'processes.machine_no';

    if (empty($process_detail_field)) {
      if(!empty($this->data['record']['from_date']))       
        $where['date(processes.completed_at) >='] = date('Y-m-d',strtotime($this->data['record']['from_date']));

      if(!empty($this->data['record']['to_date']))         
        $where['date(processes.completed_at) <='] = date('Y-m-d',strtotime($this->data['record']['to_date']));

      $process_outweights  = $this->process_model->get('id, '.$group_by.' as machine_no, 
                                                        date(completed_at) as completed_at, sum(out_weight) as out_weight', 
                                                        $where, array(), array('group_by' => $group_by.', date(completed_at)'));
    } else {
      if(!empty($this->data['record']['from_date']))       
        $where['date(process_details.created_at) >='] = date('Y-m-d',strtotime($this->data['record']['from_date']));

      if(!empty($this->data['record']['to_date']))         
        $where['date(process_details.created_at) <='] = date('Y-m-d',strtotime($this->data['record']['to_date']));

      $process_outweights  = $this->process_detail_model->get('processes.id, '.$group_by.' as machine_no, 
                                                        date(process_details.created_at) as completed_at, 
                                                        sum(process_details.out_weight) as out_weight', 
                                                        $where, array(array('processes', 'processes.id=process_details.process_id')),
                                                         array('group_by' => $group_by.', date(process_details.created_at)'));
    }
    return $process_outweights;
  }

  private function get_date_range() {
    $end = new DateTime($this->data['record']['to_date']);
    $end = $end->modify( '+1 day' ); 

    $period = new DatePeriod(new DateTime($this->data['record']['from_date']),
                             new DateInterval('P1D'),
                             $end);
    $date_count = iterator_count($period); 

    if ($this->data['record']['group_by']!='Date')   
      $period = array($this->data['record']['from_date'].' to '.$this->data['record']['to_date']);
    else
      $date_count = 1;

    $this->data['outweights'] = array();
    foreach ($this->data['machines'] as $machine_no => $machine_capacity) {
      foreach ($period as $date) {
        $date_in_ymd = ($this->data['record']['group_by']=='Date') ? $date->format('Y-m-d') : $date;

        if ($this->data['record']['group_by']=='Machine Size')
          $shortfall = $this->data['machines'][$machine_no]['out_capacity'] * $date_count;
        else
          $shortfall = $this->data['machines'][$machine_no]['out_capacity']
                        * $this->data['machines'][$machine_no]['machine_count']
                        * $date_count;

        $this->data['outweights'][$machine_no][$date_in_ymd] = array('out_weight' => 0,
                                                             'machine_no' => 0,
                                                             'machine_count' => $this->data['machines'][$machine_no]['machine_count'],
                                                             'capacity' => $this->data['machines'][$machine_no]['out_capacity'] * $date_count,
                                                             'shortfall' => $shortfall);
      }
    }
  }

  private function get_date_wise_process_outweights() {
    $process_outweights = $this->get_process_out_weights();
    foreach($process_outweights as $process_outweight) {
      $date = ($this->data['record']['group_by']=='Date') ? $process_outweight['completed_at'] : $this->data['record']['from_date'].' to '.$this->data['record']['to_date'];
      $machine_no = $process_outweight['machine_no'];
      
      $this->data['outweights'][$machine_no][$date]['out_weight'] += $process_outweight['out_weight'];
      $this->data['outweights'][$machine_no][$date]['shortfall'] -= $process_outweight['out_weight'];
    }
  }

  private function get_utilization_wise_process_outweights() {
    foreach($this->data['outweights'] as $machine_no => $machine_outweights) {
      foreach($machine_outweights as $date => $process_outweight) {
        if (   $this->data['record']['under_utilization'] == 'No'
            && ($process_outweight['shortfall'] > 0 || $process_outweight['shortfall'] == 0))
          unset($this->data['outweights'][$machine_no][$date]);
        elseif (   $this->data['record']['under_utilization'] == 'Yes'
            && $process_outweight['shortfall'] < 0) 
          unset($this->data['outweights'][$machine_no][$date]);
      } 
    }
  }
}