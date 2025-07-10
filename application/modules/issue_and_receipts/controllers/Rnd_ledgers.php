<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Rnd_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/rnd_ledgers/create');
  }

  public function _get_form_data() {
    $in_where=$out_where='';
     $in_rnd_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       department_name as issue_type,
                       in_weight as weight, 
                       in_lot_purity as purity, 
                       in_weight * in_lot_purity / 100 as fine, 
                       date(created_at) as created_date, created_at';
    $in_where="department_name ='Start' and process_name ='RND Receipt' and product_name ='RND' and in_weight>0";
    $out_rnd_fields = 'lot_no as lot_no,
                                 product_name as product_name, 
                                 department_name as issue_type, 
                                 (out_weight) as weight, 
                                 in_lot_purity as purity, 
                                 (out_weight) * out_lot_purity / 100 as fine, 
                                 date(created_at) as created_date, created_at';
    $out_where="department_name ='Start' and process_name ='RND Issue' and product_name ='RND' and out_weight>0";
    
     if(isset($_GET) && !empty($_GET['purity']))
      {
        $in_where.=' and in_lot_purity='.$_GET['purity'];
        $out_where.=' and out_lot_purity='.$_GET['purity'];

      }

    $query = $this->db->query("select ".$in_rnd_fields." from processes 
                               where ".$in_where."
                               order by created_at asc;");
    $receipts = $query->result_array();
    

    $query = $this->db->query("select ".$out_rnd_fields." from processes 
                               where ".$out_where."
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