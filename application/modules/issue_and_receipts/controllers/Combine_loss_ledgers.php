<?php
include_once APPPATH . "modules/issue_and_receipts/controllers/Ledgers.php";
class Combine_loss_ledgers extends Ledgers {
  public function __construct() {
    parent::__construct();
    $this->load->model(array('processes/process_model','settings/loss_category_model'));
  
  }

  public function index() {
    redirect(base_url().'issue_and_receipts/combine_loss_ledgers/create');
  }
  
  public function _get_form_data() {
    $this->data['department_name']=$this->loss_category_model->get('name as name ,name as id',array(),array(),array('group_by'=>'name'));
    $query =$this->db->query("select Distinct(".ARF_DB_NAME.". loss_categories.name) as id ,".ARF_DB_NAME.". loss_categories.name as name from  ".ARF_DB_NAME.". loss_categories UNION select Distinct(".ARGOLD_DB_NAME.".loss_categories.name) as id ,".ARGOLD_DB_NAME.". loss_categories.name as name from  ".ARGOLD_DB_NAME.". loss_categories");
    $this->data['department_name'] = $query->result_array();


    $department_names=array();
    if(!empty($_GET['department_name'])){
      $this->data['record']['department_name']=!empty($_GET['department_name'])?$_GET['department_name']:'';
      $department_names=$this->loss_category_model->get('department_name',array('name'=>$_GET['department_name']));
      $department_names=array_column($department_names, 'department_name');
      $departments='"'.implode('", "', $department_names).'"';
    }
    if (!empty($this->data['record']['department_name'])) {
    $query = $this->db->query($this->select_statement_issue(ARGOLD_DB_NAME,"ARG",$departments)." UNION ".$this->select_statement_issue(ARF_DB_NAME,"ARF",$departments));
      // ." UNION ".$this->select_statement_issue(ARC_DB_NAME,"ARC",$departments));

    $issues = $query->result_array();

    $query = $this->db->query($this->select_statement_receipt(ARGOLD_DB_NAME,"ARG",$departments)." UNION ".$this->select_statement_receipt(ARF_DB_NAME,"ARF",$departments));
      // ." UNION ".$this->select_statement_receipt(ARC_DB_NAME,"ARC",$departments));
   $receipts = $query->result_array();

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
 private function select_statement_issue($database_name,$type,$departments){
    $process_fields=''.$database_name.'.processes.lot_no as lot_no,
                                          '.$database_name.'.processes.product_name as product_name, 
                                          '.$database_name.'.processes.department_name as issue_type, 
                                          "'.$type.'" as account_type,
                                          '.$database_name.'.process_out_wastage_details.out_weight as weight, 
                                          '.$database_name.'.processes.in_lot_purity as purity, 
                                          '.$database_name.'.processes.in_weight as in_weight,
                                          '.$database_name.'.processes.out_weight as out_weight,
                                          ('.$database_name.'.process_out_wastage_details.out_weight * '.$database_name.'.processes.out_purity / 100 * '.$database_name.'.processes.out_lot_purity / 100) as fine,
                                           ('.$database_name.'.process_out_wastage_details.out_weight * '.$database_name.'.processes.out_purity / 100) as gross, 
                                          date('.$database_name.'.process_out_wastage_details.created_at) as created_date, '.$database_name.'.process_out_wastage_details.created_at';
                       

  return $sql_query="(select ".$process_fields." from    
                                ".$database_name.".process_out_wastage_details 
                               inner join ".$database_name.".processes on ".$database_name.".process_out_wastage_details.process_id = ".$database_name.".processes.id
                               where ".$database_name.".process_out_wastage_details.field_name = 'Loss Out' 
                                     AND ".$database_name.".process_out_wastage_details.out_weight != 0 
                                     AND
                                     ".$database_name.".processes.department_name in (".$departments.") 
                               order by ".$database_name.".process_out_wastage_details.created_at asc)";

 }
 private function select_statement_receipt($database_name,$type,$departments){
  $process_fields = ''.$database_name.'.processes.lot_no as lot_no,
                       '.$database_name.'.processes.product_name as product_name, 
                       '.$database_name.'.processes.department_name as issue_type,
                       "'.$type.'" as account_type,
                       '.$database_name.'.processes.loss +'.$database_name.'.processes.karigar_loss as weight, 
                       '.$database_name.'.processes.in_weight as in_weight,
                       '.$database_name.'.processes.out_weight as out_weight,
                       '.$database_name.'.processes.in_lot_purity as purity, 
                       ('.$database_name.'.processes.loss +'.$database_name.'.processes.karigar_loss * '.$database_name.'.processes.out_purity / 100) as gross, 
                       ('.$database_name.'.processes.loss +'.$database_name.'.processes.karigar_loss * '.$database_name.'.processes.out_purity / 100 * processes.out_lot_purity / 100) as fine, 
                       date('.$database_name.'.processes.created_at) as created_date, '.$database_name.'.processes.created_at as created_at';
 
  return $sql_query="(select ".$process_fields." from  ".$database_name.".processes
                                where (".$database_name.".processes.loss != 0 or ".$database_name.".processes.karigar_loss != 0) and ".$database_name.".processes.wastage_purity > 0 and ".$database_name.".processes.wastage_lot_purity > 0 and ".$database_name.".processes.product_name!= 'Ghiss Out' AND
                                ".$database_name.".processes.department_name in (".$departments.")
                               order by ".$database_name.".processes.created_at asc)";

 } 
}