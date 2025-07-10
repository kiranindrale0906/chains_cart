<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Karigar_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
  }
  public function index() {
    // pd($this->data);
    redirect(base_url().'issue_and_receipts/karigar_ledgers/create');
  }
  public function create() {
    $this->data['karigar'] = (isset($_GET['karigar']) ? $_GET['karigar'] : '');
    $this->data['hook_kdm_purity'] = (isset($_GET['hook_kdm_purity']) ? $_GET['hook_kdm_purity'] : '');
    $this->data['group_by_purity'] = (isset($_GET['group_by_purity']) ? $_GET['group_by_purity'] : '');
    $this->data['type'] = (isset($_GET['type']) ? $_GET['type'] : '');
    parent::create();
  }

  public function _get_form_data() {
    if (empty($this->data['karigar']) OR empty($this->data['hook_kdm_purity'])) return;

    if($this->data['group_by_purity']==1){
      if ($this->data['hook_kdm_purity']=='- 80%') {
        $where_for_process_details = "process_details.karigar = '".$this->data['karigar']."' 
                                      AND process_details.hook_kdm_purity < 80";
        $where_for_process = "processes.karigar = '".$this->data['karigar']."' 
                              AND processes.hook_kdm_purity < 80";
      
      } elseif ($this->data['hook_kdm_purity']=='80% - 88%') {
        $where_for_process_details = "process_details.karigar = '".$this->data['karigar']."' 
                                      AND process_details.hook_kdm_purity >= 80 AND process_details.hook_kdm_purity < 88";
        $where_for_process = "processes.karigar = '".$this->data['karigar']."' 
                                      AND processes.hook_kdm_purity >= 80 AND processes.hook_kdm_purity < 88";

      } elseif($this->data['hook_kdm_purity']=='88%') {
        $where_for_process_details = "process_details.karigar = '".$this->data['karigar']."' 
                                      AND process_details.hook_kdm_purity >= 88 AND process_details.hook_kdm_purity < 100";
        $where_for_process = "processes.karigar = '".$this->data['karigar']."' 
                                      AND processes.hook_kdm_purity >= 88 AND processes.hook_kdm_purity < 100";

      } else {
        $where_for_process_details = "process_details.karigar = '".$this->data['karigar']."' 
                                      AND process_details.hook_kdm_purity=100";
        $where_for_process = "processes.karigar = '".$this->data['karigar']."' 
                                      AND processes.hook_kdm_purity=100";
      }

      
    } else {
      $where_for_process_details = "process_details.karigar = '".$this->data['karigar']."' 
                                    AND process_details.hook_kdm_purity = '".$this->data['hook_kdm_purity']."'";
      $where_for_process = "process_details.karigar = '".$this->data['karigar']."' 
                                    AND processes.hook_kdm_purity = '".$this->data['hook_kdm_purity']."'";
    }                                    

    if (!empty($this->data['type']))  {
      $where_for_process_details .= " AND process_details.daily_drawer_type = '".$this->data['type']."'";
      $where_for_process .=  " AND process_details.daily_drawer_type = '".$this->data['type']."'";
    }
    
    $process_detail_fields = 'processes.lot_no as lot_no,
                              daily_drawer_type as product_name, 
                              processes.department_name as issue_type, 
                              process_details.hook_in - process_details.hook_out + process_details.daily_drawer_out_weight as weight, 
                              process_details.hook_kdm_purity as purity, 
                              (process_details.hook_in - process_details.hook_out + process_details.daily_drawer_out_weight) * process_details.hook_kdm_purity / 100 as fine, 
                              date(process_details.created_at) as created_date, process_details.created_at';

    $sisma_process_detail_fields = 'processes.lot_no as lot_no,
                              daily_drawer_type as product_name, 
                              processes.department_name as issue_type, 
                              process_details.sisma_in - process_details.sisma_out + process_details.daily_drawer_out_weight as weight, 
                              process_details.hook_kdm_purity as purity, 
                              (process_details.sisma_in - process_details.sisma_out + process_details.daily_drawer_out_weight) * process_details.hook_kdm_purity / 100 as fine, 
                              date(process_details.created_at) as created_date, process_details.created_at';

    if (!empty($this->data['type']) && $this->data['type']=='Stone')  {

      $process_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       product_name as issue_type,
                       processes.stone_out as weight, 
                       in_lot_purity as purity, 
                       stone_out * in_lot_purity / 100 as fine, 
                       date(created_at) as created_date, created_at';
      $where_for_processes = "processes.stone_out != 0 and processes.karigar = '".$this->data['karigar']."'";
      if($this->data['hook_kdm_purity']==92){
        $where_for_processes.=' and processes.in_lot_purity>="76"';
      }else{
        $where_for_processes.=' and processes.in_lot_purity<"76"';
      }


      $query = $this->db->query("select ".$process_fields." from processes 
                               where ".$where_for_processes."
                               order by created_at asc;");
   
    }else{

      $process_fields = 'processes.lot_no as lot_no,
                         daily_drawer_type as product_name,
                         processes.department_name as issue_type,
                         process_details.daily_drawer_in_weight as weight, 
                         processes.hook_kdm_purity as purity, 
                         process_details.daily_drawer_in_weight * processes.hook_kdm_purity / 100 as fine, 
                         date(process_details.created_at) as created_date, process_details.created_at as created_at';

      $query = $this->db->query("select ".$process_fields." from process_details 
                                 inner join processes on process_details.process_id = processes.id
                                 where ".$where_for_process." and process_details.daily_drawer_in_weight != 0
                                 order by created_at asc;");
    }

    $receipts = $query->result_array();

    if(!empty($this->data['type']) && $this->data['type']=='GPC Powder'){
       $process_fields = '"" as lot_no,
                       product_name as product_name, 
                       product_name as issue_type,
                       in_weight as weight, 
                       in_purity as purity, 
                       in_weight * in_purity / 100 as fine, 
                       date(created_at) as created_date, created_at';
     $issue_where_for_processes = "in_purity = '".$this->data['hook_kdm_purity']."'
                              AND product_name = '".$this->data['type']."'";

      $query = $this->db->query("select ".$process_fields." from issue_departments 
                               where  ".$issue_where_for_processes."
                                     AND in_weight>0
                               order by created_at asc;");
    }elseif(!empty($this->data['type']) && $this->data['type']=='Stone'){



      $process_fields = 'lot_no as lot_no,
                       product_name as product_name, 
                       product_name as issue_type,
                       stone_in as weight, 
                       in_lot_purity as purity, 
                       stone_in * in_lot_purity / 100 as fine, 
                       date(created_at) as created_date, created_at';
      $where_for_processes = "processes.stone_in != 0 and processes.karigar = '".$this->data['karigar']."' 
                              ";
      if($this->data['hook_kdm_purity']==92){
        $where_for_processes.=' and processes.in_lot_purity>="76"';
      }else{
        $where_for_processes.=' and processes.in_lot_purity<"76"';
      }
                              

      $query = $this->db->query("select ".$process_fields." from processes 
                               where ".$where_for_processes."
                               order by created_at asc;");
    }elseif(!empty($this->data['karigar']) && $this->data['karigar']=='Sisma Accessory'){
      $query = $this->db->query("select ".$sisma_process_detail_fields." from process_details 
                               inner join processes on process_details.process_id = processes.id
                               where ".$where_for_process_details."
                                     AND (processes.product_name in ('Sisma Accessories Making Chain','Sisma Chain'))
                               order by created_at asc;");

    }else{
      $query = $this->db->query("select ".$process_detail_fields." from process_details 
                               inner join processes on process_details.process_id = processes.id
                               where ".$where_for_process_details."
                                     AND (process_details.hook_in != 0 
                                          OR process_details.hook_out != 0 
                                          OR process_details.daily_drawer_out_weight != 0)
                               order by created_at asc;");

    }

    

    $issues = $query->result_array();
//lq();
    $issue_created_dates = array_column($issues, 'created_date');
    $receipt_created_dates = array_column($receipts, 'created_date');
    $this->data['created_dates'] = array_values(array_unique(array_merge($issue_created_dates, $receipt_created_dates)));
    asort($this->data['created_dates']);
    
    $this->data['receipts'] = parent::get_records_by_created_date($receipts);
    $this->data['issues'] = parent::get_records_by_created_date($issues);

    $this->data['total'] = array();

    parent::get_total_by_created_date($this->data['issues'], 'issue');


    parent::get_total_by_created_date($this->data['receipts'], 'receipt');

    parent::set_index_for_dates();

    parent::get_balance_by_created_date();

  }
}
