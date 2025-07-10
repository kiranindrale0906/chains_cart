<?php defined("BASEPATH") OR exit("No direct script access allowed.");
function getTableSettings($data = array(), $where = array()) {
  return  array(
    'page_title'          => 'Karigar Wise List',
    'primary_table'       => 'processes',
    'default_column'      => 'processes.id',
    'table'               => array('processes'),
    'join_conditions'     => array(),
    'join_type'           =>'',
    'where'               => array('department_name'=>$_GET['department_name'],'balance >'=>0),
    'where_ids'           => '',
    'order_by'            => '',
    'group_by'            => 'karigar,department_name',
    'limit'               => "50",
    'filter'              => ' ',
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'chain_making_karigar_wise_list',
    'add_title'           => '',
    'export_title'        => '',
    'import_title'        => '',
    'select_column'       => true,                // Can user select columns on the table
    'arrange_column'      => true,                // Can user arrange columns on the table  
    'clear_filter'        => true,  
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
    
    return array(
            array("Action", "action", FALSE, "action", FALSE, FALSE),
            array("Karigar", "karigar", TRUE, "karigar", TRUE, TRUE),

  
            array("Department name", "department_name", TRUE, "department_name", TRUE, TRUE),

            array("Balance ", "balance", TRUE, "balance", TRUE, TRUE,'SUM(balance) as balance','','','range','balance',true,'chain'),

            array("Balance Gross", "balance_gross", TRUE, "balance_gross", TRUE, TRUE,'SUM(balance_gross) as balance_gross','','','range','balance_gross',true,'chain'),

            array("Balance Fine", "balance_fine", TRUE, "balance_fine", TRUE, TRUE,'SUM(balance_fine) as balance_fine','','','range','balance_fine',true,'chain'),

          );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'stock_summary_reports/stock_report_department_wise_balance/index?'.http_build_query(array('like[department_name]'=>$_GET['department_name'],"like[karigar]"=>$row['karigar'],'is_highlight'=>'balance'));
  $actions["View"] = array('request' => "http", 
                                  'url' => ADMIN_PATH.$controller,
                                  'confirm_message' => "",
                                  'target' => "_blank",
                                  'class' => 'btn_green'); 

  return $actions;
}