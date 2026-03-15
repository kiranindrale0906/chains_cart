<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Rod_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/rod_model'));
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/rod_ledgers/create');
  }

  
  public function _get_form_data() {
    $this->data['record']['rods'] = (isset($_GET['rod_id']) ? $_GET['rod_id'] : '');
    $this->data['rods']=$this->rod_model->get('name ,id');
    // $in_where=$out_where='';
    // $in_rod_fields = 'lot_no as lot_no,
    //                    product_name as product_name, 
    //                    type as issue_type,
    //                    in_rod as weight, 
    //                    in_lot_purity as purity, 
    //                    (in_rod*in_lot_purity/100) as fine, 
    //                    date(created_at) as created_date, created_at';
    $in_plain_rod_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       "Rod In" as issue_type,
                       (in_rod - in_plain_rod) as weight, 
                       in_lot_purity as purity, 
                       ((in_rod - in_plain_rod) * in_lot_purity / 100) as fine, 
                       date(created_at) as created_date, created_at';                   
    $in_rod_where="in_rod > 0";

    $in_plain_rod_where="in_plain_rod > 0";

    $out_rod_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       "Rod Out" as issue_type, 
                       (out_rod - in_plain_rod) as weight, 
                       in_lot_purity as purity, 
                       ((out_rod - in_plain_rod) * in_lot_purity / 100) as fine, 
                       date(created_at) as created_date, created_at as created_at';
    $out_where="out_rod > 0 and product_name != 'Rod Cleaning'";

    $out_rod_cleaning_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       "Cleaning Out" as issue_type, 
                       out_weight as weight, 
                       in_lot_purity as purity, 
                       (out_weight * in_lot_purity / 100) as fine, 
                       date(created_at) as created_date, created_at as created_at';
    $out_rod_cleaning_where="out_rod > 0 and product_name = 'Rod Cleaning' and department_name = 'Rod Cleaning'";

    $out_loss_rod_cleaning_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       "Cleaning Loss" as issue_type, 
                       loss as weight, 
                       in_lot_purity as purity, 
                       (loss * in_lot_purity / 100) as fine, 
                       date(created_at) as created_date, created_at as created_at';
    if(!empty($this->data['record']['rods'])){
      $in_plain_rod_where .=" and rod_id =".$this->data['record']['rods'];
      $out_rod_cleaning_where .=" and rod_id =".$this->data['record']['rods'];
      $out_where .=" and rod_id =".$this->data['record']['rods'];
    }
    $query = $this->db->query("(select ".$in_plain_rod_fields." from processes 
                               where ".$in_plain_rod_where."
                               order by created_at asc)
                               UNION
                               (select ".$out_rod_cleaning_fields." from      
                                  processes  where ".$out_rod_cleaning_where."
                                  order by processes.created_at asc)
                               UNION
                               (select ".$out_loss_rod_cleaning_fields." from      
                                  processes  where ".$out_rod_cleaning_where."
                                  order by processes.created_at asc)");

    $receipts = $query->result_array();
    
    
    $query = $this->db->query("(select ".$out_rod_fields." from      
                                  processes  where ".$out_where."
                                  order by processes.created_at asc)
                               UNION
                               (select ".$out_rod_cleaning_fields." from      
                                  processes  where ".$out_rod_cleaning_where."
                                  order by processes.created_at asc)
                               UNION
                               (select ".$out_loss_rod_cleaning_fields." from      
                                  processes  where ".$out_rod_cleaning_where."
                                  order by processes.created_at asc)");

    $issues = $query->result_array();
    
    $issue_created_dates = array_column($issues, 'created_date');
    $receipt_created_dates = array_column($receipts, 'created_date');
    $this->data['created_dates'] = array_values(array_unique(array_merge($issue_created_dates, $receipt_created_dates)));
    asort($this->data['created_dates']);
    
    $this->data['receipts'] = parent::get_records_by_created_date($receipts);
    $this->data['issues'] = parent::get_records_by_created_date($issues);


    // if (!isset($_GET['do_no_remove_duplicate']))
    //   parent::remove_receipt_issue_matching_records();

    $this->data['total'] = array();

    parent::get_total_by_created_date($this->data['issues'], 'issue');

    parent::get_total_by_created_date($this->data['receipts'], 'receipt');

    parent::set_index_for_dates();

    parent::get_balance_by_created_date();
  }
}