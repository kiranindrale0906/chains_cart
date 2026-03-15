<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person_production_charts extends BaseController {   
  public function __construct(){     
  parent::__construct();
  $this->load->model(array('settings/person_production_model','settings/department_worker_model','settings/department_model','processes/process_model','processes/process_field_model'));
  }
   public function index() {
    $this->department_report_dropdown_data();
    $this->data['departments']  = $this->department_model->get('distinct(name) as name,name as id');
    $where=array();
    if(!empty($this->data['record']['department_name'])){
      $where=array('name'=>$this->data['record']['department_name']);
    }
    $departments  = $this->department_model->get('distinct(name) as name,name as id',$where);
    $this->data['product_names']  = $this->process_model->get('distinct(product_name) as name,product_name as id');
    foreach ($departments as $index => $department) {
      $this->get_average_production_details($department['name']);
    }
    $this->load->render('reports/person_production_charts/index', $this->data);
  }
  
  private function get_average_production_details($department_name='') {
     $departments = $this->get_department_names($department_name);
      $this->data['record']['all_department_names'] = $departments['names'];
      $this->data['department_process_value'] = $departments['department_process_value'];
      $this->get_process_reports($departments['department_process_value'],$department_name);
      $this->get_worker_counts($department_name);
      $this->set_worker_count_for_first_date_of_processes($department_name);
      $set_worker_count=$count_of_workers=0;
      foreach ($this->data['process_count_outweight'][$department_name] as $index => $value) {
//	pd($this->data['process_count_outweight'][$department_name]);
       if($this->data['department_workers'][$department_name][$index][0]['date']==$index){
          $set_worker_count=$this->data['department_workers'][$department_name][$index][0]['workers_count'];
        }else{
        	foreach($this->data['department_workers'][$department_name] as $worker_index => $worker_value){
         		$set_worker_count=$worker_value[0]['workers_count'];
        	}}
        $count_of_workers+=$set_worker_count;
      }
	$this->data['process_outweights'][$department_name]['worker_count']=!empty($count_of_workers)?$count_of_workers:0;
//      pd($this->data);
    
    return $this->data;
  }

  private function get_process_reports($department_process_value='',$department_name='') {
    $where_check=array();
    $where=array();
    if(!empty($department_name)) $where['processes.department_name IN ('.$this->data['record']['all_department_names'].')'] = NULL;
    if(!empty($_GET['record']['product_name'])) $where['processes.product_name'] = $_GET['record']['product_name'];
    if(!empty($this->data['record']['karigar_name']))    $where['processes.karigar'] = $this->data['record']['karigar_name'];
    if(!empty($this->data['record']['from_date']))       $where['date(processes.completed_at) >='] = date('Y-m-d',strtotime($this->data['record']['from_date']));
    if(!empty($this->data['record']['to_date']))         $where['date(processes.completed_at) <='] = date('Y-m-d',strtotime($this->data['record']['to_date']));
    //where condition for check fields
    if(!empty($department_name)) $where_check['departments.name'] = $department_name;
    if(!empty($this->data['record']['karigar_name']))    $where_check['departments.karigar_name'] = $this->data['record']['karigar_name'];
    $check_field = $this->department_model->find('check_field', $where_check, array(),array());
    if(!empty($check_field['check_field']))         $where['processes.'.$check_field['check_field'].' >'] = 0;
    
    $datewise_loss = $this->process_model->get('date(completed_at) as completed_at,sum(loss + karigar_loss + pending_loss) as loss,
                                                      sum((loss + karigar_loss + pending_loss) * wastage_purity/100) as loss_gross,
                                                      sum((loss + karigar_loss + pending_loss) * wastage_purity/100 * wastage_lot_purity/100) as loss_fine',$where,
                                                      array(),array('group_by'=>'date(completed_at)','order_by'=>'date(completed_at)'));
    if($department_process_value=='process_details') {
      unset($where['date(processes.completed_at) >='],$where['date(processes.completed_at) <=']);
      if(!empty($this->data['record']['from_date']))       $where['date(process_details.created_at) >='] = date('Y-m-d',strtotime($this->data['record']['from_date']));
      if(!empty($this->data['record']['to_date']))         $where['date(process_details.created_at)<='] = date('Y-m-d',strtotime($this->data['record']['to_date'])); 
      $datewise_outweight = $this->process_field_model->find('date(process_details.created_at) as completed_at,process_details.process_id,
                                                            sum(process_details.out_weight) as out_weight,sum(processes.in_weight) as in_weight,sum(processes.balance_fine) as balance_fine,sum(process_details.pending_ghiss+process_details.ghiss) as ghiss,sum(processes.melting_wastage+processes.daily_drawer_wastage+processes.hcl_wastage) as wastage',$where,
                                                            array(array('processes','processes.id = process_details.process_id')));
    $count_outweight = $this->process_field_model->get('date(process_details.created_at) as completed_at,process_details.process_id',$where,array(array('processes','processes.id = process_details.process_id')),
                                                            array('group_by'=>'date(process_details.created_at)','order_by'=>'date(process_details.created_at) desc'));
    
    } else {
      $datewise_outweight = $this->process_model->find('date(completed_at) as completed_at,id,sum(in_weight) as in_weight,sum(balance_fine) as balance_fine,sum(out_weight) as out_weight,sum(pending_ghiss+ghiss) as ghiss,sum(processes.melting_wastage+processes.daily_drawer_wastage+processes.hcl_wastage) as wastage',$where);
      $count_outweight =  $this->process_model->get('date(completed_at) as completed_at,id,sum(in_weight) as in_weight,sum(balance_fine) as balance_fine,sum(out_weight) as out_weight,sum(pending_ghiss+ghiss) as ghiss,sum(processes.melting_wastage+processes.daily_drawer_wastage+processes.hcl_wastage) as wastage',$where,
                                                      array(),array('group_by'=>'date(completed_at)','order_by'=>'date(completed_at) desc'));
    }
    $datewise_outweight['total_count']=count($count_outweight);
    $this->data['process_outweights'][$department_name]= $datewise_outweight;
    $this->data['process_loss'][$department_name]= $datewise_loss;
    $this->data['process_count_outweight'][$department_name]= get_records_array_by_id($count_outweight,'completed_at');
  }

  private function get_worker_counts($department_name="") {
    if(!empty($department_name)) $where['departments.name'] = $department_name;
    if(!empty($this->data['record']['karigar_name']))    $where['departments.karigar_name'] = $this->data['record']['karigar_name'];
    if(!empty($this->data['record']['from_date']))       $where['date(department_workers.date) >='] = date('Y-m-d',strtotime($this->data['record']['from_date']));
    if(!empty($this->data['record']['to_date']))         $where['date(department_workers.date )<='] = date('Y-m-d',strtotime($this->data['record']['to_date'])); 
  
    $datewise_workerscount = $this->department_worker_model->get('date(department_workers.date) as date,sum(department_workers.worker_count) as workers_count,
                                                                  departments.name as department_name',$where,
                                                                  array(array('departments','department_workers.department_id = departments.id')),array('order_by'=>'date(department_workers.date)',
                                                                    'group_by'=>'date(date)'));
    
    $this->data['department_workers'][$department_name]= get_records_array_by_id($datewise_workerscount,'date');
  }

  private function set_worker_count_for_first_date_of_processes($department_name="") {
    if(!empty($department_name)) $where['departments.name'] = $department_name;
    if(!empty($this->data['record']['karigar_name']))    $where['departments.karigar_name'] = $this->data['record']['karigar_name'];
    $first_process_date = $this->data['process_count_outweight'][$department_name][0]['completed_at'];
    if(!empty($first_process_date)) $where['department_workers.date <= '] = $first_process_date;

    $datewise_workerscount = $this->department_worker_model->find('date(department_workers.date) as date, (department_workers.worker_count) as workers_count, 
                                                                  departments.name as department_name',
                                                                  $where,array(array('departments','department_workers.department_id = departments.id')),
                                                                  array('order_by' => 'department_workers.date DESC'));
     
    $this->data['department_workers'][$department_name][$first_process_date] = array($datewise_workerscount);
  }
  
  private function get_department_names($name) {
    $departments = $this->department_model->get('distinct(name) as name, other_departments,department_process_value',
                                                  array('name'=>$name));
    if(!empty($departments[0]['other_departments'])) {
      $department_string = implode(array($departments[0]['name'],$departments[0]['other_departments']),",");
    } else {
      $department_string = $departments[0]['name'];
    }
    $department_names = array();
    $names = "'" . str_replace(",", "','", $department_string) . "'";
    return $department_names = array(
                                  'names' => $names,
                                  'department_process_value' => $departments[0]['department_process_value']
                                );
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
