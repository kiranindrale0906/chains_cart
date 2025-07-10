<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title'          => 'Parent Lot Loss List',
    'primary_table'       => 'processes',
    'default_column'      => 'processes.id',
    'table'               => array('processes'),
    'join_conditions'     => array(),
    'join_type'           =>'',
    'where'               => 'lot_no!=""',
    'where_ids'           => '',
    'order_by'            => '',
    'group_by'            => 'processes.melting_lot_id',
    'limit'               => "50",
    'filter'              => ' ',
    'extra_select_column' => 'processes.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'lot_loss',
    'add_title'           => '',
    'export_title'        => '',
    'import_title'        => ''
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
    array("Lot No", "lot_no", false, "lot_no", TRUE, TRUE,'lot_no as lot_no'),

    array("Lot Purity", "in_lot_purity", false, "in_lot_purity", TRUE, TRUE,'in_lot_purity as in_lot_purity'),

    array("Final Process HCL Loss", "loss", false, "loss", TRUE, TRUE,'(select sum(loss) from processes as hcl_process where hcl_process.melting_lot_id = processes.melting_lot_id and department_name="HCL") as loss'),

    array("Expected Out", "expected_out_weight", false, "expected_out_weight", TRUE, TRUE,'sum(hcl_wastage_gross) as expected_out_weight'),

    array("HCL Weight", "hcl_weight", false, "hcl_weight", TRUE, TRUE,'(select sum(out_weight) from processes as hcl_process where hcl_process.melting_lot_id = processes.melting_lot_id and process_name="HCL Process") as hcl_weight'),

    array("HCL Loss", "hcl_loss", false, "hcl_loss", TRUE, TRUE,'(select sum(out_weight)-sum(processes.hcl_wastage_gross) from processes as hcl_process where hcl_process.melting_lot_id = processes.melting_lot_id and process_name="HCL Process") as hcl_loss'),

    array("Melting", "melting", false, "melting", TRUE, TRUE,'(select sum(out_purity) from processes as hcl_process where hcl_process.melting_lot_id = processes.melting_lot_id and process_name="HCL Process") as melting'),


    array("Status", "status", false, "status", TRUE, TRUE,'status as status'),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}
 
/*
  | [0] => Label
  | [1] => Placeholder
  | [2] => Mandatory/Not Mandatory
  | [3] => Class
  | [4] => Autofocus
  | [5] => Readonly
  | [6] => disabled
*/

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
 
  return $actions;
}
function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes= array(
    'id' => array('', '', FALSE, '', TRUE),
    'process_name'  => array('Chain', '', FALSE, '', TRUE),
    
  );

  return $attributes[$field];
}




