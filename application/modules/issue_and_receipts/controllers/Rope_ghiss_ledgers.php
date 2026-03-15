<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Rope_ghiss_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/rope_ghiss_ledgers/create');
  }

  public function _get_form_data() {
    $in_pending_ghiss_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       department_name as issue_type,
                       hcl_ghiss as weight, 
                       in_lot_purity as purity, 
                       hcl_ghiss * in_lot_purity / 100 as fine, 
                       date(created_at) as created_date, created_at';

    $out_pending_ghiss_fields = 'lot_no as lot_no,
                                 product_name as product_name, 
                                 department_name as issue_type, 
                                 ghiss as weight, 
                                 in_lot_purity as purity, 
                                 ghiss * in_lot_purity / 100 as fine, 
                                 date(created_at) as created_date, created_at';

    $query = $this->db->query("select ".$in_pending_ghiss_fields." from processes 
                               where hcl_ghiss > 0
                               order by created_at asc;");
    $receipts = $query->result_array();

    $query = $this->db->query("select ".$out_pending_ghiss_fields." from processes 
                               where ghiss > 0
                                     AND product_name = 'Hcl Ghiss Out'
                               order by created_at asc;");

    $issues = $query->result_array();

    $issue_created_dates = array_column($issues, 'created_date');
    $receipt_created_dates = array_column($receipts, 'created_date');
    $this->data['created_dates'] = array_values(array_unique(array_merge($issue_created_dates, $receipt_created_dates)));
    asort($this->data['created_dates']);
    
    $this->data['receipts'] = parent::get_records_by_created_date($receipts);
    $this->data['issues'] = parent::get_records_by_created_date($issues);


    if (!isset($_GET['do_no_remove_duplicate']))
      parent::remove_receipt_issue_matching_records();

    $this->data['total'] = array();

    parent::get_total_by_created_date($this->data['issues'], 'issue');

    parent::get_total_by_created_date($this->data['receipts'], 'receipt');

    parent::set_index_for_dates();

    parent::get_balance_by_created_date();
  }
}