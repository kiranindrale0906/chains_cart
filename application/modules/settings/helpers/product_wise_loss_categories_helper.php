<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Product Wise Loss Categories',
    'primary_table'       => 'product_wise_loss_categories',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'product_wise_loss_categories',
    'add_title'           => 'Add Product Wise Loss Categories',
    'export_title'        => '',
    'import_title'        => '',
    'edit'                => '',
    'select_column'       => true,
    'custom_table_header' => false,
    
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
    array("ID", "id", TRUE, "id", TRUE, TRUE, 'product_wise_loss_categories.id', 'product_wise_loss_categories', FALSE,'autocomplete',''),
    array("Product name", "product_name", TRUE, "product_name", TRUE, TRUE, 'product_name', 'product_wise_loss_categories', FALSE,'autocomplete',array('product_wise_loss_categories','product_name')),
    array("Process name", "process_name", TRUE, "process_name", TRUE, TRUE, 'process_name', 'product_wise_loss_categories', FALSE,'autocomplete',array('product_wise_loss_categories','process_name')),
    array("Department name", "department_name", TRUE, "department_name", TRUE, TRUE, 'department_name', 'karigar_rates', FALSE,'autocomplete',array('product_wise_loss_categories','department_name')),
    array("Categories", "category", TRUE, "category", TRUE, TRUE, 'category', 'product_wise_loss_categories', FALSE,'autocomplete',array('product_wise_loss_categories','category')),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

/*
  | [0] => Label
  | [1] => Placeholder
  | [2] => Mandatory/Not Mandatory
  | [3] => Class
  | [4] => Autofocus
  | [5] => Readonly
  | [6] => disabled
*/

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['product_wise_loss_categories'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'page_no'              => array('Page No', '', false, '', FALSE),
    'product_name'    => array('Product name', 'Product name', TRUE, '', FALSE),
    'process_name'    => array('Process name', 'Process name', TRUE, '', FALSE),
    'department_name' => array('Department name', 'Department name', TRUE, '', FALSE),
    'category'    => array('Category Name ', 'Enter Category Name', TRUE, '', FALSE),
    );
  
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $page_no='';
  $page_no = !empty($_GET['page_no']) ? $_GET['page_no'] : '';
    if(!empty($page_no)){
      $page_no='?1=1&page_no='.$page_no;
    }
  $controller = 'settings/product_wise_loss_categories';
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'].$page_no,
                           'confirm_message' => "",
                           'class' => 'green');
  $actions["Delete"] = array('request' => "js",
                              'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'].$page_no,
                              'confirm_message' => "Do you want to delete",
                              'js_function' => "",
                              'class' => 'text-danger');
  return $actions;
}