<?php 
include_once APPPATH . "modules/issue_and_receipts/models/Ledger_model.php";
class Internal_ledger_model extends Ledger_model{
	protected $table_name= 'processes';
	
	public function __construct($data = array()){
		parent::__construct($data);
	}

  public function get_receipt_records($period='') {
    $period_select="";

    if ($period == 'month') $period_select = 'date_format(created_at,"%Y-%m") as created_date,';
    elseif ($period == 'year') $period_select = 'date_format(created_at,"%Y") as created_date,';
    elseif ($period == 'week') {
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
    $process_fields = ''.$period_select.' product_name, account as issue_type, description,
                       in_weight as weight, in_lot_purity as purity, in_weight * in_lot_purity / 100 as fine, 
                       created_at';

    $liquor_in_details = ''.$period_select.' product_name, account as issue_type, description,
                          liquor_in as weight, in_lot_purity as purity, in_weight * in_lot_purity / 100 as fine, 
                         created_at';

    $alloy_weight_fields = ''.$period_select.' "" as product_name, "" as issue_type, "" as description,
                       sum(alloy_weight) as weight, 0 as purity, 0 as fine, 
                       date(created_at) as created_at';                       

    $alloy_vodator_fields = ''.$period_select.' "" as product_name, "" as issue_type, "" as description,
                       sum(alloy_vodatar) as weight, sum(alloy_vodatar * lot_purity) / sum(alloy_vodatar) as purity, sum(alloy_vodatar * lot_purity / 100) as fine, 
                        date(created_at) as created_at';                       

    $gpc_vodator_fields = ''.$period_select.' "" as product_name, "" as issue_type, "" as description,
                       sum(micro_coating) as weight, sum(micro_coating * out_lot_purity) / sum(micro_coating) as purity, sum(micro_coating * out_lot_purity / 100) as fine, 
                       date(created_at) as created_at';                       

    $stone_vatav_details = ''.$period_select.' product_name, account as issue_type, description,                            sum(stone_vatav - out_stone_vatav) as weight, 
                            sum((stone_vatav - out_stone_vatav) * in_lot_purity) / sum(stone_vatav - out_stone_vatav) as purity, 
                            sum((stone_vatav - out_stone_vatav) * in_lot_purity / 100) as fine, 
                           created_at';

    $copper_vatav_details = ''.$period_select.' product_name, account as issue_type, description ,                           sum(copper_in - copper_out) as weight, 
                            sum((copper_in - copper_out) * in_lot_purity) / sum(copper_in - copper_out) as purity, 
                            sum((copper_in - copper_out) * in_lot_purity / 100) as fine, 
                           created_at';

    $internal_details = ''.$period_select.' product_name, account as issue_type, description,
                          in_weight as weight, in_lot_purity as purity, in_weight * in_lot_purity / 100 as fine, 
                           created_at';

    if (HOST == 'AR Gold' || HOST == 'ARF')                            
      $where_date = ' and date(created_at) > "2020-11-16" ';
    else 
      $where_date = '';
    $not_accounts='';
    if (HOST == 'AR Gold') $not_accounts = " and karigar not in ('ARF Software', 'ARF Software ".HOSTVERSION."', 'ARC Software', 'Export Internal Software', 'ARC Software ".HOSTVERSION."')";
    elseif (HOST == 'ARF') $not_accounts = " and karigar not in ('AR Gold Software', 'AR Gold Software ".HOSTVERSION."', 'Export Internal Software', 'ARC Software', 'ARC Software ".HOSTVERSION."') ";
    elseif (HOST == 'ARC') $not_accounts = " and karigar not in ('ARF Software', 'ARF Software ".HOSTVERSION."', 'AR Gold Software', 'Export Internal Software', 'AR Gold Software ".HOSTVERSION."') ";
    elseif (HOST == 'Export') $not_accounts = " and karigar not in ('ARF Software', 'ARF Software ".HOSTVERSION."', 'AR Gold Software', 'AR Gold Software ".HOSTVERSION.", 'ARC Software', 'ARC Software ".HOSTVERSION."') ";

    $internal_ledger_query = "(select CONCAT('DD Receipt ', type) as url,".$process_fields." from processes 
                                where product_name = 'Daily Drawer Receipt' and department_name = 'Start' 
                                      ".$where_date."".$not_accounts.")

                               UNION
                                (select 'Metal Receipt' as url,".$process_fields." from processes where 
                                 product_name = 'Receipt' and department_name = 'Start' and parent_id = 0 ".$where_date.")

                               UNION
                                (select 'Rhodium Receipt' as url,".$process_fields." from processes where 
                                 product_name = 'Rhodium Receipt' and department_name = 'Start' and parent_id = 0 ".$where_date.")

                               UNION 
                               (select 'Chain Receipt' as url,".$process_fields." from processes 
                                where product_name = 'Chain Receipt' and department_name = 'Start' and parent_id = 0 ".$where_date.")

                               UNION 
                               (select 'Stone Receipt' as url,".$process_fields." from processes 
                                where product_name = 'Stone Receipt' and department_name = 'Start' and parent_id = 0 ".$where_date.")

                              UNION 
                               (select 'Loss Receipt' as url,".$process_fields." from processes 
                                where product_name = 'Loss Receipt' and parent_id = 0 ".$where_date.")

                               UNION 
                               (select 'Pending Ghiss Receipt' as url,".$process_fields." from processes 
                                where product_name = 'Pending Ghiss Receipt' ".$where_date.")

                               UNION 
                               (select 'Finished Goods Receipt' as url,".$process_fields." from processes 
                                where product_name = 'Finished Goods Receipt' and department_name = 'GPC' ".$where_date.")

                               UNION
                                (select 'Refresh Receipt' as url,".$process_fields." from processes 
                                 where product_name='Refresh' and parent_id = 0
                                       and (   (product_name = 'Refresh' and department_name = 'Start') 
                                            or (product_name = 'Refresh' and department_name = 'Refresh Hold' and description!='Refresh'))
                                       ".$where_date.")

                               UNION
                                (select 'Refresh RND Receipt' as url,".$process_fields." from processes 
                                 where process_name = 'RND Receipt' and department_name = 'Start' ".$where_date.")

                               UNION 
                                (select 'Liquor In' as url,".$liquor_in_details." from processes 
                                 where liquor_in != 0 ".$where_date.")

                               UNION
                                (select 'Alloy Weight' as url,".$alloy_weight_fields." from melting_lots where alloy_weight != 0 ".$where_date." group by date(created_at)) 

                               UNION
                                (select 'Alloy Vodator' as url,".$alloy_vodator_fields." from melting_lots where alloy_vodatar != 0 ".$where_date." group by date(created_at)) 

                               UNION
                                (select 'GPC Vodator' as url,".$gpc_vodator_fields." from processes where micro_coating != 0 ".$where_date." group by date(created_at))
                               UNION
                                (select 'Stone Vatav' as url,".$stone_vatav_details." from processes where (stone_vatav != 0 or out_stone_vatav != 0) and (process_name!='Meena Process') ".$where_date." group by date(created_at))
                                UNION
                                (select 'Meena Vatav' as url,".$stone_vatav_details." from processes where (stone_vatav != 0 or out_stone_vatav != 0) and (process_name ='Meena Process') ".$where_date." group by date(created_at))
                               UNION
                               (select 'Copper Vatav' as url,".$copper_vatav_details." from processes where (copper_in != 0 or copper_out != 0) ".$where_date." group by date(created_at))
                               UNION
                                (select 'Internal Receipt' as url,".$internal_details." from processes where process_name = 'Internal Final Process' and department_name = 'Final' ".$where_date.")";
    
    // if (HOST=='AR Gold')
    //   $internal_ledger_query .= " UNION
    //                             (select 'Opening' as url, '2021-02-02' as created_date, 'Opening' as product_name, '' as issue_type, '' as description, 78.404 as weight, 100 as purity, 78.404 as fine, '2021-02-02 00:00:01' as created_at) ";
    // else if (HOST=='ARF') 
    //   $internal_ledger_query .= " UNION
    //                             (select 'Opening' as url, '2021-02-02' as created_date, 'Opening' as product_name, '' as issue_type, '' as description, 80.470 as weight, 100 as purity, 80.470 as fine, '2021-02-02 00:00:01' as created_at) ";
    // else if (HOST=='ARC') 
    //   $internal_ledger_query .= " UNION
    //                             (select 'Opening' as url, '2021-02-02' as created_date, 'Opening' as product_name, '' as issue_type, '' as description, -7.143 as weight, 100 as purity, -7.143  as fine, '2021-02-02 00:00:01' as created_at) ";                                
                                                                    
        
    $internal_ledger_query .= " order by created_at asc;";
    $query = $this->db->query($internal_ledger_query);                               
    $receipts = $query->result_array();
    
    return $receipts;
  }

