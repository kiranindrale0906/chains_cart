<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . "modules/reports/controllers/Department_reports.php";

class Average_production_reports extends Department_reports {
  public function __construct(){
    parent::__construct();
    //$this->load->model(array('processes/process_model', 'settings/department_model', 'settings/department_worker_model'));
    //$this->bot = new \TelegramBot\Api\BotApi('1387671982:AAGd_ke_dJoiZ_tkThtUlCrPUBTo2oNfjdc');
    $this->load->helper('form_fields_helper');
  }
  
  public function index() {
    $this->department_report_dropdown_data();
    $this->data['departments']  = $this->department_model->get('distinct(name) as name,name as id');
    $this->data['product_names']  = $this->process_model->get('distinct(product_name) as name,product_name as id');
    if(isset($_GET['telegram'])&&$_GET['telegram']=='yes') {
      $department_name = $this->data['record']['department_name'] = 'Chain Making';
      $karigar_names = array('Bappy Nawabi','Bappa','Bhim','Dharmendra','Dipu','Suman','Kumar','Hollow-Bapi','Golu','Dipak');
      $date = $this->data['record']['from_date'] = date('Y-m-d');
      $this->data['record']['to_date'] = date('Y-m-d');
      $message = date('d-m-Y',strtotime($date))." - ".HOST."\nAverage Production Report";
      $this->send_average_production_message($message);
      
      foreach ($karigar_names as $karigar_name) {
        $this->get_average_production_details($department_name);
        $out_weight = (!empty($this->data['process_outweights'])) ? four_decimal($this->data['process_outweights'][$date][0]['out_weight']) : 'N.A.';
        $worker_count = (!empty($this->data['process_outweights'])) ? $this->data['department_workers'][$date][0]['workers_count'] : 'N.A.';

        $average_production_message = "Chain Making \nKarigar Name : ".$karigar_name."\nOut Weight : ".$out_weight."\nWorkers Count : ".$worker_count;
        $this->send_average_production_message($average_production_message);
      }
    } else {
      $department_name = $this->data['record']['department_name'];
      $product_name = $this->data['record']['product_name'];
      if (!empty($department_name)) {
        $this->get_average_production_details($department_name);
      }
      $this->load->render('reports/average_production_reports/index', $this->data);
    }
  }
  
  private function get_average_production_details($department_name='') {
     $departments = $this->get_department_names($department_name);
      $this->data['record']['all_department_names'] = $departments['names'];
      $this->data['department_process_value'] = $departments['department_process_value'];
      $this->get_process_reports($departments['department_process_value']);
      $this->get_worker_counts();
      $this->set_worker_count_for_first_date_of_processes();
    
    return $this->data;
  }
  
  private function send_average_production_message($message) {
    $this->bot->sendMessage('620761862', $message);
//    $this->bot->sendMessage('712491427', $message);
  }

