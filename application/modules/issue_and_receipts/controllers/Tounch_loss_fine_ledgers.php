<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Tounch_loss_fine_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/tounch_loss_fine_ledgers/create');
  }

  public function _get_form_data() {
    
    $process_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       department_name as issue_type,
                       tounch_loss_fine as weight, 
                       100 as purity, 
                       tounch_loss_fine  as fine, 
                       date(created_at) as created_date, created_at';

    $issue_department_detail_fields = '"Issue Department" as lot_no,
                                       "Tounch Loss Fine" as product_name, 
                                       description as issue_type, 
                                       in_weight as weight, 
                                       100 as purity, 
                                       in_weight as fine, 
                                       date(issue_departments.created_at) as created_date, issue_departments.created_at';

    $query = $this->db->query("select ".$process_fields." from processes 
                               where tounch_loss_fine != 0
                               order by created_at asc;");
    $receipts = $query->result_array();

    $query = $this->db->query("select ".$issue_department_detail_fields." from issue_departments where issue_departments.product_name = 'Tounch Loss Fine' 
                                     AND issue_departments.in_fine != 0
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