<?php 

	function getTableSettings() {
  return array(
    'page_title'          => 'Phase Wise Dashboard Listing Report',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'group_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'phase_wise_dashboard_report_listing_reports',
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
    array("Balance", "balance", TRUE, "balance", TRUE, TRUE,'balance','','','','',true),
   
  );
}

?>