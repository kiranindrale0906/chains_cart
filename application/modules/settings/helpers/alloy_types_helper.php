<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Alloy Types',
    'primary_table'       => 'alloy_types',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'alloy_types',
    'add_title'           => 'Add Alloy Types',
    'export_title'        => '',
    'edit'                => '',
    'select_column'       => false,
  );
}

/*
  0 => column title
  1 => column name
  2 => order flag
  3 => order column
  4 => filter flag
  5 => expand text flag
  6 => select column
*/

function list_settings() {
  return array(
    array("ID", "id", TRUE, "id", TRUE, TRUE, 'alloy_types.id', 'alloy_types', FALSE,'autocomplete',''),
    array("Alloy Name", "alloy_name", TRUE, "alloy_name", TRUE, TRUE, 'alloy_types.alloy_name', 'alloy_name', FALSE,'autocomplete',''),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['alloy_types'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'alloy_name'    => array('Alloy Name', 'Enter Alloy Name', TRUE, '', FALSE),
  
  );
  return $attributes[$table][$field];
}


function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/alloy_types';
  $actions["delete"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  return $actions;
}