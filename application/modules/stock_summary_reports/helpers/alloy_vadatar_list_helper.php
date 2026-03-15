<?php defined("BASEPATH") OR exit("No direct script access allowed.");
function getTableSettings($data = array(), $where = array()) {
  return  array(
    'page_title'          => 'Alloy Vadatar List',
    'primary_table'       => 'melting_lots',
    'default_column'      => 'melting_lots.id',
    'table'               => array('melting_lots'),
    'join_conditions'     => array(),
    'join_type'           =>'',
    'where'               => $where,
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "50",
    'filter'              => ' ',
    'extra_select_column' => 'melting_lots.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'alloy_vadatar_list',
    'add_title'           => '',
    'export_title'        => '',
    'import_title'        => '',
    'select_column'       => true,                // Can user select columns on the table
    'arrange_column'      => true,                // Can user arrange columns on the table  
    'clear_filter'        => true,  
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
    array("Lot No", "lot_no", false, "lot_no", TRUE, TRUE,'melting_lots.lot_no as lot_no'),
    array("Date", "created_at", false, "created_at", TRUE, TRUE,'melting_lots.created_at as created_at'),
    array("Process", "process", false, "process", TRUE, TRUE,'melting_lots.process_name as process'),
    array("Description", "description", false, "description", TRUE, TRUE,'melting_lots.description as description'),
    array("Name Of Staff", "staff_name", false, "staff_name", TRUE, TRUE),
    array("Required Gold", "pure_gold_weight", false, "pure_gold_weight", TRUE, TRUE,'','','range','',true),
    array("Alloy Vadatar", "alloy_vodatar", false, "alloy_vodatar", TRUE, TRUE,'FORMAT(alloy_vodatar,4) as alloy_vodatar','','','range','',true,'alloy_vodatar'),
    array("Alloy Vadatar fine", "alloy_vodatar_fine", false, "alloy_vodatar_fine", TRUE, TRUE,'FORMAT(alloy_vodatar*lot_purity/100,4) as alloy_vodatar_fine','','','range','',true,'alloy_vodatar'),
    array("Gross Weight", "gross_weight", false, "gross_weight", TRUE, TRUE,'melting_lots.gross_weight as gross_weight','','','range','',true),
    array("Purity (%)", "lot_purity", false, "lot_purity", TRUE, TRUE,'Format(melting_lots.lot_purity,4) as lot_purity','','range','',),
  );
}
