<?php 
 function getTableSettings() {
  return array(
    'page_title'          => 'HCL Wastage Balance List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => 'balance_hcl_wastage > 0 AND lot_no != ""',
    'where_ids'           => '',
    'order_by'            => '',
    'group_by'            => 'balance_hcl_wastage,lot_no',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'hcl_wastage_balance',
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
    array("Lot No", 'lot_no', TRUE, 'lot_no', TRUE, TRUE,'lot_no as lot_no'),
    array("Balance", "balance_hcl_wastage", TRUE, "balance_hcl_wastage", TRUE, TRUE,"balance_hcl_wastage",'','','','',true),
   );
}

?>