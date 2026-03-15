<?php 
	function getTableSettings() {
  return array(
    'page_title'          => 'Karigar Balance Sheet',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => array('karigar'=>$_GET['karigar'],'(balance)+(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) >'=>0),
    'where_ids'           => '',
    'order_by'            => 'karigar DESC',
    'group_by'            => 'parent_lot_name,lot_no,product_name,in_purity,karigar',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'karigar_lists',
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
    array("Karigar Name", "karigar", TRUE, "karigar", TRUE, TRUE,'karigar'),
    array("Lot", "lot_name", TRUE, "lot_name", TRUE, TRUE,'IF(parent_lot_name IS NULL OR 
  																										parent_lot_name = "",lot_no,parent_lot_name) as lot_name'),
    array("Product name", "product_name", TRUE, "product_name", TRUE, TRUE,'product_name'),
    array("Purity", "in_purity", TRUE, "in_purity", TRUE, TRUE,'in_purity'),
    array("Balance", "balance", TRUE, "balance", TRUE, TRUE,'SUM(balance) + SUM(daily_drawer_in_weight - hook_in + hook_out - daily_drawer_out_weight) as balance','','','','',true),
  
  );
}