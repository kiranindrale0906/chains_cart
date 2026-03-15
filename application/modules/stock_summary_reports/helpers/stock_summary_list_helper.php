<?php defined("BASEPATH") OR exit("No direct script access allowed.");
function getTableSettings($data=array(),$where=array()) {
return array(
"page_title"          => "Stock Summary List",
"primary_table"       => "processes",
"default_column"      => "id",
"table"               => "processes",
"join_columns"        => "",
"join_type"           => "",
"where"               => $where,
"where_ids"           => "",
"order_by"            => "id desc",
"limit"               => "20",
"extra_select_column" => "id",
"actionFunction"      => "",
"headingFunction"     => "list_settings",
"search_url"          => "receipt_department_list",
"add_title"           => "",
"export_title"        => "",
'select_column'       => true,                // Can user select columns on the table
'arrange_column'      => true,                // Can user arrange columns on the table  
'clear_filter'        => true,                // To be removed 
"edit"                => "",
);
}



/*
0 => column title
1 => column name
2 => order flag
3 => order column
4 => filter flag
5 => expand text flag
6 => select column
*/

function list_settings() {//pd($_POST['fields']);
  $field_type = $_GET['is_highlight'];
  $type = isset($_POST['fields']['type']) ? $_POST['fields']['type'] : '';
  $db_field = isset($_POST['fields']['db_fields']) ? $_POST['fields']['db_fields'] : '';
  $list_array = array(
    array("Parent Lot Name", "parent_lot_name", TRUE, "parent_lot_name", TRUE, TRUE),
    array("Lot no", "lot_no", TRUE, "lot_no", TRUE, TRUE),
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Process Name", "process_name", TRUE, "process_name", TRUE, TRUE),
    array("Department name", "department_name", TRUE, "department_name", TRUE, TRUE),
    array("IN", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','','range','',true),
    array("In Purity", "in_purity", TRUE, "in_purity", TRUE, TRUE,'ROUND(in_purity,4) as in_purity'),
    array("In Lot Purity", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'ROUND(in_lot_purity,4) as in_lot_purity','','','','in_lot_purityrange'),
  );
  if($type=='chain') {
    array_push($list_array, 
      array("Balance", "balance", TRUE, "balance", FALSE, TRUE,'balance','','','range','balance',true),
      array("Balance Gross", "balance_gross", TRUE, "balance_gross", FALSE, TRUE,'balance_gross','','','range','balance_gross',true),
      array("Balance Fine", "balance_fine", TRUE, "balance_fine", FALSE, TRUE,'balance_fine','','','range','balance_fine',true)
    );
  }
  elseif($type=='wastage') {
    $balance_gross_calc = 'ROUND(('.$db_field.'*wastage_purity)/100,4)';
    $balance_fine_calc = 'ROUND(('.$db_field.'*wastage_purity/100 *wastage_lot_purity/100),4)';
    array_push($list_array, 
      array("Balance", $db_field, TRUE, $db_field, FALSE, TRUE,$db_field,'','','range','',true),
      array("Balance Gross", $db_field."_gross", TRUE, $db_field."_gross", FALSE, TRUE,$balance_gross_calc.' as '.$db_field.'_gross','','','range','',true),
      array("Balance Fine", $db_field."_fine", TRUE, $db_field."_fine", FALSE, TRUE,$balance_fine_calc.' as '.$db_field.'_fine','','','range','',true)
    );
  }
  /*elseif($field_type=='copper') {
    array_push($list_array, 
      array("Copper Balance ", "copper_out", TRUE, "copper_out", TRUE, TRUE,'copper_out','','','range','copper_out',true),
      array("Copper Gross", "copper_gross", TRUE, "copper_gross", TRUE, TRUE,'copper_out as copper_gross','','','range','',true),
      array("Copper Fine", "copper_out_fine", TRUE, "copper_out_fine", TRUE, TRUE,'ROUND((copper_out*in_lot_purity)/100,4) as copper_out_fine','','','range','',true)
    );
  }
  elseif($field_type=='copper_ghiss'||$field_type=='balance_daily_drawer_wastage'||$field_type=='balance_loss'
          ||$field_type=='balance_ghiss'||$field_type=='balance_hcl_ghiss') {
    array_push($list_array, 
      array("Balance ", $field_type, TRUE, $field_type, TRUE, TRUE,$field_type,'','','range',$field_type,true),
      array("Gross", $field_type."_gross", TRUE, $field_type."_gross", TRUE, TRUE,'ROUND(('.$field_type.'*wastage_purity)/100,4) as '.$field_type.'_gross','','','range','',true),
      array("Fine", $field_type."_fine", TRUE, $field_type."_fine", TRUE, TRUE,'ROUND(('.$field_type.' * wastage_purity / 100 * wastage_lot_purity / 100),4) as '.$field_type.'_fine','','','range','',true)
    );
  }
  elseif($field_type=='hcl_wastage') {
    array_push($list_array, 
      array("In Hcl wastage", "hcl_wastage", TRUE, "hcl_wastage", TRUE, TRUE,'hcl_wastage','','','range','',true),
      array("Balance Hcl wastage", "balance_hcl_wastage", TRUE, "balance_hcl_wastage", TRUE, TRUE,'balance_hcl_wastage','','','range','',true),
      array("Balance gross Hcl wastage", "balance_gross_hcl_wastage", TRUE, "balance_gross_hcl_wastage", TRUE, TRUE,'ROUND(((balance_hcl_wastage * out_purity) / 100),4) as balance_gross_hcl_wastage','','','range','',true),
      array("Balance Fine Hcl wastage", "balance_fine_hcl_wastage", TRUE, "balance_fine_hcl_wastage", TRUE, TRUE,'ROUND((balance_hcl_wastage * out_purity / 100 * out_lot_purity / 100),4) as balance_fine_hcl_wastage','','','range','',true)
    );
  }
  elseif($field_type=='balance_loss') {
    array_push($list_array, 
      array("Balance", $field_type, TRUE, $field_type, TRUE, TRUE,$field_type,'','','range','',true),
      array("Gross", $field_type."_gross", TRUE, $field_type."_gross", TRUE, TRUE,'ROUND((('.$field_type.' * out_purity) / 100),4) as '.$field_type.'_gross','','','range','',true),
      array("Fine", $field_type."_fine", TRUE, $field_type."_fine", TRUE, TRUE,'ROUND(('.$field_type.' * out_purity / 100 * out_lot_purity / 100),4) as '.$field_type.'_fine','','','range','',true)
    );
  }
  elseif($field_type=='hcl_loss') {
    array_push($list_array, 
      array("HCL Loss", "hcl_loss", TRUE, "hcl_loss", TRUE, TRUE,'ROUND(hcl_loss,4) as hcl_loss','','','range','hcl_loss',true),
      array("Balance HCL Loss", "balance_hcl_loss", TRUE, "balance_hcl_loss", TRUE, TRUE,'ROUND(balance_hcl_loss,4) as balance_hcl_loss','','','range','balance_hcl_loss',true),
      array("HCL Loss Fine", "hcl_loss_fine", TRUE, "hcl_loss_fine", TRUE, TRUE,'ROUND((hcl_loss * in_lot_purity / 100),4) as hcl_loss_fine','','','range','hcl_loss_fine',true)
    );
  }
  elseif($field_type=='stock_finished_goods_receipt'||$field_type=='balance_gpc_out') {
    array_push($list_array, 
      array("Balance GPC Out", "balance_gpc_out", TRUE, "balance_gpc_out", TRUE, TRUE,'balance_gpc_out','','','range','balance_gpc_out',true),
      array("Gross GPC Out", "gross_gpc_out", TRUE, "gross_gpc_out", TRUE, TRUE,'ROUND((balance_gpc_out*in_purity/100),4) as gross_gpc_out','','','range','',true),
      array("Fine GPC Out", "fine_gpc_out", TRUE, "fine_gpc_out", TRUE, TRUE,'ROUND((balance_gpc_out * in_purity/100 * in_lot_purity / 100),4) as fine_gpc_out','','','range','',true)
    );
  }
  elseif($field_type=='fire_tounch_in') {
    array_push($list_array, 
      array("Balance", "balance", TRUE, "balance", TRUE, TRUE,'(fire_tounch_in - fire_tounch_out - fire_tounch_gross) as balance','','','range','',true),
      array("Gross", "gross", TRUE, "gross", TRUE, TRUE,'(fire_tounch_in - fire_tounch_out - fire_tounch_gross) as gross','','','range','',true),
      array("Fine", "fine", TRUE, "fine", TRUE, TRUE,'ROUND((fire_tounch_in - fire_tounch_out - fire_tounch_gross)*wastage_lot_purity/100,4) as fine','','','range','',true)
    );
  }
  elseif($field_type=='total_gpc_powder') {
    array_push($list_array, 
      array("Balance", "balance", TRUE, "balance", TRUE, TRUE,'(daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight)) as balance','','','range','',true),
      array("Gross", "gross", TRUE, "gross", TRUE, TRUE,'(daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight)) as gross','','','range','',true),
      array("Fine", "fine", TRUE, "fine", TRUE, TRUE,'ROUND((daily_drawer_in_weight - (hook_in - hook_out + daily_drawer_out_weight))*hook_kdm_purity/100,4) as fine','','','range','',true)
    );
  }
  elseif($field_type=='balance_melting_wastage') {
    array_push($list_array, 
      array("Balance", $field_type, TRUE, $field_type, TRUE, TRUE,$field_type,'','','range','',true),
      array("Gross", $field_type."_gross", TRUE, $field_type."_gross", TRUE, TRUE,$field_type.' as '.$field_type.'_gross','','','range','',true),
      array("Fine", $field_type."_fine", TRUE, "$field_type._fine", TRUE, TRUE,'ROUND(('.$field_type.')*out_lot_purity/100,4) as '.$field_type.'_fine','','','range','',true)
    );
  }*/
  return $list_array;
}

/*function list_settings() {
return array(
        array("Parent Lot Name", "parent_lot_name", TRUE, "parent_lot_name", TRUE, TRUE),
        array("Lot no", "lot_no", TRUE, "lot_no", TRUE, TRUE),
        // array("Melting No", "melting_lot_id", TRUE, "melting_lot_id", FALSE, TRUE),
        array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
        array("Process Name", "process_name", TRUE, "process_name", TRUE, TRUE),
        array("Karigar", "karigar", TRUE, "karigar", TRUE, TRUE),
        array("Lot Purity", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'ROUND(in_lot_purity,4) as in_lot_purity','','','','in_lot_purityrange'),
        array("Department name", "department_name", TRUE, "department_name", TRUE, TRUE),
        array("In Purity", "in_purity", TRUE, "in_purity", TRUE, TRUE,'ROUND(in_purity,4) as in_purity'),
        array("Out Purity", "out_purity", TRUE, "out_purity", TRUE, TRUE,'ROUND(out_purity,4) as out_purity'),
        array("Out Lot Purity", "out_lot_purity", TRUE, "out_lot_purity", TRUE, TRUE,'ROUND(out_lot_purity,4) as out_lot_purity'),
        array("Hook Kdm Purity", "hook_kdm_purity", TRUE, "hook_kdm_purity", TRUE, TRUE,'ROUND(hook_kdm_purity,4) as hook_kdm_purity'),
        array("Quantity", "quantity", TRUE, "quantity", TRUE, TRUE,'quantity'),

        array("In Melting Wastage", "melting_wastage", TRUE, "melting_wastage", TRUE, TRUE,'(melting_wastage + in_melting_wastage) as melting_wastage','','','range','melting_wastage',true,'metal_summary'),

        array("Out Melting Wastage", "out_melting_wastage", TRUE, "out_melting_wastage", TRUE, TRUE,'(out_melting_wastage+issue_melting_wastage) as out_melting_wastage','','','range','out_melting_wastage',true,'metal_summary'),

        array("Balance Melting Wastage", "balance_melting_wastage", TRUE, "balance_melting_wastage", TRUE, TRUE,'balance_melting_wastage','','','range','balance_melting_wastage',true,'metal_summary'),

        array("Balance Melting Wastage Fine", "balance_melting_fine", TRUE, "having%balance_melting_fine", TRUE, TRUE,'ROUND((balance_melting_wastage * out_lot_purity / 100),4) as balance_melting_fine','','','range','balance_melting_fine',true,'metal_summary'),
        array("Daily Drawer In", "daily_drawer_in_weight", TRUE, "daily_drawer_in_weight", TRUE, TRUE,'daily_drawer_in_weight','','','range','daily_drawer_in_weight',true,'daily_drawer_in_weight')
        ,array("Daily Drawer Out", "daily_drawer_out_weight", TRUE, "daily_drawer_out_weight", TRUE, TRUE,'daily_drawer_out_weight','','','range','daily_drawer_out_weight',true,'daily_drawer_wastage'),
        array("In Daily Drawer wastage", "daily_drawer_wastage", TRUE, "daily_drawer_wastage", TRUE, 
            TRUE,'daily_drawer_wastage','','','range','',true,'daily_drawer_wastage'),
        array("Out Daily Drawer wastage", "out_daily_drawer_wastage", TRUE, "out_daily_drawer_wastage", TRUE, 
            TRUE,'(out_daily_drawer_wastage) as out_daily_drawer_wastage','','','range','',true,'daily_drawer_wastage'),
        array("Issue Daily Drawer Wastage", "issue_daily_drawer_wastage", TRUE, "issue_daily_drawer_wastage", TRUE, TRUE,'issue_daily_drawer_wastage','','','range','',true,'issue_daily_drawer_wastage'),

        array("Issue Daily Drawer Wastage Fine", "issue_daily_drawer_wastage_fine", TRUE, "having%issue_daily_drawer_wastage_fine", TRUE, TRUE,'ROUND((issue_daily_drawer_wastage* out_lot_purity / 100),4) as issue_daily_drawer_wastage_fine','','','range','',true,'issue_daily_drawer_wastage'),


        array("Balance Daily Drawer wastage", "balance_daily_drawer_wastage", TRUE, 
            "balance_daily_drawer_wastage", TRUE, TRUE,'balance_daily_drawer_wastage','','','range','',true,'daily_drawer_wastage'),

        array("Daily Drawer wastage Gross", "daily_drawer_wastage_gross", TRUE, "having%daily_drawer_wastage_gross", TRUE, TRUE,'ROUND((daily_drawer_wastage* out_purity / 100),4) as daily_drawer_wastage_gross','','','range','',true,'daily_drawer_wastage','daily_drawer_wastage'),

        array("Daily Drawer wastage Fine", "daily_drawer_wastage_fine", TRUE, "having%daily_drawer_wastage_fine", TRUE, TRUE,'ROUND((daily_drawer_wastage* out_purity / 100 * out_lot_purity / 100),4) as daily_drawer_wastage_fine','','','range','',true,'daily_drawer_wastage'),
       
        array("Alloy Weight", "alloy_weight", TRUE, "having%alloy_weight", TRUE, TRUE,'alloy_weight','','','range','alloy_weight',true,'alloy_receipt'),

        array("Out Alloy Weight", "out_alloy_weight", TRUE, "having%out_alloy_weight", TRUE, TRUE,'out_alloy_weight','','','range','out_alloy_weight',true,'alloy_receipt'),
    

        array("IN", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','','range','',true,'chain'),

        array("OUT", "out_weight", TRUE, "out_weight", TRUE, TRUE,'out_weight','','','range','',true,'chain'),

        
        array("OUT Gross", "out_weight_gross", TRUE, "having%out_weight_gross", TRUE, TRUE,'ROUND((out_weight * out_purity / 100),4) as out_weight_gross','','','range','out_weight_gross',true,'chain'),
        
        array("OUT Fine", "out_weight_fine", TRUE, "having%out_weight_fine", TRUE, TRUE,'ROUND((out_weight * out_purity / 100 * out_lot_purity / 100),4) as out_weight_fine','','','range','out_weight_fine',true,'chain'),

        array("Issue GPC Out", "issue_gpc_out", TRUE, "issue_gpc_out", TRUE, TRUE,'issue_gpc_out','','','range','issue_gpc_out',true,'issue_gpc_out'),
        
        array("GPC Out", "gpc_out", TRUE, "gpc_out", TRUE, TRUE,'ROUND(gpc_out,4) as gpc_out','','','range','gpc_out',true,'gpc_out'),
        array("Out GPC Out", "out_gpc_out", TRUE, "out_gpc_out", TRUE, TRUE,'issue_gpc_out as out_gpc_out','','','range','out_gpc_out',true,'gpc_out'),
        
        array("Issue GPC Out Fine ", "issue_gpc_out_fine", TRUE, "having%issue_gpc_out_fine", TRUE, TRUE,'(issue_gpc_out * out_lot_purity / 100) as issue_gpc_out_fine','','','range','issue_gpc_out_fine',true,'issue_gpc_out'),

        array("Balance GPC Out", "balance_gpc_out", TRUE, "balance_gpc_out", TRUE, TRUE,'balance_gpc_out','','','range','balance_gpc_out',true,'gpc_out'),

        array("Balance GPC Out Gross", "balance_gpc_out_gross", TRUE, "balance_gpc_out_gross", TRUE, TRUE,'((balance_gpc_out) * in_purity / 100) as balance_gpc_out_gross,','','','range','balance_gpc_out_gross',true,'gpc_out'),

        array("Balance GPC Out Fine", "balance_gpc_out_fine", TRUE, "balance_gpc_out_fine", TRUE, TRUE,'((balance_gpc_out) * in_purity / 100  * in_lot_purity / 100) as balance_gpc_out_fine,','','','range','balance_gpc_out_fine',true,'gpc_out'),


        array("Balance ", "balance", TRUE, "balance", TRUE, TRUE,'balance','','','range','balance',true,'chain'),

        array("Balance Gross", "balance_gross", TRUE, "balance_gross", TRUE, TRUE,'balance_gross','','','range','balance_gross',true,'chain'),

        array("Balance Fine", "balance_fine", TRUE, "balance_fine", TRUE, TRUE,'balance_fine','','','range','balance_fine',true,'chain'),


        array("FE In", "fe_in", TRUE, "fe_in", TRUE, TRUE,'fe_in','','','range','fe_in',true,'fe'),

        array("FE Out", "fe_out", TRUE, "fe_out", TRUE, TRUE,'fe_out','','','range','fe_out',true,'fe'),
        
        array("FE Balance", "fe_balance", TRUE, "having%fe_balance", TRUE, TRUE,'ROUND((fe_out+wastage_fe),4) as fe_balance','','','range','fe_balance',true,'fe'),

        array("Wastage FE", "wastage_fe", TRUE, "wastage_fe", TRUE, TRUE,'wastage_fe','','','range','',true,'fe'),

      

        array("Ghiss", "ghiss", TRUE, "ghiss", TRUE, TRUE,'ghiss','','','range','',true,'ghiss'),

        array("Out Ghiss", "out_ghiss", TRUE, "out_ghiss", TRUE, TRUE,'out_ghiss','','','range','',true,'ghiss'),

         array("Issue Ghiss", "issue_ghiss", TRUE, "issue_ghiss", TRUE, TRUE,'issue_ghiss','','','range','',true,'issue_ghiss'),
        array("Issue Ghiss Fine", "issue_ghiss_fine", TRUE, "issue_ghiss_fine", TRUE, TRUE,'(issue_ghiss *out_lot_purity/100) as issue_ghiss_fine','','','range','',true,'issue_ghiss'),

        array("Balance Ghiss", "balance_ghiss", TRUE, "balance_ghiss", TRUE, TRUE,'balance_ghiss','','','range','',true,'ghiss'),
        array("Ghiss Gross", "ghiss_gross", TRUE, "having%ghiss_gross", TRUE, TRUE,'ROUND((balance_ghiss*out_purity/100),4) as ghiss_gross','','','range','ghiss_gross',true,'ghiss'),

        array("Ghiss Fine", "ghiss_fine", TRUE, "having%ghiss_fine", TRUE, TRUE,'ROUND(((balance_ghiss * out_purity / 100 )* out_lot_purity / 100),4) as ghiss_fine','','','range','ghiss_fine',true,'ghiss'),

        array("Tounch Ghiss", "tounch_ghiss", TRUE, "tounch_ghiss", TRUE, TRUE,'tounch_ghiss','','','range','',true,'ghiss'),
         array("Rope Ghiss", "hcl_ghiss", TRUE, "hcl_ghiss", TRUE, TRUE,'hcl_ghiss','','','range','',true,'hcl_ghiss'),

        array("Out Rope Ghiss", "out_hcl_ghiss", TRUE, "out_hcl_ghiss", TRUE, TRUE,'out_hcl_ghiss','','','range','',true,'hcl_ghiss'),

        array("Balance Rope Ghiss", "balance_hcl_ghiss", TRUE, "balance_hcl_ghiss", TRUE, TRUE,'balance_hcl_ghiss','','','range','',true,'hcl_ghiss'),

        array("Balance Gross Rope Ghiss", "balance_gross_hcl_ghiss", TRUE, "balance_gross_hcl_ghiss", TRUE, TRUE,'ROUND((hcl_ghiss * out_purity / 100 ),4) as balance_gross_hcl_ghiss','','','range','',true,'hcl_ghiss'),

        array("Balance Fine Rope Ghiss", "balance_fine_hcl_ghiss", TRUE, "balance_fine_hcl_ghiss", TRUE, TRUE,'ROUND((hcl_ghiss * out_purity / 100 * out_lot_purity / 100),4) as balance_fine_hcl_ghiss','','','range','',true,'hcl_ghiss'),

        array("Pending Ghiss", "pending_ghiss", TRUE, "pending_ghiss", TRUE, TRUE,' pending_ghiss','','','range','pending_ghiss',true,'pending_ghiss'),
        array("Out Pending Ghiss", "out_pending_ghiss", TRUE, "out_pending_ghiss", TRUE, TRUE,' out_pending_ghiss','','','range','out_pending_ghiss',true,'pending_ghiss'),

        array("Balance Pending Ghiss", "balance_pending_ghiss", TRUE, "balance_pending_ghiss", TRUE, TRUE,' balance_pending_ghiss','','','range','balance_pending_ghiss',true,'pending_ghiss'),

        array("Tounch Purity", "tounch_purity", TRUE, "tounch_purity", TRUE, TRUE,'','','range','tounch_purity'),

        array("Tounch No", "tounch_no", TRUE, "tounch_no", TRUE, TRUE,'ROUND(tounch_no,0) as tounch_no','','','range','tounch'),

        array("Tounch", "tounch", TRUE, "having%tounch", TRUE, TRUE,'ROUND(tounch_in- tounch_ghiss-tounch_out,4) as tounch','','','range','tounch',true,'tounch'),

        array("Tounch Gross", "tounch_gross", TRUE, "having%tounch_gross", TRUE, TRUE,'ROUND(tounch_in - tounch_out,4) as tounch_gross','','','range','tounch_gross',true,'tounch'),

        array("Tounch Fine", "tounch_fine", TRUE, "having%tounch_fine", TRUE, TRUE,'ROUND((tounch_in * out_lot_purity / 100) - (tounch_out * tounch_purity / 100) - tounch_loss_fine,4) as tounch_fine','','','range','tounch_fine',true,'tounch'),

        array("Tounch Fine Loss", "tounch_loss_fine", TRUE, "tounch_loss_fine", TRUE, TRUE,'tounch_loss_fine','','','range','tounch_loss_fine',true,'tounch_loss_fine'),

        array("Balance Tounch Fine Loss", "balance_tounch_loss_fine", TRUE, "balance_tounch_loss_fine", TRUE, TRUE,'balance_tounch_loss_fine','','','range','balance_tounch_loss_fine',true,'tounch_loss_fine'),

        array("Issue Tounch Loss Fine", "issue_tounch_loss_fine", TRUE, "issue_tounch_loss_fine", TRUE, TRUE,' issue_tounch_loss_fine','','','range','issue_tounch_loss_fine',true,'tounch_loss_fine'),


        array("Out Tounch Ghiss", "out_tounch_ghiss", TRUE, "out_tounch_ghiss", TRUE, TRUE,'out_tounch_ghiss','','','range','',true,'tounch'),

        array("Balance Tounch Ghiss", "balance_tounch_ghiss", TRUE, "balance_tounch_ghiss", TRUE, TRUE,'balance_tounch_ghiss','','','range','',true,'tounch'),

        array("Tounch Ghiss Gross", "tounch_ghiss_gross", TRUE, "having%tounch_ghiss_gross", TRUE, TRUE,'ROUND((tounch_ghiss*out_purity/100),4) as tounch_ghiss_gross','','','range','tounch_ghiss_gross',true,'tounch'),

        array("Tounch Ghiss Fine", "tounch_ghiss_fine", TRUE, "having%tounch_ghiss_fine", TRUE, TRUE,'ROUND(((tounch_ghiss * out_purity / 100 )* out_lot_purity / 100),4) as tounch_ghiss_fine','','','range','tounch_ghiss_fine',true,'tounch'),

        array("Tounch In", "tounch_in", TRUE, "tounch_in", TRUE, TRUE,'tounch_in','','','range','',true,'tounch'),

        array("Tounch Out", "tounch_out", TRUE, "tounch_out", TRUE, TRUE,'tounch_out','','','range','',true,'tounch'),
        array("Out Tounch Out", "out_tounch_out", TRUE, "out_tounch_out", TRUE, TRUE,'out_tounch_out','','','range','',true,'tounch'),

        array("Tounch Out Fine", "tounch_out_fine", TRUE, "having%tounch_out_fine", TRUE, TRUE,'ROUND(tounch_out * tounch_purity / 100,4) as tounch_out_fine','','','range','tounch_out_fine',true ,'tounch'),

        array("Balance Tounch Out", "balance_tounch_out", TRUE, "balance_tounch_out", TRUE, TRUE,'balance_tounch_out','','','range','',true,'tounch'),

        array("Fire Tounch In", "fire_tounch_in", TRUE, "fire_tounch_in", TRUE, TRUE,'fire_tounch_in','','','range','',true,'fire_tounch'),

        array("Fire Tounch Out", "fire_tounch_out", TRUE, "fire_tounch_out", TRUE, TRUE,'fire_tounch_out','','','range','',true,'fire_tounch'),

        array("expected Fire Tounch Fine", "fire_tounch_gross", TRUE, "fire_tounch_gross", TRUE, TRUE,'fire_tounch_gross','','','range','',true,'fire_tounch'),

        array("Fire Tounch Fine", "fire_tounch_fine", TRUE, "fire_tounch_fine", TRUE, TRUE,'fire_tounch_fine','','','range','',true,'fire_tounch'),


        array("Micro Coating", "micro_coating", TRUE, "micro_coating", TRUE, TRUE,'micro_coating','','','range','',true,'gpc_vodatar'),

        array("Expected Out", "expected_out_weight", TRUE, "expected_out_weight", TRUE, TRUE,"expected_out_weight",'','','range','',true),

        array("Hook In", "hook_in", TRUE, "hook_in", TRUE, TRUE,'hook_in','','','range','',true),

        array("Hook Out", "hook_out", TRUE, "hook_out", TRUE, TRUE,'hook_out','','','range','',true),

        array("In Hcl wastage", "hcl_wastage", TRUE, "hcl_wastage", TRUE, TRUE,'hcl_wastage','','','range','',true,'hcl_wastage'),

        array("Out Hcl wastage", "out_hcl_wastage", TRUE, "out_hcl_wastage", TRUE, TRUE,'out_hcl_wastage','','','range','',true,'hcl_wastage'),

        array("Balance Hcl wastage", "balance_hcl_wastage", TRUE, "balance_hcl_wastage", TRUE, TRUE,'balance_hcl_wastage','','','range','',true,'hcl_wastage'),

        array("Balance gross Hcl wastage", "balance_gross_hcl_wastage", TRUE, "balance_gross_hcl_wastage", TRUE, TRUE,'ROUND(((balance_hcl_wastage * out_purity) / 100),4) as balance_gross_hcl_wastage','','','range','',true,'hcl_wastage'),

        array("Balance Fine Hcl wastage", "balance_fine_hcl_wastage", TRUE, "balance_fine_hcl_wastage", TRUE, TRUE,'ROUND((balance_hcl_wastage * out_purity / 100 * out_lot_purity / 100),4) as balance_fine_hcl_wastage','','','range','',true,'hcl_wastage'),

 


        array("Next Department Wastage", "next_department_wastage", TRUE, "next_department_wastage", TRUE, TRUE,'next_department_wastage','','','range','',true,'next_department_wastage'),

        array("Issue Melting Wastage", "issue_melting_wastage", TRUE, "issue_melting_wastage", TRUE, TRUE,'issue_melting_wastage','','','range','',true,'issue_melting_wastage'),
        array("Issue Melting Wastage Fine", "issue_melting_wastage_fine", TRUE, "having%issue_melting_wastage_fine", TRUE, TRUE,'ROUND((issue_melting_wastage* out_lot_purity / 100),4) as issue_melting_wastage_fine','','','range','',true,'issue_melting_wastage'),

       array("Loss", "loss", TRUE, "loss", TRUE, TRUE,'loss','','','range','',true,'loss'),

        array("Out Loss", "out_loss", TRUE, "out_loss", TRUE, TRUE,'out_loss','','','range','',true,'out_loss'),

        array("Balance Loss", "balance_loss", TRUE, "balance_loss", TRUE, TRUE,'balance_loss','','','range','',true,'balance_loss'),


        array("Loss Gross", "loss_gross", TRUE, "having%loss_gross", TRUE, TRUE,'ROUND((loss*out_purity/100),4) as loss_gross','','','range','',true,'loss'),

        array("Loss Fine", "loss_fine", TRUE, "having%loss_fine", TRUE, TRUE,'ROUND(loss * out_purity / 100 * out_lot_purity / 100,4) as loss_fine','','','range','',true,'loss'),

        array("Solder In", "solder_in", TRUE, "solder_in", TRUE, TRUE,'solder_in','','','range','',true,'solder'), 
        array("Liquor In", "liquor_in", TRUE, "liquor_in", TRUE, TRUE,'liquor_in','','','range','',true,'liquor'), 
        array("Liquor OUT", "liquor_out", TRUE, "liquor_out", TRUE, TRUE,'liquor_out','','','range','',true,'liquor'), 
        array("Copper In", "copper_in", TRUE, "copper_in", TRUE, TRUE,'copper_in','','','range','',true,'copper'), 

        array("Copper Out", "copper_out", TRUE, "copper_out", TRUE, TRUE,'copper_out','','','range','',true,'copper'),   
        array("Balance Copper", "balance_copper", TRUE, "balance_copper", TRUE, TRUE,'(copper_in-copper_out) as balance_copper','','','range','',true,'copper'),   

        array("HCL Loss", "hcl_loss", TRUE, "hcl_loss", TRUE, TRUE,'ROUND(hcl_loss,4) as hcl_loss','','','range','hcl_loss',true,'hcl_loss'),

        array("Issue HCL Loss", "issue_hcl_loss", TRUE, "issue_hcl_loss", TRUE, TRUE,'ROUND(issue_hcl_loss,4) as issue_hcl_loss','','','range','issue_hcl_loss',true,'issue_hcl_loss'),
        array("Issue HCL Loss Fine", "issue_hcl_loss_fine", TRUE, "issue_hcl_loss_fine", TRUE, TRUE,'ROUND(issue_hcl_loss * in_lot_purity / 100,4) as issue_hcl_loss_fine','','','range','issue_hcl_loss_fine',true,'issue_hcl_loss'),

        array("Balance HCL Loss", "balance_hcl_loss", TRUE, "balance_hcl_loss", TRUE, TRUE,'ROUND(balance_hcl_loss,4) as balance_hcl_loss','','','range','balance_hcl_loss',true,'hcl_loss'),

        array("HCL Loss Fine", "hcl_loss_fine", TRUE, "hcl_loss_fine", TRUE, TRUE,'ROUND((hcl_loss * in_lot_purity / 100),4) as hcl_loss_fine','','','range','hcl_loss_fine',true,'hcl_loss'), 

        
        array("Refine Loss", "refine_loss", TRUE, "refine_loss", TRUE, TRUE,' refine_loss','','','range','refine_loss',true,'refine_loss'),
        
        array("Repair Out", "repair_out", TRUE, "repair_out", TRUE, TRUE,' repair_out','','','range','repair_out',true,'repair_out'),

        array("Repair Out Quantity", "repair_out_quantity", TRUE, "repair_out_quantity", TRUE, TRUE,' repair_out_quantity','','','range','repair_out_quantity',true,''),

        array("Solder Wastage", "solder_wastage", TRUE, "solder_wastage", TRUE, TRUE,' solder_wastage','','','range','solder_wastage',true,''),

        array("Out Solder Wastage", "out_solder_wastage", TRUE, "out_solder_wastage", TRUE, TRUE,' out_solder_wastage','','','range','out_solder_wastage',true,''),

        array("Balance Solder Wastage", "balance_solder_wastage", TRUE, "balance_solder_wastage", TRUE, TRUE,' balance_solder_wastage','','','range','balance_solder_wastage',true,''),

        array("Flash Wire", "flash_wire", TRUE, "flash_wire", TRUE, TRUE,' flash_wire','','','range','flash_wire',true,''), 

        array("Stone Vatav", "stone_vatav", TRUE, "stone_vatav", TRUE, TRUE,' stone_vatav','','','range','stone_vatav',true,''), 
        array("Created at", "created_at", FALSE, "created_at", FALSE, FALSE,'DATE_FORMAT(created_at,"%d-%b-%Y") as created_at',"","","daterange",)
        );
}*/


































