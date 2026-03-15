<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return  array(
    'page_title'          => 'Stone Process',
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
    'search_url'          => 'stone_vatav_processes',
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
  $attributes["stone_vatav_processes"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "in_weight"  => array("Total Stone In", "", FALSE, "", TRUE),
    "ghiss"  => array("Ghiss", "", FALSE, "", TRUE),
    "loss"  => array("Loss", "", FALSE, "", TRUE),
    "in_lot_purity"  => array("In Lot Purity", "Select", FALSE, "", TRUE),
  );
  $attributes["process_out_wastage_details"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "process_id"  => array("", "", FALSE, "", TRUE),
  );
  return $attributes[$table][$field];
}