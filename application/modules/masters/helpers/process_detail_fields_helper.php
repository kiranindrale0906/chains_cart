<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Process Detail Fields',
    'primary_table'       => 'process_detail_fields',
    'default_column'      => 'id',
    'table'               => 'process_detail_fields',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'process_detail_fields',
    'add_title'           => 'Add Process Detail Field',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Process Name", "process_name", TRUE, "process_name", TRUE, TRUE),
    array("Product Name", "product_name", FALSE, "product_name", FALSE, TRUE),
    array("Department Name", "department_name", FALSE, "department_name", FALSE, TRUE),
    array("Field Name", "field_name", FALSE, "field_name", FALSE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/process_detail_fields/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  $actions["view"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/process_detail_fields/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  $actions["delete"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/process_detail_fields/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-danger');
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['process_detail_fields'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'process_name'  => array('Process Name', 'Enter Process Name', TRUE, '', TRUE),
    'product_name'  => array('Product Name', 'Enter Product Name', TRUE, '', TRUE),
    'department_name'  => array('Department Name', 'Enter Department Name', TRUE, '', TRUE),
    'field_name'  => array('Field Name', 'Enter Field Name', TRUE, '', TRUE),
  );
  return $attributes[$table][$field];
}