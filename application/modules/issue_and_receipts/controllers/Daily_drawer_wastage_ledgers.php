<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Daily_drawer_wastage_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model'));
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/daily_drawer_wastage_ledgers/create');
  }

  public function create() {
    $this->data['hook_kdm_purity'] = (isset($_GET['hook_kdm_purity']) ? $_GET['hook_kdm_purity'] : '');
    $this->data['department_name'] = (isset($_GET['department_name']) ? $_GET['department_name'] : '');
    $this->data['not_hook'] = (isset($_GET['not_hook']) ? $_GET['not_hook'] : '');
    parent::create();
  }

  public function _get_form_data() {
    if (!empty($this->data['hook_kdm_purity'])) {

      if ($this->data['hook_kdm_purity'] == '83.65') {
        $where_for_processes = ' processes.hook_kdm_purity >80 and processes.hook_kdm_purity < 85 and pending_loss=0';
        $where_for_process_details = ' processes.hook_kdm_purity >80 and processes.hook_kdm_purity < 85';
      }elseif ($this->data['hook_kdm_purity'] == '87.65') {
        $where_for_processes = 'processes.hook_kdm_purity >86 and processes.hook_kdm_purity < 88 and pending_loss=0';
        $where_for_process_details = 'processes.hook_kdm_purity >86 and processes.hook_kdm_purity < 88 and pending_loss=0';
      }elseif ($this->data['hook_kdm_purity'] == '75.15') {
        $where_for_processes = 'processes.hook_kdm_purity < 80 ';
        $where_for_process_details = 'processes.hook_kdm_purity < 80 and pending_loss=0';
        
      }elseif ($this->data['hook_kdm_purity'] == '100') {
        $where_for_processes = 'processes.hook_kdm_purity = 100 and product_name="Fire Tounch Out" and pending_loss=0';
        $where_for_process_details = 'processes.hook_kdm_purity = 100 and product_name="Fire Tounch Out" and pending_loss=0';
      } else {
        $where_for_processes = 'processes.hook_kdm_purity > 88 and processes.hook_kdm_purity < 100 and pending_loss=0';
        $where_for_process_details = 'processes.hook_kdm_purity > 88 and processes.hook_kdm_purity < 100 and pending_loss=0';
      }
      
      
      // if($this->data['hook_kdm_purity']==100){
      //   $where_for_processes =($this->data['hook_kdm_purity']==100) ? 'processes.hook_kdm_purity = 100 and product_name="Fire Tounch Out"' :"hook_kdm_purity = ".$this->data['hook_kdm_purity']."";
      // }else{
      //   $where_for_processes =($this->data['hook_kdm_purity']==83.65) ? 'processes.hook_kdm_purity IN (83.50, 83.65)' :"hook_kdm_purity = ".$this->data['hook_kdm_purity']."";
      // }

      // $where_for_process_details = "processes.hook_kdm_purity = ".$this->data['hook_kdm_purity']."";

    
      if (HOST == 'ARF') {
        if($this->data['hook_kdm_purity']!=100){
        if (!empty($_GET['section']) && $_GET['section'] == '1') {
        $where = '(   process_name in ("Box Start Process", "Box Chain Process", "Anchor Start Process", "Anchor Process", "ARF KDM") or (process_name = "Strip Start Process"  and department_name in ("Melting", "Flatting"))
                                       or (product_name = "Tounch Out" and process_name = "Melting")
                                       or (process_name = "Shook" and department_name in ("Melting", "Tar Making"))
                                       or (process_name in ("Cap","Pipe","Lasiya","Para") and department_name in ("Melting", "Flatting","Pipe Making","Tarpatta","Pipe And Para Making","Box Tar Chain"))
                                       or (product_name = "Daily Drawer" and process_name = "Melting")
                                       or (product_name in ("Dhoom A","Dhoom B") and department_name in ("Melting","Flatting"))
                                       or (product_name = "Solder Wastage" and process_name = "Melting")
                                       or (product_name = "Tounch Out" and process_name = "Melting")
                                       or (product_name = "Adjustment" and process_name = "Adjustment Process"))';
       }elseif(!empty($_GET['section']) && $_GET['section'] == '2'){
        $where='( process_name in ("Vishnu Process", "Laser Process", "Hammering Process", "Ashish Process", 
                                                       "Hammering II Process", 
                                                       "CNC Process", "DC Process", "Round and Ball Chain Process",
                                                       "CNC Recutting Process", "DC Recutting Process", "Round and Ball Chain Recutting Process",
                                                       "Factory Process")
                                      or (process_name = "Shook" and department_name = "Round and Ball Chain")
                                      or (product_name in ("Dhoom A","Dhoom B") and department_name in ("Hammering I"))
                                      
                                      or (process_name in ("Cap","Pipe","Lasiya","Para") and department_name in ("Dull", "Diamond Cutting","Round and Ball Chain","Hand Cutting","Final")))';
       }elseif(!empty($_GET['section']) && $_GET['section'] == '3'){
        $where='(product_name = "Fancy Chain")';
       }else{
        $where='(    process_name in ("Hook Process", "Refresh")
                                       or (process_name = "Shook" and department_name = "S Making")
                                       or (process_name = "Cap" and department_name = "Stamping")
                                       or (product_name in ("Dhoom A","Dhoom B") and department_name in ("Stamping","Chain Making"))
                                       or (process_name = "Ghiss Out" and department_name = "Melting")))';
       }
       $where_for_processes = $where_for_processes."
                              AND ".$where;
      $where_for_process_details = $where_for_process_details." AND ".$where;
      }}
      else 
      if (!empty($this->data['department_name'])) {  
      $where="processes.department_name = '".$this->data['department_name']."'";
       
      $where_for_processes = $where_for_processes."
                              AND ".$where;

      $where_for_process_details = $where_for_process_details." AND ".$where;
   }
    if (HOST!='ARF' && !empty($this->data['not_hook'])) {

      $where_for_processes = $where_for_processes."
                              AND department_name != 'Hook'";

      $where_for_process_details = $where_for_process_details." AND processes.department_name != 'Hook'";
    }
      $process_out_wastage_detail_fields = 'lot_no as lot_no,
                                            product_name as product_name, 
                                            type as issue_type,
                                            process_out_wastage_details.out_weight as weight, 
                                            hook_kdm_purity as purity, 
                                            process_out_wastage_details.out_weight * hook_kdm_purity / 100 as fine, 
                                            date(process_out_wastage_details.created_at) as created_date, 
                                            process_out_wastage_details.created_at';

      $issue_department_detail_fields = 'lot_no as lot_no,
                                         product_name as product_name, 
                                         type as issue_type,
                                         issue_department_details.out_weight as weight, 
                                         hook_kdm_purity as purity, 
                                         issue_department_details.out_weight * hook_kdm_purity / 100 as fine, 
                                         date(issue_department_details.created_at) as created_date, 
                                         issue_department_details.created_at';                          

      $process_fields = 'lot_no as lot_no,
                         product_name as product_name, 
                         type as issue_type,
                         daily_drawer_wastage as weight, 
                         hook_kdm_purity as purity, 
                         daily_drawer_wastage * hook_kdm_purity / 100 as fine, 
                         date(created_at) as created_date, created_at';

      $query = $this->db->query("select ".$process_fields." from processes 
                                 where daily_drawer_wastage > 0  AND
                                     ".$where_for_processes."
                                 order by created_at asc;");


      
      $receipts = $query->result_array();

      $query = $this->db->query("(select ".$process_out_wastage_detail_fields." from process_out_wastage_details 
                                 inner join processes on process_out_wastage_details.process_id = processes.id  AND
                                            ".$where_for_process_details." 
                                 where field_name = 'Daily Drawer Wastage')

                                 UNION
                                 
                                 (select ".$issue_department_detail_fields." from issue_department_details 
                                 inner join processes on issue_department_details.process_id = processes.id 
                                            AND ".$where_for_process_details."
                                 where field_name = 'Daily Drawer Wastage')

                                 order by created_at asc;");


      $issues = $query->result_array();

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
}