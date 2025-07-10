<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Design Names',
    'primary_table'       => 'category_four',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'category_four.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'category_fours',
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
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE, 'product_name', 'category_four', FALSE,'autocomplete',array('category_four','category_fours')),
     array("Category One", "category_one", TRUE, "category_one", TRUE, TRUE, 'category_one', 'category_four', FALSE,'autocomplete',array('category_four','category_one')),
    array("Machine Size", "machine_size", TRUE, "machine_size", TRUE, TRUE, 'machine_size', 'category_four', FALSE,'autocomplete',array('category_four','machine_size')),
    array("Design Name", "category", TRUE, "category", TRUE, TRUE, 'category', 'category_four', FALSE,'autocomplete',array('category_four','category')),
    array("Design  Chitti Name", "design_chitti_name", TRUE, "design_chitti_name", TRUE, TRUE, 'design_chitti_name', 'category_four', FALSE,'autocomplete',array('category_four','design_chitti_name')),
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

  $attributes['category_fours'] = array(
    'id'           => array('ID', '', false, '', FALSE),
    'product_name' => array('Product Name', 'Select product name', TRUE, '', FALSE),
    'category' => array('Name', 'Enter category', TRUE, '', FALSE),
    'category_one' => array('Category One', 'Select category one', TRUE, '', FALSE),
    'machine_size' => array('Machine Size', 'Select machine Size', TRUE, '', FALSE),
    'design_chitti_name' => array('Design Chitti Name', 'Enter chitti name', TRUE, '', FALSE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/category_fours';
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