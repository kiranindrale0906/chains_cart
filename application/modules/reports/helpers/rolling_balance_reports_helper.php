<?php 
	function getTableSettings() {
  return array(
    'page_title'          => 'Chain Making Wastge Report',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => array('product_name'=>'Indo Tally Chain','process_name'=>'Chain Making Process','department_name'=>'Chain Making','out_weight!='=>0),
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'chain_making_wastage_reports',
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
   array("Date", "created_at", TRUE, "created_at", TRUE, TRUE),
   array("Parent Lot Name", "parent_lot_name", TRUE, "parent_lot_name", TRUE, TRUE),
   array("Karigar", "karigar", TRUE, "karigar", TRUE, TRUE),
   array("In Weight", "in_weight", TRUE, "in_weight", TRUE, TRUE),
   array("In Lot Purity", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE),
   array("Out Weight", "out_weight", TRUE, "out_weight", TRUE, TRUE),
   array("Wastage", "hcl_wastage", TRUE, "hcl_wastage", TRUE, TRUE),
   array("Wastage %", "wastege_per", TRUE, "wastege_per", TRUE, TRUE,'Round(hcl_wastage/in_weight*100,8) as wastege_per'),
  );
}

?>