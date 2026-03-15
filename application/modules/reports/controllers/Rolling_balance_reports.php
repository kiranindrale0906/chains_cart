<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Rolling_balance_reports extends Ledgers {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('issue_and_receipts/internal_ledger_model'));
  
  }

  public function index() {
    redirect(base_url().'reports/rolling_balance_reports/create');
  }

  public function _get_form_data() {
    $this->data['period']= (!empty($_GET['period'])) ? $_GET['period'] : 'date';
    $receipts = $this->internal_ledger_model->get_receipt_records($this->data['period']);
    $issues   = $this->internal_ledger_model->get_issue_records($this->data['period']);
    
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