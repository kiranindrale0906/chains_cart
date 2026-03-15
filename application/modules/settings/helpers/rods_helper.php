<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Rod List',
    'primary_table'       => 'rods',
    'default_column'      => 'id',
    'table'               => array('rods'),
    'join_conditions'     => array(),
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'created_at DESC',
    'group_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'rods',
    'add_title'           => 'Add Rods',
    'export_title'        => '',
    'edit'                => '',
    'custom_table_header' => false,
    'select_column'       => false,
  );
}


function list_settings() {
  return array(
    array("Name", "name", TRUE, "name", TRUE, TRUE, 'name', 'name', FALSE,'',''),
    array("Purity", "purity", TRUE, "purity", TRUE, TRUE, 'purity', 'purity', FALSE,'',''),
    array("Weight", "weight", TRUE, "weight", TRUE, TRUE, 'weight', 'weight', FALSE,'',''),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['rods'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'name'            => array('Name', 'Enter name', TRUE, '', FALSE),
    'weight'          => array('Weight', 'Enter Weight', TRUE, '', FALSE),
    'purity'          => array('Purity', 'Enter Purity', TRUE, '', FALSE),
   
  );
  return $attributes[$table][$field];
}


function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/rods';
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  $actions["delete"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  return $actions;
}