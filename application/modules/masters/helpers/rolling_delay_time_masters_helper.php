<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Rolling Delay Time Masters',
    'primary_table'       => 'rolling_delay_time_masters',
    'default_column'      => 'id',
    'table'               => 'rolling_delay_time_masters',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'product_name',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'rolling_delay_time_masters',
    'add_title'           => 'Add Rolling Delay Time Masters',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Delay Time", "delay_time", TRUE, "delay_time", TRUE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/rolling_delay_time_masters/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  $actions["delete"] = array('request' => "js",
                             'url' => ADMIN_PATH.'masters/rolling_delay_time_masters/delete/'.$row['id'],
                             'confirm_message' => "Do you want to delete",
                             'js_function' => "",
                             'class' => 'text-danger');

  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['rolling_delay_time_masters'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'product_name'  => array('Product Name', 'Enter Product Name', TRUE, '', TRUE),
    'delay_time'  => array('Delay Time', 'Enter Delay Time', TRUE, '', TRUE),
      );
  return $attributes[$table][$field];
}
