<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return  array(
    'page_title'          => 'Daily Drawer Process',
    'primary_table'       => 'processes',
    'default_column'      => '',
    'table'               => 'processes',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => 'product_name="Daily Drawer" and department_name="Start"',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "10",
    'filter'              => ' ',
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'daily_drawer_processes',
    'add_title'           => 'Add Daily drawer process Entries',
    'export_title'        => '',
    'import_title'        => ''
  );
}

function list_settings() {
  return array(
    array("Weight", "in_weight", FALSE, "in_weight", FALSE, FALSE),
    array("Melting", "in_purity", FALSE, "in_purity", FALSE, FALSE),
    array("Purity(%)", "in_lot_purity", FALSE, "in_lot_purity", FALSE, FALSE),
    array("Balance GROSS", "balance_gross", FALSE, "balance_gross", FALSE, FALSE),
    array("Balance Fine", "balance_fine", FALSE, "balance_fine", FALSE, FALSE),
    array("", "action", FALSE, "action", FALSE, FALSE));
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes["daily_drawer_processes"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "in_weight"  => array("Weight", "", FALSE, "", TRUE),
    "product_name"  => array("Products", "Select", FALSE, "", TRUE),
    "in_purity"  => array("Melting", "Select", FALSE, "", TRUE),
    "daily_drawer_sections"  => array("", "", FALSE, "", TRUE),
  );
  $attributes["process_out_wastage_details"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "process_id"  => array("", "", FALSE, "", TRUE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'daily_drawers/daily_drawer_processes';
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/view/'.$row['id'],
                           'class' => 'red',
                           'confirm_message' => "",
                           'data_title' => "View",
                           'i_class' => 'far fa-trash-alt font20');                           
  return $actions;
}