<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Stone_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model'));
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/stone_ledgers/create');
  }

  
  public function _get_form_data() {
    $this->data['record']['in_purity'] = (!empty($_GET['in_purity'])) ? $_GET['in_purity'] : '';
    $this->data['record']['process_name'] = (!empty($_GET['process_name'])) ? $_GET['process_name'] : '';

    $this->data['purities'] = array(array('name' => '100',       'id' => '100'),
                                    array('name' => '88%  >',    'id' => '92.00'),
                                    array('name' => '86% - 88%', 'id' => '87.65'),
                                    array('name' => '80% - 85%', 'id' => '83.65'),
                                    array('name' => '< 80%',     'id' => '75.15'));
    $this->data['process_name'] = $this->process_model->get('distinct(process_name) as name,process_name as id',array('stone_vatav > 0'=>NULL));
    $in_where = $out_where = '';
    $in_stone_fields = 'lot_no as lot_no,
                        product_name as product_name, 
                        type as issue_type,
                        in_weight as weight, 
                        in_lot_purity as purity, 
                        (in_weight * in_lot_purity / 100) as fine, 
                        date(created_at) as created_date, created_at';
    $in_where = " department_name = 'Start' and product_name = 'Stone Receipt' and in_weight > 0 ";

    if(!empty($this->data['record']['in_purity'])){
      if ($this->data['record']['in_purity'] == '83.65')
        $in_where.=' and (in_lot_purity > 80 and in_lot_purity < 85)' ;
      elseif ($this->data['record']['in_purity'] == '87.65')
        $in_where.=' and (in_lot_purity > 86 and in_lot_purity < 88)' ;
      elseif ($this->data['record']['in_purity'] == '75.15')
        $in_where.=' and in_lot_purity < 80' ;
      elseif ($this->data['record']['in_purity'] == '100')
        $in_where.=' and in_lot_purity = 100' ;
      else
        $in_where.=' and (in_lot_purity > 88 and in_lot_purity < 100)' ;
    }
    

    $out_stone_fields = 'lot_no as lot_no,
                         process_name as product_name, 
                         type as issue_type, 
                         (stone_vatav) as weight, 
                         in_lot_purity as purity, 
                         (stone_vatav * in_lot_purity / 100) as fine, 
                         date(created_at) as created_date, created_at as created_at';
    $out_where = "stone_vatav > 0";

    if(!empty($this->data['record']['in_purity'])){
      if ($this->data['record']['in_purity'] == '83.65')
        $out_where.=' and (in_lot_purity > 80 and in_lot_purity < 85)';
      elseif ($this->data['record']['in_purity'] == '87.65') 
        $out_where.=' and (in_lot_purity > 86 and in_lot_purity < 88)';
      elseif ($this->data['record']['in_purity'] == '75.15') 
        $out_where.=' and in_lot_purity < 80';
      elseif ($this->data['record']['in_purity'] == '100') 
        $out_where.=' and in_lot_purity = 100';
      else 
        $out_where.=' and (in_lot_purity > 88 and in_lot_purity < 100)';
    }
    if(!empty($this->data['record']['process_name'])){
        $in_where.=' and process_name="'.$this->data['record']['process_name'].'"' ;
        $out_where.=' and process_name="'.$this->data['record']['process_name'].'"' ;
    }
    $query = $this->db->query("select ".$in_stone_fields." from processes 
                               where ".$in_where."
                               order by created_at asc;");

    $receipts = $query->result_array();
    
    $query = $this->db->query("(select ".$out_stone_fields." from      
                                  processes  where ".$out_where."
                                  order by processes.created_at asc)");

    $issues = $query->result_array();

    $issue_created_dates = array_column($issues, 'created_date');
    $receipt_created_dates = array_column($receipts, 'created_date');
    $this->data['created_dates'] = array_values(array_unique(array_merge($issue_created_dates, $receipt_created_dates)));
    asort($this->data['created_dates']);
    
    $this->data['receipts'] = parent::get_records_by_created_date($receipts);
    $this->data['issues'] = parent::get_records_by_created_date($issues);


    //if (!isset($_GET['do_no_remove_duplicate']))
    //  parent::remove_receipt_issue_matching_records();

    $this->data['total'] = array();

    parent::get_total_by_created_date($this->data['issues'], 'issue');

    parent::get_total_by_created_date($this->data['receipts'], 'receipt');

    parent::set_index_for_dates();

    parent::get_balance_by_created_date();
  }
}