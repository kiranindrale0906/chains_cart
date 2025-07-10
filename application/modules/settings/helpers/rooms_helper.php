<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Rooms List',
    'primary_table'       => 'rooms',
    'default_column'      => 'id',
    'table'               => array('rooms'),
    'join_conditions'     => array(),
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'name ASC',
    'group_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'rooms',
    'add_title'           => 'Add Room',
    'export_title'        => '',
    'edit'                => '',
    'custom_table_header' => false,
    'select_column'       => false,
  );
}

function list_settings() {
  return array(
    array("Room Name", "name", TRUE, "name", TRUE, TRUE, 'name', 'name', FALSE,'',''),
    array("Department Name", "department_name", TRUE, "department_name", TRUE, TRUE, 'department_name', 'department_name', FALSE,'',''),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['rooms'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'name'            => array('Name', 'Enter room  name', TRUE, '', FALSE),
    'department_name' => array('Department Name', 'Enter Department Name', TRUE, '', FALSE),
   
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/rooms';
  $actions["delete"] = array('request' => "http",
                             'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                             'confirm_message' => "",
                             'class' => 'red',
                             'data_title' =>'View',
                             'i_class'=>'fal fa-file-alt font20');
  return $actions;
}