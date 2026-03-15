<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Alloy Element Details',
    'primary_table'       => 'alloy_element_details',
    'default_column'      => 'id',
    'table'               => 'alloy_element_details',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'alloy_element_details',
    'add_title'           => 'Add Alloy Element',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Company Name", "company_name", TRUE, "company_name", TRUE, TRUE),
    array("Alloy Name", "alloy_name", FALSE, "alloy_name", FALSE, TRUE),
    array("AG", "ag", FALSE, "ag", FALSE, TRUE),
    array("CU", "cu", FALSE, "cu", FALSE, TRUE),
    array("ZN", "zn", FALSE, "zn", FALSE, TRUE),
    array("IN", "i_n", FALSE, "i_n", FALSE, TRUE),
    array("IR", "ir", FALSE, "ir", FALSE, TRUE),
    array("CO", "co", FALSE, "co", FALSE, TRUE),
    array("RU", "ru", FALSE, "ru", FALSE, TRUE),
    array("NI", "ni", FALSE, "ni", FALSE, TRUE),
    array("XI", "xi", FALSE, "xi", FALSE, TRUE),
    array("GA", "ga", FALSE, "ga", FALSE, TRUE),
    array("TA", "ta", FALSE, "ta", FALSE, TRUE),
    array("GE", "ge", FALSE, "ge", FALSE, TRUE),
    array("Extra", "extra", FALSE, "extra", FALSE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/alloy_element_details/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  $actions["delete"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/processes_name/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['alloy_element_details'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'company_name'  => array('Company Name', 'Enter Company Name', TRUE, '', TRUE),
    'alloy_name'  => array('Alloy Name', 'Enter Alloy Name', FALSE, '', TRUE),
    'ag'  => array('AG', 'Enter AG', FALSE, '', TRUE),
    'cu'  => array('CU', 'Enter CU', FALSE, '', TRUE),
    'zn'  => array('ZN', 'Enter ZN', FALSE, '', TRUE),
    'i_n'  => array('IN', 'Enter IN', FALSE, '', TRUE),
    'ir'  => array('IR', 'Enter IR', FALSE, '', TRUE),
    'co'  => array('CO', 'Enter CO', FALSE, '', TRUE),
    'ru'  => array('RU', 'Enter RU', FALSE, '', TRUE),
    'ni'  => array('NI', 'Enter NI', FALSE, '', TRUE),
    'xi'  => array('XI', 'Enter XI', FALSE, '', TRUE),
    'ga'  => array('GA', 'Enter GA', FALSE, '', TRUE),
    'ta'  => array('TA', 'Enter TA', FALSE, '', TRUE),
    'ge'  => array('GE', 'Enter GE', FALSE, '', TRUE),
    'extra'  => array('Extra', 'Enter Extra', FALSE, '', TRUE),
  );
  return $attributes[$table][$field];
}