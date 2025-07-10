<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Ghiss_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/ghiss_ledgers/create');
  }

  public function _get_form_data() {
    $process_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       department_name as issue_type,
                       ghiss as weight, 
                       in_lot_purity as purity, 
                       ghiss * in_lot_purity / 100 as fine, 
                       date(created_at) as created_date, created_at';

    $process_out_wastage_detail_fields = 'processes.lot_no as lot_no,
                                          processes.product_name as product_name, 
                                          processes.department_name as issue_type, 
                                          process_out_wastage_details.out_weight as weight, 
                                          processes.in_lot_purity as purity, 
                                          process_out_wastage_details.out_weight * processes.in_lot_purity / 100 as fine, 
                                          date(process_out_wastage_details.created_at) as created_date, process_out_wastage_details.created_at';

    

    $query = $this->db->query("select ".$process_out_wastage_detail_fields." from process_out_wastage_details 
                               inner join processes on process_out_wastage_details.process_id = processes.id
                               where process_out_wastage_details.field_name = 'Ghiss Out' 
                                     AND process_out_wastage_details.out_weight > 0
                                     AND processes.department_name = 'Hand Cutting'
                               order by created_at asc;");

    $issues = $query->result_array();

    $query = $this->db->query("select ".$process_fields." from processes 
                               where ghiss > 0
                                     AND department_name = 'Hand Cutting'
                               order by created_at asc;");
    $receipts = $query->result_array();

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