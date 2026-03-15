<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Categories',
    'primary_table'       => 'categories',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'categories.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'categories',
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
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE, 'product_name', 'categories', FALSE,'autocomplete',array('categories','product_name')),
    array("Category One", "category_one", TRUE, "category_one", TRUE, TRUE, 'category_one', 'categories', FALSE,'autocomplete',array('categories','category_one')),
    array("Category Two", "category_two", TRUE, "category_two", TRUE, TRUE, 'category_two', 'chain_purities', FALSE,'autocomplete',array('categories','category_two')),
    array("Category Three", "category_three", TRUE, "category_three", TRUE, TRUE, 'category_three', 'categories', FALSE,'autocomplete',array('categories','category_three')),
    array("Category Four", "category_four", TRUE, "category_four", TRUE, TRUE, 'category_four', 'categories', FALSE,'autocomplete',array('categories','category_four')),
    array("Wastage", "wastage", TRUE, "wastage", TRUE, TRUE, 'wastage', 'categories', FALSE,'autocomplete',array('categories','wastage')),
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

  $attributes['categories'] = array(
    'id'           => array('ID', '', false, '', FALSE),
    'product_name' => array('Product Name', 'Enter Product Name', TRUE, '', FALSE),
    'category_one' => array('Category One', 'Enter Category One', TRUE, '', FALSE),
    'category_two' => array('Category Two', 'Enter Category Two', false, '', FALSE),
    'category_three' => array('Category Three', 'Enter Category Three', false, '', FALSE),
    'category_four' => array('Category Four', 'Enter Category Four', false, '', FALSE),
    'wastage' => array('Wastage', 'Enter Wastage', false, '', FALSE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/categories';
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