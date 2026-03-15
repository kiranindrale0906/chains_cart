<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return  array(
    'page_title'          => 'Daily Drawer Hold Process List',
    'primary_table'       => 'processes',
    'default_column'      => '',
    'table'               => 'processes',
    'join_conditions'     => '',
    'where'               => 'balance_daily_drawer_wastage!=0 and daily_drawer_required_status=0',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'filter'              => ' ',
    'extra_select_column' => 'processes.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'daily_drawers/daily_drawer_hold_processes',
    'add_title'           => '',
    'export_title'        => '',
    'import_title'        => '',
    'custom_table_header' => false
  );
}

function list_settings() {
  return array(
    array("Lot No", "processes.lot_no", TRUE, "processes.lot_no", FALSE, TRUE),
    array("Product Name", "processes.product_name", TRUE, "processes.product_name", FALSE, TRUE),
    array("Process Name", "processes.process_name", TRUE, "processes.process_name", TRUE, TRUE),
    array("Department Name", "processes.department_name", TRUE, "processes.department_name", TRUE, TRUE),
    array("Purity", "processes.hook_kdm_purity", TRUE, "processes.hook_kdm_purity", TRUE, TRUE),
    array("Daily Drawer Wastage", "daily_drawer_wastage", TRUE, "daily_drawer_wastage", TRUE, TRUE),
    /*array("Chain Name", "chain_name", TRUE, "chain_name", TRUE, TRUE),
    array("Created by", "name", TRUE, "name", TRUE, TRUE, 'users.name name', 'users', FALSE,'autocomplete'),*/
    array("", "action", FALSE, "action", FALSE, FALSE));
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["Required"] = array('request' => "http",
                           'url' => ADMIN_PATH.'daily_drawers/daily_drawer_hold_processes/update/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'Required',
                            'i_class'=>'fal fa-file-alt font20');
   return $actions;
}
function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes["gpc_out_hold_processes"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "in_weight"  => array("Weight", "", FALSE, "", TRUE),
    "product_name"  => array("Products", "Select", FALSE, "", TRUE),
    "melting"  => array("Melting", "Select", FALSE, "", TRUE),
    "gpc_out_sections"  => array("", "", FALSE, "", TRUE),
  );
  $attributes["process_out_wastage_details"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "process_id"  => array("", "", FALSE, "", TRUE),
  );
  return $attributes[$table][$field];
}


