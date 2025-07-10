<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return  array(
    'page_title'          => 'Generate Lot Qr Code',
    'primary_table'       => 'generate_lot_qr_code_details',
    'default_column'      => '',
    'table'               => 'generate_lot_qr_code_details',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "10",
    'filter'              => ' ',
    'extra_select_column' => 'generate_lot_qr_code_details.id',
    'actionFunction'      => '',
    'search_url'          => 'generate_lot_qr_codes',
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
  $attributes["generate_lot_qr_code_details"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "image"  => array("", "", FALSE, "", TRUE),
  );
  return $attributes[$table][$field];
}
