<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return  array(
    'page_title'          => 'Box weight List',
    'primary_table'       => 'box_weights',
    'default_column'      => '',
    'table'               => 'box_weights',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'created_at desc',
    'limit'               => "20",
    'filter'              => ' ',
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'box_weights',
    'add_title'           => 'Add Box Weight',
    'export_title'        => '',
    'import_title'        => ''
  );
}

function list_settings() {
  return array(
    array("Type", "daily_drawer_type", TRUE, "daily_drawer_type", TRUE, TRUE),
    array("Karigar", "karigar", TRUE, "  karigar", FALSE, TRUE),
    array("Melting", "purity", TRUE, "purity", TRUE, TRUE,'FORMAT(purity,4) as purity'),
    array("Weight", "weight", TRUE, "weight", TRUE, TRUE,'weight','','',
          'range','weight',true),
    array("Date", "created_at", TRUE, "  created_at", FALSE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE));
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes = array(
    'id' => array('', '', TRUE, '', TRUE),
    'daily_drawer_type' => array('Type', '', FALSE, '', TRUE),
    'karigar' => array('Karigar', 'Select Karigar', FALSE, '', TRUE),
    'weight' => array('Weight', 'Enter Weight', TRUE, '', TRUE),
    'purity' => array('Melting', 'Select Melting', FALSE, '', TRUE),
  );
  return $attributes[$field];
}
function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'daily_drawers/box_weights';
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'class' => 'red',
                           'confirm_message' => "",
                           'data_title' => "View",
                           'i_class' => 'far fa-trash-alt font20');                           
  return $actions;
}
