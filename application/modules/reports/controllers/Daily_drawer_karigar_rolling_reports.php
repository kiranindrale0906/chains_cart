
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Daily_drawer_karigar_rolling_reports extends Ledgers {
  public function __construct(){
    parent::__construct();
    $this->redirect_after_save = 'view';
    $this->load->model('processes/process_model');
  }

  public function index() {
    $this->_get_form_data();
//pd($this->data);
    $this->data['sum_in_weight']=array();    
    foreach ($this->data['receipts'] as $index => $date_wise_record) {
      $this->data['sum_in_weight'][$index]+=array_sum(array_column($date_wise_record,'weight'));
    }
//pd($this->data);
    $last_balance=$last_month_opening=0;
    foreach ($this->data['receipts'] as $index => $date_wise_record) {
      $month_date_count=$this->get_days_in_month(date('m',strtotime($index)),date('Y',strtotime($index)));
    $balance=$in_weight=$out_weight=0;
//    echo"<pre>";echo $index; print_r($last_month_opening);

    for ($i=1; $i <= $month_date_count ; $i++){
      $date_month_year=date('Y-m-'.sprintf("%02d", $i),strtotime($index));
      $date_month=date('Y-m',strtotime($index));
	
      $this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['date']=$date_month_year;
      $this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['karigar']=$this->data['karigar'];
      $this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['purity']=$this->data['hook_kdm_purity'];
	if(strtotime(date('Y-m-d'))>=strtotime(date('Y-m-d',strtotime($date_month_year)))){
      $this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['opening']=!empty($this->data['opening'][$date_month_year]['receipt']['weight'])?$this->data['opening'][$date_month_year]['receipt']['weight']:$balance;
      $this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['in_weight']=!empty($this->data['sum_in_weight'][$date_month_year])?$this->data['sum_in_weight'][$date_month_year]:0; //$sum_in_weight;
      $this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['out_weight']=!empty($this->data['total'][$date_month_year]['issue']['weight'])?$this->data['total'][$date_month_year]['issue']['weight']:0;
      $this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['balance']=($this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['opening']+$this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['in_weight']-$this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['out_weight']);

      $this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['rolling']=!empty($this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['in_weight'])?($this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['out_weight']/($this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['opening']-$this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['in_weight'])):0;
      $this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['utilization']=!empty($this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['in_weight'])?($this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['out_weight']/($this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['opening']-$this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['in_weight'])):0;
      $in_weight=$this->data['sum_in_weight'][$date_month_year];
      $out_weight=$this->data['total'][$date_month_year]['issue']['weight'];
      $balance=$this->data['record']['dd_karigar_rolling_data'][$date_month][$date_month_year]['balance'];

    }}
}

//pd($this->data['record']['dd_karigar_rolling_data']);
  parent::view(1);
  }
  public function _get_form_data() {
    $this->data['karigar'] = (isset($_GET['karigar']) ? $_GET['karigar'] : '');
    $this->data['hook_kdm_purity'] = (isset($_GET['hook_kdm_purity']) ? $_GET['hook_kdm_purity'] : '');
    $this->data['group_by_purity'] = (isset($_GET['group_by_purity']) ? $_GET['group_by_purity'] : '');
    $this->data['type'] = (isset($_GET['type']) ? $_GET['type'] : '');

      if (empty($this->data['karigar']) OR empty($this->data['hook_kdm_purity'])) return;
      $where_for_process_details = "process_details.karigar = '".$this->data['karigar']."' 
                                    AND processes.hook_kdm_purity = '".$this->data['hook_kdm_purity']."'";
      $where_for_process = "process_details.karigar = '".$this->data['karigar']."' 
                                    AND processes.hook_kdm_purity = '".$this->data['hook_kdm_purity']."'";

      $sisma_where_for_process="processes.karigar = '".$this->data['karigar']."' and processes.hook_kdm_purity = '".$this->data['hook_kdm_purity']."' and processes.product_name in ('Sisma Accessories Making Chain','Office Outside','Daily Drawer Receipt')";                             
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

    
//lq();      
      $receipts = $query->result_array();

   if(!empty($this->data['karigar']) && $this->data['karigar']=='Sisma Accessory'){
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
    $issue_created_dates = array_column($issues, 'created_date');
    $receipt_created_dates = array_column($receipts, 'created_date');
    $this->data['created_dates'] = array_values(array_unique(array_merge($issue_created_dates, $receipt_created_dates)));
    asort($this->data['created_dates']);
    
    $this->data['receipts'] = parent::get_records_by_created_date($receipts);
    $this->data['issues'] = parent::get_records_by_created_date($issues);
    $this->data['total'] = array();

    $this->get_total_by_created_date($this->data['issues'], 'issue');


    $this->get_total_by_created_date($this->data['receipts'], 'receipt');

    $this->set_index_for_dates();

    $this->get_balance_by_created_date();
//    pd($this->data);

  }
  function get_days_in_month($month, $year)
    {
        if ($month == "02")
        {
            if ($year % 4 == 0) return 29;
            else return 28;
        }
        else if ($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10" || $month == "12") return 31;
        else return 30;
    }
}
