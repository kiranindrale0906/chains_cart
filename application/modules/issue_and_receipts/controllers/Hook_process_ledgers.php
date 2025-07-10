<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Hook_process_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/same_karigar_model'));
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/hook_process_ledgers/create');
  }

  public function _get_form_data() {
    $this->data['record']['in_lot_purity'] = (!empty($_GET['in_purity'])) ? $_GET['in_purity'] : '';
    $this->data['record']['karigar'] = (!empty($_GET['karigar'])) ? $_GET['karigar'] : '';
    $this->data['record']['process_name'] = (!empty($_GET['process_name'])) ? $_GET['process_name'] : '';

    $this->data['purities'] = array(array('name' => '100',       'id' => '100'),
                                    array('name' => '88%  >',    'id' => '92.00'),
                                    array('name' => '86% - 88%', 'id' => '87.65'),
                                    array('name' => '80% - 85%', 'id' => '83.65'),
                                    array('name' => '< 80%',     'id' => '75.15'));
    $this->data['karigar_name']=$this->same_karigar_model->get('Distinct(karigar_name) as name,karigar_name as id', array('product_name'=>$this->data['record']['process_name']));
    $this->data['process_name']=array(array('id'=>'KA Chain','name'=>'KA Chain'),
                                      array('id'=>'Ball Chain','name'=>'Ball Chain'));

    if(empty($this->data['record']['karigar'])) return;
    if(empty($this->data['record']['in_lot_purity'])) return;
    if(empty($this->data['record']['process_name'])) return;

    if(!empty($this->data['record']['process_name'])){
      $in_fields = 'lot_no as lot_no,
                       design_code as product_name, 
                       "IN Weight" as issue_type,
                       in_weight as weight, 
                       in_lot_purity as purity, 
                       in_weight * in_lot_purity / 100 as fine, 
                       date(created_at) as created_date, created_at';
      $hook_in_fields = 'processes.lot_no as lot_no,
                       processes.design_code as product_name, 
                       "Hook In" as issue_type,
                       process_details.hook_in as weight, 
                       processes.hook_kdm_purity as purity, 
                       process_details.hook_in * processes.hook_kdm_purity / 100 as fine, 
                       date(process_details.created_at) as created_date, process_details.created_at as created_at';
                   

    $out_fields = 'lot_no as lot_no,
                   design_code as product_name, 
                   "Out Weight" as issue_type, 
                   out_weight as weight, 
                   in_lot_purity as purity, 
                   out_weight * in_lot_purity / 100 as fine, 
                   date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';

    $bounch_out_fields = 'lot_no as lot_no,
                         design_code as product_name, 
                         "Bunch Out" as issue_type, 
                         bounch_out as weight, 
                         out_lot_purity as purity, 
                         bounch_out * out_lot_purity / 100 as fine, 
                         date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';

    $hook_out_fields = 'lot_no as lot_no,
                        design_code as product_name, 
                        "Hook Out" as issue_type, 
                        hook_out as weight, 
                        hook_kdm_purity as purity, 
                        hook_out * hook_kdm_purity / 100 as fine, 
                        date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';
    $customer_out_fields = 'lot_no as lot_no,
                            design_code as product_name, 
                            "Customer Out" as issue_type, 
                            customer_out as weight, 
                            out_lot_purity as purity, 
                            customer_out * out_lot_purity / 100 as fine, 
                            date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';
    $factory_out_fields = 'lot_no as lot_no,
                           design_code as product_name, 
                           "Factory Out" as issue_type, 
                           factory_out as weight, 
                           out_lot_purity as purity, 
                           factory_out * out_lot_purity / 100 as fine, 
                           date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';
    $recutting_out_fields = 'lot_no as lot_no,
                           design_code as product_name, 
                           "Recutting Out" as issue_type, 
                           recutting_out as weight, 
                           out_lot_purity as purity, 
                           recutting_out * out_lot_purity / 100 as fine, 
                           date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';
    $wastage_fields = 'lot_no as lot_no,
                       design_code as product_name, 
                       "Wastage" as issue_type, 
                       daily_drawer_wastage as weight, 
                       wastage_lot_purity as purity, 
                       daily_drawer_wastage * wastage_lot_purity / 100 as fine, 
                       date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';

    $loss_fields = 'lot_no as lot_no,
                       design_code as product_name, 
                       "Loss" as issue_type, 
                       loss as weight, 
                       wastage_lot_purity as purity, 
                       loss * wastage_lot_purity / 100 as fine, 
                       date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';

    $karigar_loss_fields = 'lot_no as lot_no,
                       design_code as product_name, 
                       "Karigar Loss" as issue_type, 
                       karigar_loss as weight, 
                       in_lot_purity as purity, 
                       karigar_loss * wastage_lot_purity / 100 as fine, 
                       date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';

    $in_where      = "in_weight > 0 AND department_name = 'Hook'";
    $hook_in_where = "process_details.hook_in > 0 AND department_name = 'Hook'";
    if(!empty($this->data['record']['in_lot_purity'])){
      if ($this->data['record']['in_lot_purity'] == '83.65'){
        $in_where       .= ' and (in_lot_purity >= 80 and in_lot_purity < 85)' ;
        $hook_in_where  .= ' and (processes.hook_kdm_purity >= 80 and processes. hook_kdm_purity < 85)' ;
      }elseif ($this->data['record']['in_lot_purity'] == '87.65'){
        $in_where       .= ' and (in_lot_purity >= 86 and in_lot_purity < 88)' ;
        $hook_in_where  .= ' and (processes.hook_kdm_purity >= 86 and processes.hook_kdm_purity < 88)' ;
      }elseif ($this->data['record']['in_lot_purity'] == '75.15'){
        $in_where       .= ' and in_lot_purity < 80' ;
        $hook_in_where  .= ' and processes.hook_kdm_purity < 80' ;
      }elseif ($this->data['record']['in_lot_purity'] == '100'){
        $in_where       .= ' and in_lot_purity = 100' ;
        $hook_in_where  .= ' and processes.hook_kdm_purity = 100' ;
      }else{
        $in_where       .= ' and (in_lot_purity >= 88 and in_lot_purity < 100)' ;
        $hook_in_where  .= ' and (processes.hook_kdm_purity >= 88 and processes.hook_kdm_purity < 100)' ;
      }
    }  
    
    $in_where      .= ' and karigar="'.$this->data['record']['karigar'].'"' ;
    $hook_in_where .= ' and processes.karigar="'.$this->data['record']['karigar'].'"' ;
    $in_where      .= ' and product_name="'.$this->data['record']['process_name'].'"' ;
    $hook_in_where .= ' and processes.product_name="'.$this->data['record']['process_name'].'"' ;
    
    $query = $this->db->query("(select ".$in_fields." from processes 
                               where ".$in_where."
                               order by created_at asc)
                               UNION 
                               (select ".$hook_in_fields." from processes inner join process_details on processes.id = process_details.process_id
                               where ".$hook_in_where."
                               order by created_at asc)
                               ");
    $receipts = $query->result_array();
    $out_where="out_weight != 0  AND department_name = 'Hook' and karigar='".$this->data['record']['karigar']."' and product_name='".$this->data['record']['process_name']."'";
    $bounch_out_where="bounch_out != 0  AND department_name = 'Hook' and karigar='".$this->data['record']['karigar']."' and product_name='".$this->data['record']['process_name']."'";
    $hook_out_where="hook_out != 0  AND department_name = 'Hook' and karigar='".$this->data['record']['karigar']."' and product_name='".$this->data['record']['process_name']."'";
    $customer_out_where="customer_out != 0  AND department_name = 'Hook' and karigar='".$this->data['record']['karigar']."' and product_name='".$this->data['record']['process_name']."'";
    $wastage_where="daily_drawer_wastage != 0  AND department_name = 'Hook' and karigar='".$this->data['record']['karigar']."' and product_name='".$this->data['record']['process_name']."'";
    $loss_where="loss_where != 0  AND department_name = 'Hook' and karigar='".$this->data['record']['karigar']."' and product_name='".$this->data['record']['process_name']."'";
    $karigar_loss_where="karigar_loss != 0 AND department_name = 'Hook' and karigar='".$this->data['record']['karigar']."' and product_name='".$this->data['record']['process_name']."'";
    $factory_out_where="factory_out != 0  AND department_name = 'Hook' and karigar='".$this->data['record']['karigar']."' and product_name='".$this->data['record']['process_name']."'";
    $recutting_out_where="recutting_out != 0  AND department_name = 'Hook' and karigar='".$this->data['record']['karigar']."' and product_name='".$this->data['record']['process_name']."'";

    $purity_where = '';
    if(!empty($this->data['record']['in_lot_purity'])){
      if ($this->data['record']['in_lot_purity'] == '83.65'){
        $purity_where .=' and (in_lot_purity >= 80 and in_lot_purity < 85)';
      }elseif ($this->data['record']['in_lot_purity'] == '87.65'){ 
        $purity_where .=' and (in_lot_purity >= 86 and in_lot_purity < 88)';
      }elseif ($this->data['record']['in_lot_purity'] == '75.15') {
        $purity_where .=' and in_lot_purity < 80';
      }elseif ($this->data['record']['in_lot_purity'] == '100') {
        $purity_where .=' and in_lot_purity = 100';
      }else {
        $purity_where .=' and (in_lot_purity >= 88 and in_lot_purity < 100)';
      }
    }

    $out_where           .=  $purity_where;
    $bounch_out_where    .= $purity_where;
    $hook_out_where      .= $purity_where;
    $customer_out_where  .= $purity_where;
    $factory_out_where   .= $purity_where;
    $wastage_where       .= $purity_where;
    $loss_where          .= $purity_where;
    $karigar_loss_where  .= $purity_where;
    $recutting_out_where .= $purity_where;

    $query = $this->db->query("(select ".$out_fields." from processes 
                               where ".$out_where."
                               order by created_at asc)
                               UNION
                               (select ".$bounch_out_fields." from processes 
                               where ".$bounch_out_where."
                               order by created_at asc)
                               UNION 
                               (select ".$hook_out_fields." from processes 
                               where ".$hook_out_where."
                               order by created_at asc)
                               UNION 
                               (select ".$customer_out_fields." from processes 
                               where ".$customer_out_where."
                               order by created_at asc)
                                UNION 
                               (select ".$factory_out_fields." from processes 
                               where ".$factory_out_where."
                               order by created_at asc)
                               UNION 
                               (select ".$wastage_fields." from processes 
                               where ".$wastage_where."
                               order by created_at asc)
                               UNION 
                               (select ".$loss_fields." from processes 
                               where ".$wastage_where."
                               order by created_at asc)
                               UNION 
                               (select ".$karigar_loss_fields." from processes 
                               where ".$wastage_where."
                               order by created_at asc)
                               UNION 
                               (select ".$recutting_out_fields." from processes 
                               where ".$recutting_out_where."
                               order by created_at asc)
                               ");

    

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
}