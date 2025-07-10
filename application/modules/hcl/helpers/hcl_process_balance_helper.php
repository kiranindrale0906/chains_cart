<?php 
 function getTableSettings() {
  return array(
    'page_title'          => 'HCL Process Balance List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => 'product_name = "HCL" AND balance > 0',
    'where_ids'           => '',
    'order_by'            => '',
    'group_by'            => 'lot_no,product_name,process_name,balance,in_weight,out_weight',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'hcl_process_balance',
    'add_title'           => '',
    'export_title'        => '',
    'edit'                => '',
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
    array("Lot No", 'lot_no', TRUE, 'lot_no', TRUE, TRUE,'lot_no as lot_no'),
    array("Product Name", 'product_name', TRUE, 'product_name', TRUE, TRUE,'product_name as product_name'),
    array("Process Name", 'process_name', TRUE, 'process_name', TRUE, TRUE,'process_name as process_name'),
    array("IN", 'in_weight', TRUE, 'in_weight', TRUE, TRUE,'in_weight as in_weight','','','','',true),
    array("OUT", 'out_weight', TRUE, 'out_weight', TRUE, TRUE,'out_weight as out_weight'),
    array("Balance", "balance", TRUE, "balance", TRUE, TRUE,"balance",'','','','',true),
   );
}

?>