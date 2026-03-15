<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Gpc_out_reports extends Ledgers {
  public function __construct(){
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/gpc_powder_internal_model','settings/kcn_model'));
  }

  public function index() {
    redirect(base_url().'reports/gpc_out_reports/create');
  } 
  public function create() {
    parent::create();
  }

  public function _get_form_data() {
    $process_fields = 'id,product_name as product_name, 
                      melting_lot_category_four as design_code,
                      out_weight as weight, 
                      (out_weight*in_lot_purity/100) as fine, 
                      0 as gpc_powder,
                      0 as kcn,
                      micro_coating,
                      in_lot_purity as purity, 
                      date(completed_at) as created_date, 
                      completed_at as created_at';
    $gpc_powder_fields = 'id,"GPC Powder" as product_name, 
                      "" as design_code,
                      0 as weight, 
                      0 as fine,
                      weight as gpc_powder,
                      0 as kcn,
                      0 as micro_coating,
                      0 as purity, 
                      date(created_at) as created_date, 
                      created_at as created_at';
  $kcn_fields = 'id,"KCN" as product_name, 
                      "" as design_code,
                      0 as weight, 
                      0 as fine,
                      0 as gpc_powder,
                      weight as kcn,
                      0 as micro_coating,
                      0 as purity, 
                      date(created_at) as created_date, 
                      created_at as created_at';

      $query = $this->db->query("(select ".$process_fields." from  processes where out_weight > 0  AND department_name='GPC') UNION (select ".$gpc_powder_fields." from gpc_powder_internals) UNION (select ".$kcn_fields." from kcns)");
      $receipts = $query->result_array();
      $issues = array();

      $issue_created_dates = array_column($issues, 'created_date');
      $receipt_created_dates = array_column($receipts, 'created_date');
      $this->data['created_dates'] = array_values(array_unique(array_merge($issue_created_dates, $receipt_created_dates)));
      asort($this->data['created_dates']);
      
      $this->data['receipts'] = parent::get_records_by_created_date($receipts);
      $this->data['issues'] = parent::get_records_by_created_date($issues);

      $this->data['total'] = array();

      parent::get_total_by_created_date($this->data['issues'], 'issue');

      parent::get_total_by_created_date($this->data['receipts'], 'receipt');
      print_r($this->data['total']);

      parent::set_index_for_dates();

      parent::get_balance_by_created_date();
    }
  }