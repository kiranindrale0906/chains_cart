<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    "page_title"          => "",
    "primary_table"       => "processes",
    "default_column"      => "id",
    "table"               => "",
    "join_conditions"     => "",
    "join_type"           => "",
    "where"               => "",
    "where_ids"           => "",
    "order_by"            => "",
    "limit"               => "20",
    "extra_select_column" => "id",
    "actionFunction"      => "",
    "headingFunction"     => "list_settings",
    "search_url"          => "process_fields",
    "add_title"           => "",
    "export_title"        => "",
    "edit"                => "",
    'clear_filter'        => true
  );
}



function get_row_id($melting_lot_id, $department_name) {
  return strtolower(str_replace(' ', '_', $melting_lot_id.' '.str_replace('+', '_', $department_name)));
}

        
function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes = array(
    'id'       => array('', '', TRUE, '', TRUE),
    'department_name'       => array('Department Name', '', TRUE, '', TRUE),
    );

  return $attributes[$field];
}
