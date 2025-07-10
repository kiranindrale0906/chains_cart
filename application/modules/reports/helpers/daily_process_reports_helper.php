<?php 

	function getTableSettings() {
  return array(
    'page_title'          => 'Process Wise Dashboard Listing Report',
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
    'search_url'          => 'process_wise_dashboard_listing_reports',
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
  function get_field_attribute($table, $field) {
  $attributes = array(
    'id'              => array('', '', FALSE, '', TRUE),
    'department_name'       => array('Department name', '', FALSE, '', TRUE),
    'in_purity'       => array('Purity', '', FALSE, '', TRUE),
    'day'       => array('day', '', FALSE, '', TRUE),
    'category_one'       => array('Category One', 'Select', FALSE, '', TRUE),
    'type'       => array('type', '', FALSE, '', TRUE),
   );

  return $attributes[$field];
}

function list_settings() {
  return array(
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Parent Lot Name", "parent_lot_name", TRUE, "parent_lot_name", TRUE, TRUE),
    array("Parent Lot Name", "parent_lot_name", TRUE, "parent_lot_name", TRUE, TRUE),
    array("Balance", "balance", TRUE, "balance", TRUE, TRUE,'balance','','','','',true),
   
  );
}

?>