  public function get_issue_records($period='') {
    $period_select="";
    if ($period == 'month') $period_select = 'date_format(created_at,"%Y-%m") as created_date,';
    elseif ($period == 'year') $period_select = 'date_format(created_at,"%Y") as created_date,';
    elseif ($period == 'week') {
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

    $process_fields = ''.$period_select.' product_name, account as issue_type, description,
                       in_weight as weight, in_lot_purity as purity, in_weight * in_lot_purity / 100 as fine, created_at';

    $issue_department_fields = ''.$period_select.' product_name, issue_type, description, 
                                in_weight as weight, in_purity as purity, in_weight * in_purity / 100 as fine, created_at';

    $tounch_loss_fine_fields = ''.$period_select.' product_name, issue_type, description, 
                                0 as weight, in_purity as purity, in_fine as fine, created_at';

    $issue_tounch_loss_fine_fields = ''.$period_select.' "TLF" as product_name, "" as issue_type, "" as description, 
                                0 as weight, 100 as purity, sum(tounch_loss_fine) as fine, date(created_at) as created_at';

    $liquor_out_details = ''.$period_select.' product_name, account as issue_type, description,
                           liquor_out as weight, in_lot_purity as purity, in_weight * in_lot_purity / 100 as fine, 
                           created_at';                   
                     
    $loss_out_issue_details = ''.$period_select.' product_name, account as issue_type, description,
                           in_weight as weight, in_purity / 100 * in_lot_purity as purity, in_weight * in_purity / 100 * in_lot_purity / 100 as fine, 
                           created_at';                   
    $daily_drawer_issue_details = ''.$period_select.' product_name, karigar as issue_type, description,
                           in_weight as weight, in_lot_purity as purity, in_weight * in_lot_purity / 100 as fine, 
                           created_at';                   
    $chain_issue_details = ''.$period_select.' product_name, account as issue_type, description,
                           in_weight as weight, in_lot_purity as purity, in_weight * in_lot_purity / 100 as fine, 
                           created_at';                   

    $query = $this->db->query("(select CONCAT('DD Issue ', type) as url,".$process_fields." from processes 
                                where process_name = 'Daily Drawer Issue' and department_name = 'Start')

                               UNION
                                (select 'Issue Department' as url,".$issue_department_fields."  from issue_departments where product_name != 'Tounch Loss Fine' and product_name != 'GPC Repair Out'and product_name != 'Hallmark Out') 
                                
                               UNION
                                (select 'Tounch Loss Fine' as url,".$issue_tounch_loss_fine_fields."  from processes where tounch_loss_fine != 0
                                        and parent_lot_id = 0
                                        and product_name != 'Melting Wastage Refine Out' 
                                        and date(created_at) > '2022-02-01' 
                                  group by date(created_at))

                               UNION
                                (select 'Issue Department' as url,".$tounch_loss_fine_fields."  from issue_departments where product_name = 'Tounch Loss Fine') 
                                 
                               UNION
                                (select 'Refresh RND Issue' as url,".$process_fields." from processes 
                                 where process_name = 'RND Issue' and department_name = 'Start')

                               UNION 
                                (select 'Liquor Out' as url,".$liquor_out_details." from processes 
                                 where liquor_out != 0)   
                               UNION 
                                (select 'Loss Out Issue' as url,".$loss_out_issue_details." from processes 
                                 where product_name = 'Loss Out' and process_name = 'Melting' and department_name = 'Loss Transfer')   
                               UNION 
                                (select 'Daily Drawer Issue' as url,".$daily_drawer_issue_details." from processes 
                                 where product_name = 'Issue' and process_name = 'Daily Drawer Issue' and department_name = 'Start' 
                                       and karigar in ('ARF Software','Export Internal Software', 'ARF Software ".HOSTVERSION."',
                                                       'ARC Software', 'ARC Software ".HOSTVERSION."',
                                                       'AR Gold Software', 'AR Gold Software ".HOSTVERSION."'))     
                               UNION 
                                (select 'Chain Issue' as url,".$chain_issue_details." from processes 
                                 where product_name = 'Issue' and process_name = 'Chain Issue' and department_name = 'Start')  

                               order by created_at asc;");
    $issues = $query->result_array();
    return $issues;
  }
}
