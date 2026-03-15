<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title'          => 'ARC Stock Reports',
    'primary_table'       => 'processes',
    'default_column'      => 'processes.id',
    'table'               => array('processes'),
    'join_conditions'     => array(),
    'join_type'           =>'',
    'where'               => '',
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
  return array();
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
  $attributes = array(
    'id'   => array('', '', FALSE, '', TRUE),
    'process_name' => array('Process Name', '', FALSE, '', TRUE),
    'product_name' => array('Product Name', '', FALSE, '', TRUE),
    'city' => array('City', '', FALSE, '', TRUE),
    'in_lot_purity' => array('Melting', '', FALSE, '', TRUE),
    'from_date' => array('From Date', '', FALSE, '', TRUE),
    'to_date' => array('To Date', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}




