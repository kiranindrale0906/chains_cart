<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Internal_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/internal_ledgers/create');
  }

  public function _get_form_data() {
    $receipts = $this->model->get_receipt_records();
    $issues   = $this->model->get_issue_records();
    
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