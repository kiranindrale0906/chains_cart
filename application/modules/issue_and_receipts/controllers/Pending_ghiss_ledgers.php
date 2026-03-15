<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Pending_ghiss_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model', 'processes/process_out_wastage_detail_model'));
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/pending_ghiss_ledgers/create');
  }
  public function create() {
    $this->data['record']['department_name'] = (isset($_GET['department_name']) ? $_GET['department_name'] : '');
    parent::create();
  }

  public function _get_form_data() {

    $this->data['departments'] = $this->process_model->get('DISTINCT(department_name) as id, department_name as name', array('or_where'=>array('pending_ghiss !=' => 0)));
  if (!empty($this->data['record']['department_name'])) {
    $in_pending_ghiss_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       department_name as issue_type,
                       pending_ghiss as weight, 
                       in_lot_purity as purity, 
                       pending_ghiss * in_lot_purity / 100 as fine, 
                       date(completed_at) as created_date, completed_at as created_at';

    $out_pending_ghiss_fields = 'lot_no as lot_no,
                                 product_name as product_name, 
                                 department_name as issue_type, 
                                 ghiss as weight, 
                                 in_lot_purity as purity, 
                                 ghiss * in_lot_purity / 100 as fine, 
                                 date(completed_at) as created_date, completed_at as created_at';

    $query = $this->db->query("select ".$in_pending_ghiss_fields." from processes 
                               where pending_ghiss > 0 and department_name='".$this->data['record']['department_name']."'
                               order by completed_at asc;");
    $receipts = $query->result_array();

    $query = $this->db->query("select ".$out_pending_ghiss_fields." from processes 
                               where ghiss > 0
                                     AND product_name = 'Pending Ghiss Out' and department_name='".$this->data['record']['department_name']."'
                               order by completed_at asc;");

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
}