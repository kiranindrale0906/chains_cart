<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Stock Abbreviations',
    'primary_table'       => 'stock_abbreviations',
    'default_column'      => 'id',
    'table'               => 'stock_abbreviations',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'stock_abbreviations',
    'add_title'           => 'Add Stock Abbreviations',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Stock Name", "name", TRUE, "name", TRUE, TRUE),
    array("Abbreviation ", "abbreviation ", FALSE, "abbreviation ", FALSE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/stock_abbreviations/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['stock_abbreviations'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'name'  => array('Stock Name', 'Enter Stock Name', TRUE, '', TRUE),
    'abbreviation'  => array('Abbreviations', 'Select Abbreviations', TRUE, '', TRUE),
  );
  return $attributes[$table][$field];
}