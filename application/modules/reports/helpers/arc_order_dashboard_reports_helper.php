<?php 

	function getTableSettings() {
  return array(
    'page_title'          => '',
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
    'search_url'          => 'arc_order_dashboard_reports',
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
    'id'              => array('', 'Select', FALSE, '', TRUE),
    'process_name'       => array('Process name', 'Select', FALSE, '', TRUE),
    'purity'       => array('Purity', 'Select', FALSE, '', TRUE),
    'colour'       => array('Colour', 'Select', FALSE, '', TRUE),
    'customer_name'       => array('Customer Name', 'Select', FALSE, '', TRUE),
    'status'       => array('Status', 'Select', FALSE, '', TRUE),
    'order_no'       => array('Order No', 'Select', FALSE, '', TRUE),
   );

  return $attributes[$field];
}



?>
