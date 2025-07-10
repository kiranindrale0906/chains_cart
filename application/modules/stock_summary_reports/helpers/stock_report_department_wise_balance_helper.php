<?php defined("BASEPATH") OR exit("No direct script access allowed.");
function getTableSettings($data=array(),$where=array()) {
  $where='balance > 0';

  if (isset($_GET['lot_no']) && !empty($_GET['lot_no']))
    $where.=' and lot_no = "'.$_GET['lot_no'].'"';
  if (isset($_GET['in_lot_purity']) && !empty($_GET['in_lot_purity']))
    $where.=' and in_lot_purity = "'.$_GET['in_lot_purity'].'"';

  if(isset($_GET['department_name']) and $_GET['department_name']=='gpc'){
    $where.=' and department_name in ("GPC","GPC or Rodium","Bunch GPC")';
  }if(isset($_GET['department_name']) and $_GET['department_name']=='buffing_hold'){
    $where.=' and department_name in ("Buffing Hold","Buffing Hold I")';
  }
  if(isset($_GET['department_name']) and $_GET['department_name']=='melting'){
    $where.=' and department_name in ("Melting","PL Melting","AG Melting")';
  }
  if(isset($_GET['department_name']) and $_GET['department_name']=='hand_cutting'){
    $where.=' and department_name in ("Hand Cutting")';
  }if(isset($_GET['department_name']) and $_GET['department_name']=='hand_cutting_ii'){
    $where.=' and department_name in ("Hand Cutting II")';
  }if(isset($_GET['department_name']) and $_GET['department_name']=='filing'){
    $where.=' and department_name in ("Filing")';
  }if(isset($_GET['department_name']) and $_GET['department_name']=='filing_ii'){
    $where.=' and department_name in ("Filing II")';
  }if(isset($_GET['department_name']) and $_GET['department_name']=='hcl'){
    $where.=' and department_name in ("HCL Process","HCL")';
  }

  return array(
    "page_title"          => "Department Wise List",
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
  
function list_settings() {
    $lists = array();
    $list_one =  array(
                  array("Action", "action", FALSE, "action", FALSE, FALSE),
                  array("Lot no", "lot_no", TRUE, "lot_no", TRUE, TRUE),
                  array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
                  array("Process Name", "process_name", TRUE, "process_name", TRUE, TRUE));
    
    $list_two = array(
                  array("Design Code", "design_code", TRUE, "design_code", TRUE, TRUE,'design_code'),
                  array("Karigar", "karigar", TRUE, "karigar", TRUE, TRUE),
                  array("Machine Size", "melting_lot_category_three", TRUE, "melting_lot_category_three", TRUE, TRUE));
    
    $list_three = array(
                    array("Description", "description", TRUE, "description", TRUE, TRUE,'description'),
                    array("Lot Purity", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'ROUND(in_lot_purity,4) as in_lot_purity','','','','in_lot_purityrange'),
                    array("Department name", "department_name", TRUE, "department_name", TRUE, TRUE),
                    array("In Purity", "in_purity", TRUE, "in_purity", TRUE, TRUE,'ROUND(in_purity,4) as in_purity'),
                    array("Out Purity", "out_purity", TRUE, "out_purity", TRUE, TRUE,'ROUND(out_purity,4) as out_purity'),
                    array("IN", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','','range','',true,'chain'),
                    array("OUT", "out_weight", TRUE, "out_weight", TRUE, TRUE,'out_weight','','','range','',true,'chain'),
                    array("Balance ", "balance", TRUE, "balance", TRUE, TRUE,'balance','','','range','balance',true,'chain'),
                    array("Balance Gross", "balance_gross", TRUE, "balance_gross", TRUE, TRUE,'ROUND((balance*in_purity/100),4) as balance_gross','','','range','balance_gross',true,'chain'),
                    array("Balance Fine", "balance_fine", TRUE, "balance_fine", TRUE, TRUE,'ROUND((balance*in_lot_purity/100),4) as balance_fine','','','range','balance_fine',true,'chain'),
                    array("Is Outside", "is_outside", TRUE, "is_outside", TRUE, TRUE,'is_outside'));
    
    if(HOST=='AR Gold' || HOST=='ARF') {
      $lists = array_merge($list_one,$list_two,$list_three);
    } elseif(HOST=='ARC') {
      $lists = array_merge($list_one,$list_three);
    }
    return $lists;
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'bar_codes/bar_codes/view/1?barcode_value='.$row['id'];
  $actions["Edit"] = array('request' => "http", 
                                  'url' => ADMIN_PATH.$controller,
                                  'confirm_message' => "",
                                  'target' => "_blank",
                                  'class' => 'btn_green'); 

  return $actions;
}


 





























