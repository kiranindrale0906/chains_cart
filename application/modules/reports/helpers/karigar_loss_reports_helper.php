<?php 
	function getTableSettings() {
  return array(
    'page_title'          => 'Karigar Loss Report',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => 'product_name="KA Chain" and department_name ="Hook" and (out_weight!=0 or loss !=0)',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'karigar_loss_reports',
    'add_title'           => '',
    'export_title'        => '',
    'total_column'        => true,
    'clear_filter'        => true,   
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
    'id'   => array('', '', FALSE, '', TRUE),
    'start_date' => array('Start Date', '', FALSE, '', TRUE),
    'end_date' => array('End Date', '', FALSE, '', TRUE),
    'karigar_name' => array('Karigar Name', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}

function list_settings() {
  return array(
    array("Karigar Name", "karigar", TRUE, "karigar", TRUE, TRUE),
    array("Date", "created_at", TRUE, "created_at", TRUE, TRUE),
    array("Lot No", "lot_no", TRUE, "lot_no", false, TRUE),

   array("Out Weight", "out_weight", TRUE, "out_weight", false, TRUE,'out_weight','','','range','',true,'chain'),
   array("Karigar Loss", "loss", TRUE, "loss", false, TRUE,'loss','','','range','',true,'chain'),
    
   
  );
}

?>