<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Daily Drawer Wastage Categories',
    'primary_table'       => 'daily_drawer_wastage_categories',
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
    'search_url'          => 'daily_drawer_wastage_categories',
    'add_title'           => 'Add Categories',
    'export_title'        => '',
    'edit'                => '',
    'select_column'       => true,
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
    array("ID", "id", TRUE, "id", TRUE, TRUE, 'daily_drawer_wastage_categories.id', 'daily_drawer_wastage_categories', FALSE,'autocomplete',''),
    array("Product name", "product_name", TRUE, "product_name", TRUE, TRUE, 'product_name', 'daily_drawer_wastage_categories', FALSE,'autocomplete',array('daily_drawer_wastage_categories','product_name')),
    array("Process name", "process_name", TRUE, "process_name", TRUE, TRUE, 'process_name', 'daily_drawer_wastage_categories', FALSE,'autocomplete',array('daily_drawer_wastage_categories','process_name')),
    array("Department name", "department_name", TRUE, "department_name", TRUE, TRUE, 'department_name', 'name', FALSE,'autocomplete',array('daily_drawer_wastage_categories','department_name')),
    array("Categories Name", "name", TRUE, "name", TRUE, TRUE, 'name', 'name', FALSE,'autocomplete',array('name','name')),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

/*
  | [0] => Label
  | [1] => Placeholder
  | [2] => Mandatory/Not Mandatory
  | [3] => class
  | [4] => Autofocus
  | [5] => Readonly
  | [6] => disabled
*/

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['daily_drawer_wastage_categories'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'product_name'    => array('Product name', 'Select Product name', TRUE, '', FALSE),
    'process_name'    => array('Process name', 'Select Process name', TRUE, '', FALSE),
    'department_name' => array('Department name', 'Select Department name', TRUE, '', FALSE),
    'name' => array('Category name', 'Enter Category Name', TRUE, '', FALSE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/daily_drawer_wastage_categories';
  $actions["Edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn_green');
  $actions["Delete"] = array('request' => "http",
                             'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                             'confirm_message' => "Do you want to delete?",
                             'class' => 'btn_red');
  return $actions;
}