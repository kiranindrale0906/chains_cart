<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Workers List',
    'primary_table'       => 'workers',
    'default_column'      => 'id',
    'table'               => array('workers'),
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
    'search_url'          => 'workers',
    'add_title'           => 'Add Workers',
    'export_title'        => '',
    'edit'                => '',
    'custom_table_header' => false,
    'select_column'       => false,
  );
}


function list_settings() {
  return array(
    array("Department name", "department_name", TRUE, "department_name", TRUE, TRUE, 'department_name', 'department_name', FALSE,'',''),
    array("Worker Name", "name", TRUE, "name", TRUE, TRUE, 'name', 'name', FALSE,'',''),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['workers'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'name'            => array('Worker Name', 'Enter worker  name', TRUE, '', FALSE),
    'department_name'          => array('Department Name', 'Enter Department Name', TRUE, '', FALSE),
   
  );
  return $attributes[$table][$field];
}


function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/workers';
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