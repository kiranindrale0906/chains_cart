<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_fixes extends CI_Controller {
  public function __construct(){
    parent::__construct();
  }

  public function index($id) { 
    $this->$id();
    redirect(base_url().'system_checks');
  } 

  private function compute_alloy_details_for_all_melting_lots(){
    $this->load->model(array('melting_lots/melting_lot_model','melting_lots/melting_lot_alloy_detail_model'));
    $this->melting_lot_model->compute_alloy_details_for_all_melting_lots();
  }

  private function daily_drawer_melting_process() {
    $this->load->model('daily_drawers/daily_drawer_melting_process_model');
    $this->daily_drawer_melting_process_model->update_all_daily_drawer_melting_process_start_records();
    $this->process_model->set_purity_for_department_processes('Daily Drawer', 'Melting', 'Start');  
  }

  private function hcl_melting_process() {
    $this->load->model('hcl/hcl_melting_process_model');
    $this->hcl_melting_process_model->update_all_hcl_melting_process_records();
    $this->process_model->set_purity_for_department_processes('HCL', 'HCL Melting Process', 'Start');
  }

  private function strip_cutting_out_purity() {
    $this->load->model(array('hcl/hcl_melting_process_model', 'processes/process_model'));
    $this->hcl_melting_process_model->update_all_chain_out_purity_after_strip_cutting();
  }

  private function expected_out_hcl_loss_hcl_fine_loss() {
    $this->db->query("update processes set expected_out_weight = in_weight * in_purity / 100 where department_name = 'HCL' or department_name = 'HCL Process'");
    $this->db->query("update processes set hcl_loss = expected_out_weight - out_weight where out_weight > 0 and strip_cutting_process_id = 0 and (department_name = 'HCL' or department_name = 'HCL Process')");
    //$this->db->query("update processes set balance_fine = expected_out_weight * (in_lot_purity - out_lot_purity) / 100 where out_weight > 0  and strip_cutting_process_id = 0 and (department_name = 'HCL' or department_name = 'HCL Process')");

    $this->db->query("update processes set out_lot_purity = tounch_purity where tounch_purity > 0 and product_name = 'HCL' and department_name = 'Melting'");
    $this->db->query("update processes set balance_fine = in_weight * (in_lot_purity - out_lot_purity) / 100 where melting_wastage > 0 and product_name = 'HCL' and department_name = 'Melting'");
  }
    
  private function loss_out_melting_process() {
    $this->load->model('loss_outs/Loss_out_melting_process_model');
    $this->Loss_out_melting_process_model->update_all_loss_out_start_records();
    $this->process_model->set_purity_for_department_processes('Loss Out', 'Melting', 'Start');
  }

  private function tounch_out_melting_process() {
    $this->load->model('tounch_outs/Tounch_out_melting_process_model');
    $this->Tounch_out_melting_process_model->update_all_tounch_out_start_records();
    $this->process_model->set_purity_for_department_processes('Tounch Out', 'Melting', 'Start');
  }

  private function tounch_fine() {
    $this->db->query("update processes set tounch_loss_fine = tounch_in * (out_lot_purity - tounch_purity) / 100 where tounch_out > 0");
  }

  private function ghiss_out_melting_process() {
    $this->load->model('ghiss_outs/ghiss_out_melting_process_model');
    $this->ghiss_out_melting_process_model->update_all_ghiss_out_process_records();
    $this->process_model->set_purity_for_department_processes('Ghiss Out', 'Melting', 'Start');
  }

  private function hcl_ghiss_out_melting_process() {
    $this->load->model('hcl_ghiss_outs/hcl_ghiss_out_melting_process_model');
    $this->hcl_ghiss_out_melting_process_model->update_all_hcl_ghiss_out_process_records();
    $this->process_model->set_purity_for_department_processes('HCL Ghiss Out', 'Melting', 'Start');
  }

  private function solder_wastage_out_melting_process() {
    $this->load->model('solder_wastage_outs/solder_wastage_out_melting_process_model');
    $this->solder_wastage_out_melting_process_model->update_all_solder_wastage_out_melting_process_start_records();
    $this->process_model->set_purity_for_department_processes('Solder Wastage', 'Melting', 'Start');
  }

  private function chain_process() {
    $this->load->model(array('hcl/hcl_melting_process_model', 'processes/process_model'));
    $this->process_model->set_purity_for_department_processes($_GET['product_name'], $_GET['process_name'], $_GET['department_name']);
  }

  private function update_indo_tally_chain_spring_process_start_department_records() {
    $this->load->model(array('indo_tally_chains/indo_tally_spring_process_model', 'processes/process_model'));
    $this->indo_tally_spring_process_model->update_all_start_department_records();
  }

  private function issue_department() {
    $this->load->model('issue_departments/issue_department_model');
    $this->issue_department_model->update_all_issue_department_records();
  }
}
?>