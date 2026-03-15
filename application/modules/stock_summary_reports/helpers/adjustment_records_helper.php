<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'adjustment records',
    'primary_table'       => 'adjustment_records',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'adjustment_records',
    'add_title'           => 'Add Adjustment',
    'export_title'        => '',
    'import_title'        => '',
    'edit'                => '',
    'select_column'       => true,
    'custom_table_header' => false,
    
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

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['adjustment_records'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'balance'    => array('Balance', 'Enter Balance', TRUE, '', FALSE),
    'balance_gross'    => array('Balance Gross', 'Enter Balance Gross', TRUE, '', FALSE),
    'balance_fine'    => array('Balance Fine', 'Enter Balance Fine', TRUE, '', FALSE),
    );
  
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  return $actions;
}