<?php 
	function getTableSettings() {
  return array(
    'page_title'          => 'Pending Balance Report',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => array('balance>'=>0),
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'pending_balance_reports',
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
   array("Lot No", "lot_no", TRUE, "lot_no", TRUE, TRUE),
   array("Parent Lot Name", "parent_lot_name", TRUE, "parent_lot_name", TRUE, TRUE),
   array("Karigar", "karigar", TRUE, "karigar", TRUE, TRUE),
   array("In Weight", "in_weight", TRUE, "in_weight", TRUE, TRUE),
   array("In Lot Purity", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE),
   array("Balance", "balance", TRUE, "balance", TRUE, TRUE),
   array("Balance Gross", "balance_gross", TRUE, "balance_gross", TRUE, TRUE),
   array("Balance Fine", "balance_fine", TRUE, "balance_fine", TRUE, TRUE),
  );
}
function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'processes/processes';
  
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/processes/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');
  
  return $actions;
}



?>