<?php 
class Ledger_model extends BaseModel{
  protected $table_name= 'processes';
  
  public function __construct($data = array()){
    parent::__construct($data);
  }

  public function validation_rules($klass='', $index=0){
    $validation_rules='';
    return $validation_rules; 
  }

  // public function get_total_balance_from_ledger($type='ARC'){
  //   $issue_department_fields = 'in_weight * in_purity / 100 as fine, 
  //                               date(created_at) as created_at';

  //   $process_fields = 'in_weight * in_lot_purity / 100 as fine, 
  //                      date(created_at) as created_at';

  //   $query = $this->db->query("(select 'Issue Department' as url,".$issue_department_fields."  from issue_departments 
  //                               where account_id = '".$type."' and created_at <= '2020-07-28') 
                                
  //                              UNION
                              
  //                              (select 'Refresh RND Issue' as url,".$process_fields." from processes 
  //                               where process_name = 'RND Issue' and department_name = 'Start' and account = '".$type."' and created_at <= '2020-07-28')

  //                              order by created_at asc;");

  //   $issues = $query->result_array();

  //   $query = $this->db->query("(select CONCAT('DD Receipt ', type) as url,".$process_fields." from processes 
  //                               where product_name = 'Daily Drawer Receipt' and department_name = 'Start' and account = '".$type."' and created_at <= '2020-07-28')

  //                              UNION
  //                               (select 'Metal Receipt' as url,".$process_fields." from processes where 
  //                                product_name = 'Receipt' and department_name = 'Start' and account = '".$type."' and created_at <= '2020-07-28')

  //                              UNION 
  //                              (select 'Chain Receipt' as url,".$process_fields." from processes 
  //                               where product_name = 'Chain Receipt' and department_name = 'Start' and account = '".$type."' and created_at <= '2020-07-28')

  //                              UNION
  //                               (select 'Refresh Receipt' as url,".$process_fields." from processes 
  //                                where product_name = 'Refresh' and department_name = 'Start' and account = '".$type."' and created_at <= '2020-07-28')

  //                              UNION
  //                               (select 'Refresh RND Receipt' as url,".$process_fields." from processes 
  //                                where process_name = 'RND Receipt' and department_name = 'Start' and account = '".$type."' and created_at <= '2020-07-28')
                               
  //                              order by created_at asc;");

  //  	$receipts = $query->result_array();
		// $sum_receipts= 0;
		// foreach ($receipts as $receipt) 
		//   $sum_receipts += $receipt['fine'];
		

		// $sum_issues = 0;
		// foreach ($issues as $issue)
	 //    $sum_issues += $issue['fine'];

		// return $sum_issues-$sum_receipts;
  // }

}