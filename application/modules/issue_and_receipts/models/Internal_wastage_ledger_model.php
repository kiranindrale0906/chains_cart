<?php 
include_once APPPATH . "modules/issue_and_receipts/models/Ledger_model.php";
class Internal_wastage_ledger_model extends Ledger_model{
	protected $table_name= 'processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
	}

  // public function get_receipt_records() {
  //   $internal_details = 'product_name, account as issue_type, description description,in_weight as weight, in_lot_purity as purity, in_weight * in_lot_purity / 100 as fine,date(created_at) as created_date, created_at';
  //   $query = $this->db->query("select ".$internal_details." from processes where description!='' order by created_at asc;");

  //   $receipts = $query->result_array();
  //   return $receipts;
  // }

  // public function get_issue_records() {
  //   $issue_department_fields = 'product_name, issue_type, internal_wastage as description,in_weight as weight, in_purity as purity, in_weight * in_purity / 100 as fine,date(created_at) as created_date, created_at';

  //   $query = $this->db->query("select ".$issue_department_fields."  from issue_departments where internal_wastage!='' order by created_at asc;");
  //   $issues = $query->result_array();
  //   return $issues;
  // }
 public function get_issue_department_records($database_name,$account_name,$period='',$wastage=''){
    $period_select="";
    $internal_wastage="";
    if(!empty($wastage)) $internal_wastage = 'and '.$database_name.'.issue_departments.internal_wastage='.'"'.$wastage.'"';
    if ($period == 'month') $period_select = 'date_format('.$database_name.'.issue_departments.created_at,"%Y-%m") as created_date,';
    elseif ($period == 'year') $period_select = 'date_format('.$database_name.'.issue_departments.created_at,"%Y") as created_date,';
    elseif ($period == 'week') {
      $period_from_date = 'DATE_SUB(
                                DATE_ADD(MAKEDATE(date_format('.$database_name.'.issue_departments.created_at,"%Y"), 1), INTERVAL week('.$database_name.'.issue_departments.created_at) WEEK),
                                INTERVAL WEEKDAY(
                                   DATE_ADD(MAKEDATE(date_format('.$database_name.'.issue_departments.created_at,"%Y"), 1), INTERVAL week('.$database_name.'.issue_departments.created_at) WEEK)
                                ) -1 DAY)';
      $period_to_date = 'DATE_SUB(
                                DATE_ADD(MAKEDATE(date_format('.$database_name.'.issue_departments.created_at,"%Y"), 1), INTERVAL week('.$database_name.'.issue_departments.created_at) WEEK),
                                INTERVAL WEEKDAY(
                                   DATE_ADD(MAKEDATE(date_format('.$database_name.'.issue_departments.created_at,"%Y"), 1), INTERVAL week('.$database_name.'.issue_departments.created_at) WEEK)
                                ) -7 DAY)';
      $period_select = 'CONCAT('.$period_from_date.' , " - ", '.$period_to_date.') as created_date,';
    }else{
      $period_select = 'date_format('.$database_name.'.issue_departments.created_at,"%Y-%m-%d") as created_date,';
    }
    
    $process_fields=
  ''.$period_select.' date_format('.$database_name.'.issue_departments.created_at,"%Y-%m-%d") as str_created_date,
  '.$database_name.'.internal_wastages.name as item,
  '.$database_name.'.issue_departments.account_id as account_name,
  '.$database_name.'.issue_departments.in_weight as weight,
  '.$database_name.'.issue_departments.in_purity as melting,
  '.$database_name.'.issue_departments.in_fine as fine,
  IFNULL('.$database_name.'.internal_wastages.wastage,0) as internal_wastage,
  IFNULL(('.$database_name.'.issue_departments.in_purity),0) +IFNULL(('.$database_name.'.internal_wastages.wastage),0) as issue_melting';

   $sql_query="(select ".$process_fields." from    
                                ".$database_name.".issue_departments
                                left join ".$database_name.".internal_wastages on ".$database_name.".issue_departments.internal_wastage = ".$database_name.".internal_wastages.name
 
                                 where ".$database_name.".issue_departments.account_id='".$account_name."' and ".$database_name.".issue_departments.internal_wastage!='' ".$internal_wastage."
                                   order by ".$database_name.".issue_departments.created_at asc)";
  return $sql_query;
 } 
}
