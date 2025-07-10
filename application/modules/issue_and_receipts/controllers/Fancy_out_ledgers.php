<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Fancy_out_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/issue_purity_model','processes/Process_model','issue_departments/issue_department_model'));
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/fancy_out_ledgers/create');
  }

   public function create() {
    $this->data['record']['alloy_name'] = (isset($_GET['alloy_name']) ? $_GET['alloy_name'] : '');
    parent::create();
  }
  public function _get_form_data() {
    $this->data['period']= (!empty($_GET['period'])) ? $_GET['period'] : 'date';
    $this->data['wastage']= (!empty($_GET['wastage'])) ? $_GET['wastage'] : '';
    $this->data['product']= (!empty($_GET['product'])) ? $_GET['product'] : '';
    $this->data['purity']= (!empty($_GET['purity'])) ? $_GET['purity'] : '';
    $this->data['machine_size']= (!empty($_GET['machine_size'])) ? $_GET['machine_size'] : '';
    if ($this->data['period']== 'month') $period_select = 'date_format(created_at,"%Y-%m") as created_date,';
    elseif ($this->data['period']== 'year') $period_select = 'date_format(created_at,"%Y") as created_date,';
    elseif ($this->data['period']== 'week') {
      $period_from_date = 'DATE_SUB(
                                DATE_ADD(MAKEDATE(date_format(created_at,"%Y"), 1), INTERVAL week(created_at) WEEK),
                                INTERVAL WEEKDAY(
                                   DATE_ADD(MAKEDATE(date_format(created_at,"%Y"), 1), INTERVAL week(created_at) WEEK)
                                ) -1 DAY)';
      $period_to_date = 'DATE_SUB(
                                DATE_ADD(MAKEDATE(date_format(created_at,"%Y"), 1), INTERVAL week(created_at) WEEK),
                                INTERVAL WEEKDAY(
                                   DATE_ADD(MAKEDATE(date_format(created_at,"%Y"), 1), INTERVAL week(created_at) WEEK)
                                ) -7 DAY)';
      $period_select = 'CONCAT('.$period_from_date.' , " - ", '.$period_to_date.') as created_date,';
      
    }else{
      $period_select = 'date_format(created_at,"%Y-%m-%d") as created_date,';
    }
    $out_fancy_out_where='process_name="Fancy Out Process" and chain_name!="Refresh"';
    if($this->data['product']=='ka_chain'){
      $out_fancy_out_where.=" and melting_wastage>0 and product_name in ('KA Chain')";
    }elseif($this->data['product']=='ball_chain'){
      $out_fancy_out_where.=" and melting_wastage>0 and product_name in ('Ball Chain')";
    }else{
      $out_fancy_out_where.=" and melting_wastage>0 and product_name in ('KA Chain','Ball Chain')";
    }
    if(!empty($this->data['purity'])){
      $out_fancy_out_where.=" and out_lot_purity =".$this->data['purity'];
    }
    if(!empty($this->data['machine_size'])){
      $out_fancy_out_where.=" and machine_size =".$this->data['machine_size'];
    }
    $receipts = array();
      $out_fancy_out_fields = 'id,'.$period_select.'
                             lot_no as lot_no,
                             product_name as product_name, 
                             CONCAT(melting_lot_category_one,"/",melting_lot_category_two,"/",design_code,"/",machine_size) as issue_type, 
                             (melting_wastage) as weight,
                             out_lot_purity as purity, 
                             0 as issue_fine, 
                             (melting_wastage*out_lot_purity/100) as fine, 
                             created_at as created_at';
      $query = $this->db->query("(select ".$out_fancy_out_fields." from      
                                  processes where ".$out_fancy_out_where."
                                  order by created_at asc
                               )");
    $issues = $query->result_array();
    $this->data['purities']=$this->process_model->get('distinct(out_lot_purity) as out_lot_purity',array('process_name'=>"Fancy Out Process"));
    $this->data['machine_sizes']=$this->process_model->get('distinct(machine_size) as machine_size',array('process_name'=>"Fancy Out Process"));
    $wastage_purity=0;
    $wastages=array();
    // $this->issue_purity_model->get_issue_wastage($value['id'], '');
    $issue_records=array();
    foreach ($issues as $index => $value) {
      $wastage=$this->issue_purity_model->get_issue_wastage($value['id'], '');
      if($wastage==$this->data['wastage']){
        $issue_records[$index]=$value; 
        $issue_records[$index]['wastage']=$wastage;
        $issue_records[$index]['wastage_purity']=$wastage_purity=$value['purity']+$wastage; 
        $issue_records[$index]['wastage_fine']=$wastage_fine=$value['weight']*$wastage_purity/100; 
        $issue_records[$index]['wastage_diff']=$wastage_fine-$value['fine']; 
      }if(empty($this->data['wastage'])){
        $issue_records[$index]=$value; 
        $issue_records[$index]['wastage']=$wastage;  
        $issue_records[$index]['wastage_purity']=$wastage_purity=$value['purity']+$wastage; 
        $issue_records[$index]['wastage_fine']=$wastage_fine=$value['weight']*$wastage_purity/100; 
        $issue_records[$index]['wastage_diff']=$wastage_fine-$value['fine']; 

      }
      
      $wastages[]=$wastage;
      
    }
    $this->data['wastages']=array_unique($wastages);
    
    $issue_created_dates = array_column($issue_records, 'created_date');
    $receipt_created_dates = array_column($receipts, 'created_date');
    $this->data['created_dates'] = array_values(array_unique(array_merge($issue_created_dates, $receipt_created_dates)));
    asort($this->data['created_dates']);
    
    $this->data['receipts'] = parent::get_records_by_created_date($receipts);
    $this->data['issues'] = parent::get_records_by_created_date($issue_records);


    if (!isset($_GET['do_no_remove_duplicate']))
      parent::remove_receipt_issue_matching_records();

    $this->data['total'] = array();

    parent::get_total_by_created_date($this->data['issues'], 'issue');

    parent::get_total_by_created_date($this->data['receipts'], 'receipt');

    parent::set_index_for_dates();

    parent::get_balance_by_created_date();
  }
}