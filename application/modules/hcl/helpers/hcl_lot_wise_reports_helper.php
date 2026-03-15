<?php 
 function getTableSettings() {
  return array(
    'page_title'          => 'HCL Report',
    'primary_table'       => 'process_out_wastage_details',
    'default_column'      => 'id',
    'table'               => array('process_out_wastage_details','processes'),
    'join_conditions'     => array('process_out_wastage_details.parent_id = processes.id'),
    'join_type'           => 'LEFT',
    'where'               => 'product_name = "HCL" AND process_name="HCL Melting Process" AND balance  > 0',
    'where_ids'           => '',
    'order_by'            => '',
    'group_by'            => 'balance,lot_no,process_name,chain_name',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'hcl_process_balance',
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
    array("Process", 'process_name', TRUE, 'process_name', TRUE, TRUE,'process_name as process_name'),
    array("Chain Name", 'chain_name', TRUE, 'chain_name', TRUE, TRUE,'chain_name as chain_name'),
    array("Balance", "balance", TRUE, "balance", TRUE, TRUE,"balance",'','','','',true),
   );
}

?>