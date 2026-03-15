<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return  array(
    'page_title'          => 'Melting Wastage Refine Out Process',
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
    'search_url'          => 'melting_wastage_refine_out_processes',
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
  $attributes["melting_wastage_refine_out_processes"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "in_weight"  => array("Weight", "", FALSE, "", TRUE),
    "product_name"  => array("Products", "Select", FALSE, "", TRUE),
    "department_name"  => array("Departments", "Select", FALSE, "", TRUE),
  );
  $attributes["process_out_wastage_details"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "process_id"  => array("", "", FALSE, "", TRUE),
  );
  return $attributes[$table][$field];
}