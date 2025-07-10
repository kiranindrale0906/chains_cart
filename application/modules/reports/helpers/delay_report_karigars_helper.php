<?php 
	function getTableSettings() {
  return array(
    'page_title'          => 'Delay Report Completed List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => array('TIMESTAMP(completed_at) > TIMESTAMP(`expected_at`)'=>NULL,
                                  'status'=>'Complete','completed_at !='=>'',
                                  'expected_at !='=>''),
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'delay_report_karigars',
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
    array("Balance", "balance", TRUE, "balance", TRUE, TRUE),
    array("Balance Gross", "balance_gross", TRUE, "balance_gross", TRUE, TRUE),
    array("Balance Fine", "balance_fine", TRUE, "balance_fine", TRUE, TRUE),
    array("Pending From", "created_at", TRUE, "created_at", TRUE, TRUE),
    array("Completed At", "completed_at", TRUE, "completed_at", TRUE, TRUE),
    array("Expected Till", "expected_at", TRUE, "expected_at", TRUE, TRUE),
    array("Status", "status", TRUE, "status", TRUE, TRUE),

   
  );
}

?>