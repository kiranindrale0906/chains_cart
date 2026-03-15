<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Out Weight Categories',
    'primary_table'       => 'out_weight_categories',
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
    'headingFunction'     => 'out_weight_categories',
    'search_url'          => 'out_weight_categories',
    'add_title'           => 'Add Out Weight Category',
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
    array("ID", "id", TRUE, "id", TRUE, TRUE, 'out_weight_categories.id', 'out_weight_categories', FALSE,'autocomplete',''),
    array("Name", "name", TRUE, "name", TRUE, TRUE, 'out_weight_categories.name', 'name', FALSE,'autocomplete',''),
    array("Department Name", "department_name", TRUE, "department_name", TRUE, TRUE, 'out_weight_categories.department_name', 'department_name', FALSE,'autocomplete',''),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['out_weight_categories'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'name'    => array('Name', 'Enter Name', TRUE, '', FALSE),
    'department_name'    => array('Department Name', 'Department Name', TRUE, '', FALSE),
  
  );
  return $attributes[$table][$field];
}


function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/out_weight_categories';
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