<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_checks extends BaseController {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('melting_lots/melting_lot_detail_model', 'processes/process_model','processes/process_out_wastage_detail_model','issue_departments/issue_department_model','issue_departments/issue_department_detail_model','processes/process_field_model'));
  }

  public function index() { 
    $data_without_where = $this->queries_without_where();
    $record = $this->system_check_model->execute_query($data_without_where);
    $this->data['record'] = $record;
    $this->data['layout'] = 'application';

    if (!isset($_GET['fix'])) $_GET['fix'] = '';

    if ($_GET['fix']=='HCL') {
      $this->load->model('hcl/hcl_melting_process_model');
      $this->hcl_melting_process_model->update_all_hcl_melting_process_records();
    }

    if ($_GET['fix']=='HCL Ghiss') {
      $this->load->model('hcl_ghiss_outs/hcl_ghiss_out_melting_process_model');
      $this->hcl_ghiss_out_melting_process_model->update_all_hcl_ghiss_melting_process_records();
    }

    if ($_GET['fix']=='DD Wastage') {
      $this->load->model('daily_drawers/daily_drawer_melting_process_model');
      $this->daily_drawer_melting_process_model->update_all_daily_drawer_melting_process_start_records();
    }

    if ($_GET['fix']=='Loss') {
      $this->load->model('loss_outs/Loss_out_melting_process_model');
      $this->Loss_out_melting_process_model->update_all_loss_out_start_records();
    }

    if ($_GET['fix']=='Tounch Out') {
      $this->load->model('tounch_outs/Tounch_out_melting_process_model');
      $this->Tounch_out_melting_process_model->update_all_tounch_out_start_records();
    }

    if ($_GET['fix']=='Pending Ghiss Out') {
      $this->load->model('pending_ghiss_outs/pending_ghiss_out_process_model');
      $this->pending_ghiss_out_process_model->update_all_pending_ghiss_out_start_records();
    }

    if ($_GET['fix']=='Ghiss Out') {
      $this->load->model('ghiss_outs/ghiss_out_melting_process_model');
      $this->ghiss_out_melting_process_model->update_all_ghiss_out_process_records();
    }
  
    $this->load->render('system_checks/system_checks/index',$this->data);
  } 

  public function queries_without_where(){
     $select_process = 'sum(out_melting_wastage) as out_melting_wastage,
              sum(melting_wastage) as melting_wastage,
              sum(issue_gpc_out) as issue_gpc_out,
              sum(issue_melting_wastage) as issue_melting_wastage,
              sum(issue_daily_drawer_wastage) as issue_daily_drawer_wastage,
              sum(balance_melting_wastage) as balance_melting_wastage,
              sum(out_daily_drawer_wastage) as sum_out_daily_drawer_wastage,
              sum(daily_drawer_wastage) as sum_daily_drawer_wastage,
              sum(balance_daily_drawer_wastage) as sum_balance_daily_drawer_wastage, 
              sum(out_ghiss) as sum_out_ghiss,
              sum(issue_ghiss) as issue_ghiss,
              sum(ghiss) as sum_ghiss,
              sum(balance_ghiss) as  sum_blance_ghiss,
              sum(balance_pending_ghiss) as  balance_pending_ghiss,
              sum(out_pending_ghiss) as  out_pending_ghiss,
              sum(pending_ghiss) as  pending_ghiss,
              sum(out_hcl_wastage) as sum_out_hcl_wastage,
              sum(hcl_wastage) as sum_hcl_wastage,
              sum(balance_hcl_wastage) as sum_balance_hcl_wastage,
              sum(tounch_out) as sum_tounch_out,
              sum(tounch_ghiss) as sum_tounch_ghiss,
              sum(tounch_loss_fine) as sum_tounch_fine_in,
              sum(out_tounch_out) as sum_out_tounch_out,
              sum(balance_tounch_out) as sum_balance_tounch_out,
              sum(out_loss) as sum_out_loss,
              sum(loss) as sum_loss,
              sum(balance_loss) as sum_balance_loss';
    $processes = $this->process_model->find($select_process);
    $select_melting_lots = 'sum(wastage_weight) as wastage_weight,
                                              sum(gross_weight - alloy_vodatar) 
                                              as gross_weight_alloy_vodator';
    
    $melting_lots = $this->melting_lot_model->find($select_melting_lots);
    
    $select_melting_lot_detail = "sum(required_weight + required_alloy_weight) 
                                          as required_weight_alloy_weight,
                                          
                                 sum(required_weight) as required_weight";
    $melting_lot_detail = $this->melting_lot_detail_model->find($select_melting_lot_detail);
  
    $merge_array = array_merge($processes,$melting_lots);
    return array_merge($merge_array,$melting_lot_detail);
  }

  public function view($id){
    $this->system_check_model->check_data_base($_POST);
  }

  


}

