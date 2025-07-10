<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return  array(
    'page_title'          => 'Tounch Out Process',
    'primary_table'       => 'processes',
    'default_column'      => '',
    'table'               => 'processes',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "10",
    'filter'              => ' ',
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'search_url'          => 'tounch_out_processes',
    'add_title'           => '',
    'export_title'        => '',
    'import_title'        => ''
  );
}

function list_settings() {
  return array();
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes["tounch_out_processes"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "product_name"  => array("Products", "Select", FALSE, "", TRUE),
    "in_weight"  => array("Weight", "", FALSE, "", TRUE),
  );
  $attributes["process_out_wastage_details"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "process_id"  => array("", "", FALSE, "", TRUE),
  );
  return $attributes[$table][$field];
}