  public function view($id=NULL) {
    $department_names = $this->get_department_names($_GET['average_production_reports']['department_name']);
    if(!empty($_GET['average_production_reports']['department_name'])) $where['processes.department_name IN ('.$department_names['names'].')'] = NULL;
    if(!empty($_GET['average_production_reports']['product_name'])) $where['processes.product_name'] = $_GET['average_production_reports']['product_name'];
    if(!empty($_GET['average_production_reports']['karigar_name']))    $where['processes.karigar'] = $_GET['average_production_reports']['karigar_name'];
    if(!empty($_GET['date'])) $where['date(processes.completed_at)'] = $_GET['date'];
    //where condition for check fields
    if(!empty($_GET['average_production_reports']['department_name'])) $where_check['departments.name'] = $_GET['average_production_reports']['department_name'];
    if(!empty($_GET['average_production_reports']['karigar_name']))    $where_check['departments.karigar_name'] = $_GET['average_production_reports']['karigar_name'];
    $check_field = $this->department_model->find('check_field', $where_check, array(),array());
    if(!empty($check_field['check_field']))         $where['processes.'.$check_field['check_field'].' >'] = 0;
    $this->data['loss_details'] = $this->process_model->get('id,product_name,process_name,department_name,lot_no,parent_lot_name,(loss + karigar_loss + pending_loss) as loss,
                                                            ((loss + karigar_loss + pending_loss) * wastage_purity/100) as loss_gross,
                                                            ((loss + karigar_loss + pending_loss) * wastage_purity/100 * wastage_lot_purity/100) as loss_fine',$where);
    if($_GET['type']=='process') {
      $this->data['out_weight_details'] = $this->process_model->get('out_weight,(pending_ghiss+ghiss) as ghiss,id,product_name,process_name,department_name,lot_no,parent_lot_name',$where);
    } else {
      unset($where['date(processes.completed_at)']);
      if(!empty($_GET['date'])) $where['date(process_details.created_at)'] = $_GET['date'];
      $this->data['out_weight_details'] = $this->process_field_model->get('process_details.process_id as id,process_details.out_weight,(process_details.pending_ghiss+process_details.ghiss) as ghiss,processes.product_name,
                                                                            processes.process_name,processes.department_name,processes.lot_no,
                                                                            processes.parent_lot_name',$where,
                                                                            array(array('processes','processes.id = process_details.process_id')));
    }
    
    $this->load->render('reports/average_production_reports/view', $this->data);
  }


  private function get_process_reports($department_process_value='') {
    $where_check=array();
    $where=array();
    if(!empty($this->data['record']['department_name'])) $where['processes.department_name IN ('.$this->data['record']['all_department_names'].')'] = NULL;
    if(!empty($_GET['record']['product_name'])) $where['processes.product_name'] = $_GET['record']['product_name'];
    if(!empty($this->data['record']['karigar_name']))    $where['processes.karigar'] = $this->data['record']['karigar_name'];
    if(!empty($this->data['record']['from_date']))       $where['date(processes.completed_at) >='] = date('Y-m-d',strtotime($this->data['record']['from_date']));
    if(!empty($this->data['record']['to_date']))         $where['date(processes.completed_at) <='] = date('Y-m-d',strtotime($this->data['record']['to_date']));
    //where condition for check fields
    if(!empty($this->data['record']['department_name'])) $where_check['departments.name'] = $this->data['record']['department_name'];
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
      $datewise_outweight = $this->process_field_model->get('date(process_details.created_at) as completed_at,process_details.process_id,
                                                            sum(process_details.out_weight) as out_weight,sum(processes.in_weight) as in_weight,sum(processes.balance_fine) as balance_fine,sum(process_details.pending_ghiss+ghiss) as ghiss,sum(processes.melting_wastage+processes.daily_drawer_wastage+processes.hcl_wastage) as wastage',$where,
                                                            array(array('processes','processes.id = process_details.process_id')),
                                                            array('group_by'=>'date(process_details.created_at)','order_by'=>'date(process_details.created_at)'));
    } else {
      $datewise_outweight = $this->process_model->get('date(completed_at) as completed_at,id,sum(in_weight) as in_weight,sum(balance_fine) as balance_fine,sum(out_weight) as out_weight,sum(pending_ghiss+ghiss) as ghiss,sum(processes.melting_wastage+processes.daily_drawer_wastage+processes.hcl_wastage) as wastage',$where,
                                                      array(),array('group_by'=>'date(completed_at)','order_by'=>'date(completed_at)'));
    }
    $this->data['process_outweights'] = get_records_array_by_id($datewise_outweight,'completed_at');
    $this->data['process_loss'] = get_records_array_by_id($datewise_loss,'completed_at');
  }

  private function get_worker_counts() {
    if(!empty($this->data['record']['department_name'])) $where['departments.name'] = $this->data['record']['department_name'];
    if(!empty($this->data['record']['karigar_name']))    $where['departments.karigar_name'] = $this->data['record']['karigar_name'];
    if(!empty($this->data['record']['from_date']))       $where['date(department_workers.date) >='] = date('Y-m-d',strtotime($this->data['record']['from_date']));
    if(!empty($this->data['record']['to_date']))         $where['date(department_workers.date )<='] = date('Y-m-d',strtotime($this->data['record']['to_date'])); 
  
    $datewise_workerscount = $this->department_worker_model->get('date(department_workers.date) as date,sum(department_workers.worker_count) as workers_count,
                                                                  departments.name as department_name',$where,
                                                                  array(array('departments','department_workers.department_id = departments.id')),
                                                                  array('group_by'=>'date(date)'));
    
    $this->data['department_workers'] = get_records_array_by_id($datewise_workerscount,'date');
  }

  private function set_worker_count_for_first_date_of_processes() {
    if(!empty($this->data['record']['department_name'])) $where['departments.name'] = $this->data['record']['department_name'];
    if(!empty($this->data['record']['karigar_name']))    $where['departments.karigar_name'] = $this->data['record']['karigar_name'];
    $first_process_date = array_keys($this->data['process_outweights'])[0];
    if(!empty($first_process_date)) $where['department_workers.date <= '] = $first_process_date;

    $datewise_workerscount = $this->department_worker_model->find('date(department_workers.date) as date, department_workers.worker_count as workers_count, 
                                                                  departments.name as department_name',
                                                                  $where,array(array('departments','department_workers.department_id = departments.id')),
                                                                  array('order_by' => 'department_workers.date DESC'));
     
    $this->data['department_workers'][$first_process_date] = array($datewise_workerscount);
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
}