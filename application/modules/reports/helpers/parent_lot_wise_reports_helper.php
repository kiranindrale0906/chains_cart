<?php 
	function getTableSettings() {
  return array(
    'page_title'          => 'Parent Lot Wise Report',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => 'parent_lot_name != "" AND balance > 0',
    'where_ids'           => '',
    'order_by'            => 'parent_lot_name,product_name DESC',
    'group_by'            => 'parent_lot_name,product_name',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'parent_lot_wise_reports',
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
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Parent Lot Name", "parent_lot_name", TRUE, "parent_lot_name", TRUE, TRUE),
    array("Balance", "balance", TRUE, "balance", TRUE, TRUE,'SUM(balance) as balance','','','','',true),
   
  );
}

?>