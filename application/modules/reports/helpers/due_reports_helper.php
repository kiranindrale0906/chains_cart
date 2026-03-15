<?php 
	function getTableSettings() {
  return array(
    'page_title'          => 'Delay Pending Report',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => array('NOW() > `expected_at`'=>NULL,'status'=>'Pending','balance >'=>0),
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'due_reports',
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
    array("Id", "id", TRUE, "id", TRUE, TRUE),
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Process Name", "process_name", TRUE, "process_name", TRUE, TRUE),
    array("Department Name", "department_name", TRUE, "department_name", TRUE, TRUE),
    array("In Weight", "in_weight", TRUE, "in_weight", TRUE, TRUE),
    array("In Purity", "in_purity", TRUE, "in_purity", TRUE, TRUE),
    array("In Lot Purity", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE),
    array("Out Weight", "out_weight", TRUE, "out_weight", TRUE, TRUE),
    array("Balance", "balance", TRUE, "balance", TRUE, TRUE,'balance as balance','','','','',true),
    array("Balance Gross", "balance_gross", TRUE, "balance_gross", TRUE, TRUE,'balance_gross as balance_gross','','','','',true),
    array("Balance Fine", "balance_fine", TRUE, "balance_fine", TRUE, TRUE,'balance_fine as balance_fine','','','','',true),
    array("Created Date", "created_at", TRUE, "created_at", TRUE, TRUE),
    array("Expected At", "expected_at", TRUE, "expected_at", TRUE, TRUE),
    array("Status", "status", TRUE, "status", TRUE, TRUE),

   
  );
}

?>