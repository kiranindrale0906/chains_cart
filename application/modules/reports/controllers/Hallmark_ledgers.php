<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";

class Hallmark_ledgers  extends Ledgers {
  public function __construct(){
     $this->load->model(array('processes/process_model','processes/process_field_model',
                              'daily_drawers/box_weight_model','issue_departments/issue_department_model',
                              'settings/chain_purity_model', 'settings/karigar_model'));
    parent::__construct();
  }  
  public function index() {
    // pd($this->data);
    if(empty($_GET)){
    redirect(base_url().'reports/hallmark_ledgers/create'); 
    }else{
      $this->load->render('reports/hallmark_ledgers/create?');    
    }
  }

  public function _get_form_data() {
    $process_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       process_name as issue_type,
                       design_code as design_code,
                       quantity as quantity,
                       hallmark_out as weight, 
                       in_weight,
                       in_lot_purity as purity, 
                       hallmark_out * in_lot_purity / 100 as fine, 
                       date(created_at) as created_date, created_at';

    $process_detail_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       process_name as issue_type,
                       design_code as design_code,
                       quantity as quantity,
                       hallmark_in as weight, 
                       in_weight,
                       in_lot_purity as purity, 
                       hallmark_in * in_lot_purity / 100 as fine, 
                       date(updated_at) as created_date, created_at';

    $query = $this->db->query("select ".$process_fields." from processes 
                               where hallmark_out > 0
                               order by created_at asc;");
    $receipts = $query->result_array();

   
     $query = $this->db->query("select ".$process_detail_fields." from processes 
                               where hallmark_in > 0
                               order by updated_at asc;");

    $issues = $query->result_array();

    $issue_created_dates = array_column($issues, 'created_date');
    $receipt_created_dates = array_column($receipts, 'created_date');
    $this->data['created_dates'] = array_values(array_unique(array_merge($issue_created_dates, $receipt_created_dates)));
    asort($this->data['created_dates']);
    
    $this->data['receipts'] = parent::get_records_by_created_date($receipts);
    $this->data['issues'] = parent::get_records_by_created_date($issues);

    $this->data['total'] = array();

    parent::get_total_by_created_date($this->data['issues'], 'issue');


    parent::get_total_by_created_date($this->data['receipts'], 'receipt');

    parent::set_index_for_dates();

    parent::get_balance_by_created_date();
  }
}

