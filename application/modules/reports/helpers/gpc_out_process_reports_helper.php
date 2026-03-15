<?php 
  function getTableSettings() {
  return array(
    'page_title'          => 'GPC Out Process List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => array('out_purity >' => 0, 
                                   'out_lot_purity >' => 0,
                                   'balance_gpc_out !=' => 0,
                                   'finish_good' => 0),
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'delay_report_karigars',
    'add_title'           => '',
    'clear_filter'        => true,
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
    array("Design Code", "design_code", TRUE, "design_code", TRUE, TRUE),
    array("In Weight", "gpc_out", TRUE, "gpc_out", TRUE, TRUE),
    array("In Lot Purity", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE),
    array("Out Weight", "issue_gpc_out", TRUE, "issue_gpc_out", TRUE, TRUE),
    array("Balance", "balance_gpc_out", TRUE, "balance_gpc_out", TRUE, TRUE),
    array("Balance Fine", "balance_gpc_out_fine", TRUE, "balance_gpc_out_fine", TRUE, TRUE,'format(balance_gpc_out*in_lot_purity/100,8) as balance_gpc_out_fine'),
    array("Is Outside", "is_outside", TRUE, "is_outside", TRUE, TRUE),
  );
}

?>