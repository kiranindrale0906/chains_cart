<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Processes Name',
    'primary_table'       => 'processes_name',
    'default_column'      => 'id',
    'table'               => 'processes_name',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'processes_name',
    'add_title'           => 'Add Process Name',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Process Name", "process_name", TRUE, "process_name", TRUE, TRUE),
    array("Product Name", "product_name", FALSE, "product_name", FALSE, TRUE),
    array("Module Name", "module_name", FALSE, "module_name", FALSE, TRUE),
    array("Model Name", "model_name", FALSE, "model_name", FALSE, TRUE),
    array("Controller Name", "controller_name", FALSE, "controller_name", FALSE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/processes_name/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  $actions["view"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/processes_name/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['processes_name'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'process_name'  => array('Process Name', 'Enter Process Name', TRUE, '', TRUE),
    'product_name'  => array('Product Name', 'Enter Product Name', TRUE, '', TRUE),
    'module_name'  => array('Module Name', 'Enter Module Name', TRUE, '', TRUE),
    'model_name'  => array('Model Name', 'Enter Model Name', TRUE, '', TRUE),
    'controller_name'  => array('Controller Name', 'Enter Controller Name', TRUE, '', TRUE),
  );
  return $attributes[$table][$field];
}