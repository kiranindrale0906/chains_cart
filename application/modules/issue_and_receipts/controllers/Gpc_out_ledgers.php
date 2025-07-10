<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Gpc_out_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/gpc_out_ledgers/create');
  }

  public function _get_form_data() {
    if (HOST=='AR Gold')
      $percentage = '0.001';
    else
      $percentage = '0.001';
    $pending_in_gpc_fields = 'lot_no as lot_no,
                              product_name as product_name, 
                              in_weight as issue_type,
                              in_weight * '.$percentage.' as weight, 
                              70 as purity, 
                              in_weight * '.$percentage.' * 70 / 100 as fine, 
                              date(created_at) as created_date, created_at';

    $completed_in_gpc_fields = 'lot_no as lot_no,
                              product_name as product_name, 
                              in_weight as issue_type,
                              in_weight * '.$percentage.' as weight, 
                              70 as purity, 
                              in_weight * '.$percentage.' * 70 / 100 as fine, 
                              date(completed_at) as created_date, completed_at as created_at';

    $out_gpc_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       in_weight as issue_type,
                       gpc_out * '.$percentage.' as weight, 
                       70 as purity, 
                       gpc_out * '.$percentage.' * 70 / 100 as fine, 
                       date(completed_at) as created_date, completed_at as created_at';

    $query = $this->db->query("(select ".$pending_in_gpc_fields." from processes 
                               where in_weight > 0 AND gpc_out = 0 AND department_name in  ('GPC','GPC Or Rodium','Bunch GPC')
                               order by created_at asc)

                               UNION

                               (select ".$completed_in_gpc_fields." from processes 
                               where in_weight > 0 AND gpc_out > 0 AND department_name in  ('GPC','GPC Or Rodium','Bunch GPC')
                               order by created_at asc)
                               ");
    $receipts = $query->result_array();

    $query = $this->db->query("select ".$out_gpc_fields." from processes 
                               where gpc_out > 0
                                     AND department_name in  ('GPC','GPC Or Rodium','Bunch GPC')
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