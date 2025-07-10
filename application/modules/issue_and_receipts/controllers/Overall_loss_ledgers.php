<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Overall_loss_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/loss_category_model'));
  
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/overall_loss_ledgers/create');
  }
  
  public function _get_form_data() {
   
    $process_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       department_name as issue_type,
                       (loss+karigar_loss) as weight, 
                       processes.in_weight as in_weight,
                       (processes.out_weight+processes.melting_wastage+processes.daily_drawer_wastage+processes.hcl_wastage+processes.tounch_in+processes.fire_tounch_in+processes.ghiss) as out_weight,
                       wastage_lot_purity as purity, 
                       ((loss+karigar_loss) * wastage_purity / 100) as gross, 
                       ((loss+karigar_loss) * wastage_purity / 100 * wastage_lot_purity / 100) as fine, 
                       date(created_at) as created_date, created_at as created_at';

    $process_out_wastage_detail_fields = 'processes.lot_no as lot_no,
                                          processes.product_name as product_name, 
                                          processes.department_name as issue_type, 
                                          process_out_wastage_details.out_weight, 
                                          processes.wastage_lot_purity as purity, 
                                          processes.in_weight as in_weight,
                                          process_out_wastage_details.out_weight as out_weight,
                                          (process_out_wastage_details.out_weight * processes.wastage_purity / 100 * processes.wastage_lot_purity / 100) as fine,
                                          (process_out_wastage_details.out_weight * processes.wastage_purity / 100) as gross, 
                                          date(process_out_wastage_details.created_at) as created_date, process_out_wastage_details.created_at';
    $issue_loss_process_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       department_name as issue_type,
                       (issue_loss) as weight, 
                       processes.in_weight as in_weight,
                       0 as out_weight,
                       wastage_lot_purity as purity, 
                       ((issue_loss) * wastage_purity / 100) as gross, 
                       ((issue_loss) * wastage_purity / 100 * wastage_lot_purity / 100) as fine, 
                       date(created_at) as created_date, created_at as created_at';

  

    $issue_loss_process_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       department_name as issue_type,
                       (issue_loss) as weight, 
                       processes.in_weight as in_weight,
                       0 as out_weight,
                       wastage_lot_purity as purity, 
                       ((issue_loss) * wastage_purity / 100) as gross, 
                       ((issue_loss) * wastage_purity / 100 * wastage_lot_purity / 100) as fine, 
                       date(created_at) as created_date, created_at as created_at';

  

    $query = $this->db->query("(select ".$process_out_wastage_detail_fields." from process_out_wastage_details 
                               inner join processes on process_out_wastage_details.process_id = processes.id
                               where (process_out_wastage_details.field_name = 'Loss Out' or process_out_wastage_details.field_name = 'Melting Loss Out') 
                                     AND process_out_wastage_details.out_weight != 0 
                               order by created_at asc)
                               UNION 
                               (select ".$issue_loss_process_fields." from processes
                               where (issue_loss != 0) and wastage_purity > 0 and wastage_lot_purity > 0
                               order by created_at asc)");

    $issues = $query->result_array();


    $query = $this->db->query("select ".$process_fields." from processes 
                               where (loss != 0 or karigar_loss !=0) and wastage_purity > 0 and wastage_lot_purity > 0 and product_name!= 'Ghiss Out'
                               order by created_at asc;");
    $receipts = $query->result_array();

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