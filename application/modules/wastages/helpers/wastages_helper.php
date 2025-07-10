<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Wastages',
    'primary_table'       => 'wastages',
    'default_column'      => 'id',
    'table'               => 'wastages',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'wastages',
    'add_title'           => 'Add Wastages',
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
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Process Name", "process_name", TRUE, "process_name", TRUE, TRUE),
    array("Department Name", "department_name", TRUE, "department_name", TRUE, TRUE),
    array("Lot No", "lot_no", TRUE, "lot_no", TRUE, TRUE),
    array("Lot Purity", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE),
    array("Date", "process_date", TRUE, "process_date", TRUE, TRUE),
    array("In Weight", "in_weight", TRUE, "in_weight", TRUE, TRUE),
    array("In Purity", "in_purity", TRUE, "in_purity", TRUE, TRUE),
    array("Out Weight", "out_weight", TRUE, "out_weight", TRUE, TRUE),
    array("Balance", "balance_weight", TRUE, "balance_weight", TRUE, TRUE),
//    array("Action", "action", FALSE, "action", FALSE, FALSE),
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

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['wastages'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'product_name' => array('Product Name', '', FALSE, '', TRUE),
    'process_name'  => array('Process Name', '', TRUE, '', TRUE),
    'department_name'  => array('Department Name', '', FALSE, '', TRUE),
    'lot_no' => array('Lot No', '', FALSE, '', TRUE),
    'process_date'  => array('Date', '', FALSE, '', TRUE),
    'in_weight'  => array('IN Weight', '', FALSE, '', TRUE),
    'in_purity'  => array('IN Purity', '', FALSE, '', TRUE),
  );
  return $attributes[$table][$field];
}
