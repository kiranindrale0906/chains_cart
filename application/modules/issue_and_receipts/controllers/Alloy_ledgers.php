<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Alloy_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/alloy_type_model'));
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/alloy_ledgers/create');
  }

   public function create() {
    $this->data['record']['alloy_name'] = (isset($_GET['alloy_name']) ? $_GET['alloy_name'] : '');
    parent::create();
  }
  public function _get_form_data() {
    $this->data['alloy_names']=$this->alloy_type_model->get('alloy_name as name ,alloy_name as id',array(),array(),array('group_by'=>'name'));
    $in_where=$out_where='';
     $in_alloy_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       type as issue_type,
                       alloy_weight as weight, 
                       in_lot_purity as purity, 
                       0 as fine, 
                       date(created_at) as created_date, created_at';
    $in_where="department_name ='Start'and product_name ='Alloy Receipt' and alloy_weight>0";

    $out_alloy_fields = 'melting_lots.lot_no as lot_no,
                                 melting_lots.process_name as product_name, 
                                 alloy_name as issue_type, 
                                 (out_weight) as weight, 
                                 melting_lots.lot_purity as purity, 
                                 0 as fine, 
                                 date(melting_lots.created_at) as created_date, melting_lots.created_at as created_at';
    $out_where="out_weight>0";
    $alloy_issue_out_where=" product_name = 'Alloy Issue' and department_name = 'Start' and out_alloy_weight>0";
    
     if(isset($this->data['record']['alloy_name']) && !empty($this->data['record']['alloy_name']))
      {
        $in_where.=' and process_name="'.$this->data['record']['alloy_name'].'"';
        $out_where.=' and alloy_name="'.$this->data['record']['alloy_name'].'"';
        $alloy_issue_out_where.=' and process_name="'.$this->data['record']['alloy_name'].'"';

      }

    $query = $this->db->query("select ".$in_alloy_fields." from processes 
                               where ".$in_where."
                               order by created_at asc;");
    $receipts = $query->result_array();
    
     $query = $this->db->query("(select ".$out_alloy_fields." from      
                                  melting_lot_alloy_details inner join melting_lots on melting_lot_alloy_details.melting_lot_id = melting_lots.id
                                   where ".$out_where."
                                  order by melting_lots.created_at asc)
                               UNION
                                  (select lot_no as lot_no,
                                   product_name as product_name, 
                                   process_name as issue_type,
                                   out_alloy_weight as weight, 
                                   in_lot_purity as purity, 
                                   0 as fine, 
                                   date(created_at) as created_date, created_at from processes where ".$alloy_issue_out_where."    order by processes.created_at asc)");

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