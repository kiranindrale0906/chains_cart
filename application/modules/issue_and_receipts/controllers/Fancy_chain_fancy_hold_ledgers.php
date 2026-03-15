<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Fancy_chain_fancy_hold_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/same_karigar_model'));
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/fancy_chain_fancy_hold_ledgers/create');
  }

  public function _get_form_data() {
    $this->data['record']['in_lot_purity'] = (!empty($_GET['in_purity'])) ? $_GET['in_purity'] : '';
    $this->data['record']['karigar'] = (!empty($_GET['karigar'])) ? $_GET['karigar'] : '';

    $this->data['purities'] = array(array('name' => '100',       'id' => '100'),
                                    array('name' => '88%  >',    'id' => '92.00'),
                                    array('name' => '86% - 88%', 'id' => '87.65'),
                                    array('name' => '80% - 85%', 'id' => '83.65'),
                                    array('name' => '< 80%',     'id' => '75.15'));
    $this->data['karigar_name']=$this->same_karigar_model->get('Distinct(karigar_name) as name,karigar_name as id',
                                      array('product_name in ("Fancy Chain","Fancy 75 Chain")'=>NULL,'department_name'=>'Fancy Hold'));
    
    // if (empty($this->data['record']['karigar'])) return;
    if (empty($this->data['record']['in_lot_purity'])) return;

    $in_fields = 'processes.lot_no as lot_no,
                  processes.karigar as product_name, 
                  "Chain In" as issue_type,
                  melting_lot_details.required_weight as weight,
                  processes.in_lot_purity as purity, 
                  melting_lot_details.required_weight * processes.in_lot_purity / 100 as fine, 
                  date(melting_lot_details.created_at) as created_date, melting_lot_details.created_at';
   // $in_fields = 'processes.lot_no as lot_no,
   //                processes.karigar as product_name, 
   //                "In Weight" as issue_type,
   //                processes.in_weight as weight,
   //                processes.in_lot_purity as purity, 
   //                processes.in_weight * processes.in_lot_purity / 100 as fine, 
   //                date(processes.created_at) as created_date, processes.created_at';
    $hook_in_fields = 'processes.lot_no as lot_no,
                       processes.karigar as product_name, 
                       "Hook In" as issue_type,
                       process_details.hook_in as weight, 
                       processes.hook_kdm_purity as purity, 
                       process_details.hook_in * processes.hook_kdm_purity / 100 as fine, 
                       date(process_details.created_at) as created_date, process_details.created_at as created_at';
                   
    $out_fields = 'processes.lot_no as lot_no,
                   processes.karigar as product_name, 
                   "Out Weight" as issue_type, 
                   process_details.out_weight as weight, 
                   processes.in_lot_purity as purity, 
                   process_details.out_weight * processes.in_lot_purity / 100 as fine, 
                   date(process_details.created_at) as created_date, process_details.created_at as created_at';
    $hook_out_fields = 'processes.lot_no as lot_no,
                        processes.karigar as product_name, 
                        "Hook Out" as issue_type, 
                        process_details.hook_out as weight, 
                        processes.hook_kdm_purity as purity, 
                        process_details.hook_out * processes.hook_kdm_purity / 100 as fine, 
                        date(process_details.created_at) as created_date, process_details.created_at as created_at';
    $customer_out_fields = 'processes.lot_no as lot_no,
                            processes.karigar as product_name, 
                            "Customer Out" as issue_type, 
                            process_details.customer_out as weight, 
                            processes.out_lot_purity as purity, 
                            process_details.customer_out * processes.out_lot_purity / 100 as fine, 
                            date(process_details.created_at) as created_date, process_details.created_at as created_at';
    $factory_out_fields = 'processes.lot_no as lot_no,
                           processes.karigar as product_name, 
                           "Factory Out" as issue_type, 
                           factory_out as weight, 
                           out_lot_purity as purity, 
                           factory_out * out_lot_purity / 100 as fine, 
                           date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';
    $wastage_fields = 'processes.lot_no as lot_no,
                       processes.karigar as product_name, 
                       "Wastage" as issue_type, 
                       process_details.daily_drawer_wastage as weight, 
                       processes.in_lot_purity as purity, 
                       process_details.daily_drawer_wastage * processes.in_lot_purity / 100 as fine, 
                       date(process_details.created_at) as created_date, process_details.created_at as created_at';
    $ghiss_fields = 'processes.lot_no as lot_no,
                       processes.karigar as product_name, 
                       "Ghiss" as issue_type, 
                       process_details.ghiss as weight, 
                       processes.in_lot_purity as purity, 
                       process_details.ghiss * processes.in_lot_purity / 100 as fine, 
                       date(process_details.created_at) as created_date, process_details.created_at as created_at';                       
    $loss_fields = 'processes.lot_no as lot_no,
                   processes.karigar as product_name, 
                   "Loss" as issue_type, 
                   loss as weight, 
                   wastage_lot_purity as purity, 
                   loss * wastage_lot_purity / 100 as fine, 
                   date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';
    $tounch_in_fields = 'processes.lot_no as lot_no,
                         processes.karigar as product_name, 
                         "Tounch In" as issue_type, 
                         tounch_in as weight, 
                         wastage_lot_purity as purity, 
                         tounch_in * wastage_lot_purity / 100 as fine, 
                         date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';
    $fire_tounch_in_fields = 'processes.lot_no as lot_no,
                         processes.karigar as product_name, 
                         "Fire Tounch In" as issue_type, 
                         fire_tounch_in as weight, 
                         wastage_lot_purity as purity, 
                         fire_tounch_in * wastage_lot_purity / 100 as fine, 
                         date(IFNULL(completed_at,created_at)) as created_date, IFNULL(completed_at,created_at) as created_at';
    $recutting_out_fields = 'processes.lot_no as lot_no,
                       processes.karigar as product_name, 
                       "Process Out" as issue_type, 
                       process_details.recutting_out as weight, 
                       processes.in_lot_purity as purity, 
                       process_details.recutting_out * processes.in_lot_purity / 100 as fine, 
                       date(process_details.created_at) as created_date, process_details.created_at as created_at';    

    $in_where           = "processes.in_weight != 0 AND (processes.product_name = 'Fancy Chain' or processes.product_name = 'Fancy 75 Chain') AND processes.department_name = 'Fancy Hold'";
    $hook_in_where      = "process_details.hook_in != 0 AND (processes.product_name = 'Fancy Chain' or processes.product_name = 'Fancy 75 Chain') AND processes.department_name = 'Fancy Hold'";
    if(!empty($this->data['record']['in_lot_purity'])) {
      if ($this->data['record']['in_lot_purity'] == '83.65') {
        $in_where      .= ' and (processes.in_lot_purity >= 80 and processes.in_lot_purity < 85)' ;
        $hook_in_where .= ' and (processes.hook_kdm_purity >= 80 and processes.hook_kdm_purity < 85)' ;
      } elseif ($this->data['record']['in_lot_purity'] == '87.65') {
        $in_where.=' and (processes.in_lot_purity >= 85 and processes.in_lot_purity < 88)' ;
        $hook_in_where .= ' and (processes.hook_kdm_purity >= 85 and processes.hook_kdm_purity < 88)' ;
      } elseif ($this->data['record']['in_lot_purity'] == '75.15') {
        $in_where.=' and processes.in_lot_purity < 80' ;
        $hook_in_where .= ' and processes.hook_kdm_purity < 80' ;
      } elseif ($this->data['record']['in_lot_purity'] == '100') {
        $in_where.=' and processes.in_lot_purity = 100' ;
        $hook_in_where .= ' and processes.hook_kdm_purity = 100' ;
      } else {
        $in_where      .= ' and (processes.in_lot_purity >= 88 and processes.in_lot_purity < 100)' ;
        $hook_in_where .= ' and (processes.hook_kdm_purity >= 88 and processes.hook_kdm_purity < 100)' ;
      }
    }  
    if(!empty($this->data['record']['karigar'])){
      $in_where      .= ' and processes.karigar="'.$this->data['record']['karigar'].'"' ;
      $hook_in_where .= ' and processes.karigar="'.$this->data['record']['karigar'].'"' ;
    }
    
    $query = $this->db->query("(select ".$in_fields." from processes inner join melting_lot_details on melting_lot_details.melting_lot_id = processes.melting_lot_id
                               where ".$in_where."
                               order by melting_lot_details.created_at asc)
                             UNION 
                               (select ".$hook_in_fields." from processes inner join process_details on processes.id = process_details.process_id
                               where ".$hook_in_where."
                               order by created_at asc)");
    // $query = $this->db->query("(select ".$in_fields." from processes  where ".$in_where."
    //                            order by processes.created_at asc)
    //                          UNION 
    //                            (select ".$hook_in_fields." from processes inner join process_details on processes.id = process_details.process_id
    //                            where ".$hook_in_where."
    //                            order by created_at asc)");
    $receipts = $query->result_array();
    $out_where          = "process_details.out_weight != 0           AND (processes.product_name = 'Fancy Chain' or processes.product_name = 'Fancy 75 Chain') AND department_name = 'Fancy Hold' ";
    $hook_out_where     = "process_details.hook_out != 0             AND (processes.product_name = 'Fancy Chain' or processes.product_name = 'Fancy 75 Chain') AND department_name = 'Fancy Hold' ";
    $customer_out_where = "process_details.customer_out != 0         AND (processes.product_name = 'Fancy Chain' or processes.product_name = 'Fancy 75 Chain') AND department_name = 'Fancy Hold' ";
    $factory_out_where  = "processes.factory_out != 0          AND (processes.product_name = 'Fancy Chain' or processes.product_name = 'Fancy 75 Chain') AND department_name = 'Fancy Hold' ";
    $wastage_where      = "process_details.daily_drawer_wastage != 0 AND (processes.product_name = 'Fancy Chain' or processes.product_name = 'Fancy 75 Chain') AND department_name = 'Fancy Hold' ";
    $ghiss_where        = "process_details.ghiss != 0 AND (processes.product_name = 'Fancy Chain' or processes.product_name = 'Fancy 75 Chain') AND department_name = 'Fancy Hold' ";
    $loss_where         = "processes.loss != 0                 AND (processes.product_name = 'Fancy Chain' or processes.product_name = 'Fancy 75 Chain') AND department_name = 'Fancy Hold' ";
    $tounch_in_where         = "processes.tounch_in != 0                 AND (processes.product_name = 'Fancy Chain' or processes.product_name = 'Fancy 75 Chain') AND department_name = 'Fancy Hold' ";
    $fire_tounch_in_where         = "processes.fire_tounch_in != 0                 AND (processes.product_name = 'Fancy Chain' or processes.product_name = 'Fancy 75 Chain') AND department_name = 'Fancy Hold'";
    $recutting_out_where         = "process_details.recutting_out != 0                 AND (processes.product_name = 'Fancy Chain' or processes.product_name = 'Fancy 75 Chain') AND processes.department_name = 'Fancy Hold'";
    if(!empty($this->data['record']['karigar'])){
      $out_where          .= " and process_details.karigar='".$this->data['record']['karigar']."'";
      $hook_out_where          .= " and processes.karigar='".$this->data['record']['karigar']."'";
      $customer_out_where .= " and processes.karigar='".$this->data['record']['karigar']."'";
      $factory_out_where  .= " and processes.karigar='".$this->data['record']['karigar']."'";
      $wastage_where      .= " and processes.karigar='".$this->data['record']['karigar']."'";
      $ghiss_where        .= " and processes.karigar='".$this->data['record']['karigar']."'";
      $loss_where         .= " and processes.karigar='".$this->data['record']['karigar']."'";
      $tounch_in_where    .= " and processes.karigar='".$this->data['record']['karigar']."'";
      $fire_tounch_in_where.= " and processes.karigar='".$this->data['record']['karigar']."'";
      $recutting_out_where.= " and processes.karigar='".$this->data['record']['karigar']."'";
    }
    
    $purity_where = '';
    if(!empty($this->data['record']['in_lot_purity'])){
      if ($this->data['record']['in_lot_purity'] == '83.65'){
        $purity_where          .= ' and (processes.in_lot_purity >= 80 and processes.in_lot_purity < 85)';
        $hook_out_where     .= ' and (processes.hook_kdm_purity >= 80 and processes.hook_kdm_purity < 85)';
        // $customer_out_where .= ' and (processes.in_lot_purity >= 80 and processes.in_lot_purity < 85)';
        // $factory_out_where  .= ' and (processes.in_lot_purity >= 80 and processes.in_lot_purity < 85)';
        // $wastage_where      .= ' and (processes.in_lot_purity >= 80 and processes.in_lot_purity < 85)';
        // $loss_where         .= ' and (processes.in_lot_purity >= 80 and processes.in_lot_purity < 85)';
      }elseif ($this->data['record']['in_lot_purity'] == '87.65'){ 
        $purity_where          .= ' and (processes.in_lot_purity >= 86 and processes.in_lot_purity < 88)';
        $hook_out_where     .= ' and (processes.hook_kdm_purity >= 86 and processes.hook_kdm_purity < 88)';
        // $customer_out_where .= ' and (processes.in_lot_purity >= 86 and processes.in_lot_purity < 88)';
        // $factory_out_where  .= ' and (processes.in_lot_purity >= 86 and processes.in_lot_purity < 88)';
        // $wastage_where      .= ' and (processes.in_lot_purity >= 86 and processes.in_lot_purity < 88)';
        // $loss_where         .= ' and (processes.in_lot_purity >= 86 and processes.in_lot_purity < 88)';
      }elseif ($this->data['record']['in_lot_purity'] == '75.15') {
        $purity_where          .= ' and processes.in_lot_purity < 80';
        $hook_out_where     .= ' and processes.hook_kdm_purity < 80';
        // $customer_out_where .= ' and processes.in_lot_purity < 80';
        // $factory_out_where  .= ' and processes.in_lot_purity < 80';
        // $wastage_where      .= ' and processes.in_lot_purity < 80';
        // $loss_where         .= ' and processes.in_lot_purity < 80';
      }elseif ($this->data['record']['in_lot_purity'] == '100') {
        $purity_where          .= ' and processes.in_lot_purity = 100';
        $hook_out_where     .= ' and processes.hook_kdm_purity = 100';
        // $customer_out_where .= ' and processes.in_lot_purity = 100';
        // $factory_out_where  .= ' and processes.in_lot_purity = 100';
        // $wastage_where      .= ' and processes.in_lot_purity = 100';
        // $loss_where         .= ' and processes.in_lot_purity = 100';
      }else {
        $purity_where          .= ' and (processes.in_lot_purity >= 88 and processes.in_lot_purity < 100)';
        $hook_out_where     .= ' and (processes.hook_kdm_purity >= 88 and processes.hook_kdm_purity < 100)';
        // $customer_out_where .= ' and (processes.in_lot_purity >= 88 and processes.in_lot_purity < 100)';
        // $factory_out_where  .= ' and (processes.in_lot_purity >= 88 and processes.in_lot_purity < 100)';
        // $wastage_where      .= ' and (processes.in_lot_purity >= 88 and processes.in_lot_purity < 100)';
        // $loss_where         .= ' and (processes.in_lot_purity >= 88 and processes.in_lot_purity < 100)';
      }
    }

    $out_where          .= $purity_where;
    $customer_out_where .= $purity_where;
    $factory_out_where  .= $purity_where;
    $wastage_where      .= $purity_where;
    $ghiss_where        .= $purity_where;
    $loss_where         .= $purity_where;
    $tounch_in_where    .= $purity_where;
    $fire_tounch_in_where.= $purity_where;
    $recutting_out_where.= $purity_where;

    
    $query = $this->db->query("(select ".$out_fields." from processes inner join process_details on processes.id = process_details.process_id
                                where ".$out_where."
                                order by process_details.created_at asc)
                            UNION 
                               (select ".$hook_out_fields." from processes inner join process_details on processes.id = process_details.process_id
                               where ".$hook_out_where."
                               order by process_details.created_at asc)
                            UNION 
                               (select ".$customer_out_fields." from processes inner join process_details on processes.id = process_details.process_id
                               where ".$customer_out_where."
                               order by process_details.created_at asc)
                            UNION 
                               (select ".$wastage_fields." from processes inner join process_details on processes.id = process_details.process_id
                               where ".$wastage_where."
                               order by process_details.created_at asc)
                            UNION 
                               (select ".$ghiss_fields." from processes inner join process_details on processes.id = process_details.process_id
                               where ".$ghiss_where."
                               order by process_details.created_at asc)
                            UNION 
                               (select ".$loss_fields." from processes 
                               where ".$loss_where."
                               order by processes.created_at asc)
                            UNION 
                               (select ".$tounch_in_fields." from processes 
                               where ".$tounch_in_where."
                               order by processes.created_at asc)
                            UNION 
                               (select ".$fire_tounch_in_fields." from processes 
                               where ".$fire_tounch_in_where."
                               order by processes.created_at asc)
                            UNION 
                               (select ".$recutting_out_fields." from processes inner join process_details on processes.id = process_details.process_id
                               where ".$recutting_out_where."
                               order by processes.created_at asc)
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