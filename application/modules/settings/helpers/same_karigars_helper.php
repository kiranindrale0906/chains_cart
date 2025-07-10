<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Same Karigars',
    'primary_table'       => 'karigars',
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
    'search_url'          => 'karigars',
    'add_title'           => 'Add Karigar',
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
    array("ID", "id", TRUE, "id", TRUE, TRUE, 'karigars.id', 'karigars', FALSE,'autocomplete',''),
    array("Product name", "product_name", TRUE, "product_name", TRUE, TRUE, 'product_name', 'karigars', FALSE,'autocomplete',array('karigars','product_name')),
    array("Process name", "process_name", TRUE, "process_name", TRUE, TRUE, 'process_name', 'karigars', FALSE,'autocomplete',array('karigars','process_name')),
    array("Department name", "department_name", TRUE, "department_name", TRUE, TRUE, 'department_name', 'karigar_rates', FALSE,'autocomplete',array('karigars','department_name')),
    array("Karigar name", "karigar_name", TRUE, "karigar_name", TRUE, TRUE, 'karigar_name', 'karigars', FALSE,'autocomplete',array('karigars','karigar_name')),
    array("Due Duration", "due_duration", FALSE, "due_duration", FALSE, TRUE, 
                                                "CONCAT(
                                                      FLOOR(TIME_FORMAT(SEC_TO_TIME(due_duration), '%H') / 24), 'days ',
                                                      MOD(TIME_FORMAT(SEC_TO_TIME(due_duration), '%H'), 24), 'h:',
                                                      TIME_FORMAT(SEC_TO_TIME(due_duration), '%im:%ss')
                                                  ) as due_duration"),
     array("Capacity", "capacity", TRUE, "capacity", TRUE, TRUE, 'capacity', 'capacity', FALSE),
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
  $attributes['same_karigars'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'product_name'    => array('Product name', 'Product name', TRUE, '', FALSE),
    'process_name'    => array('Process name', 'Process name', TRUE, '', FALSE),
    'department_name' => array('Department name', 'Department name', TRUE, '', FALSE),
    'karigar_name'    => array('Karigar name', 'Enter Karigar name', TRUE, '', FALSE),
    'due_duration'    => array('Process Duration', 'Select Duration', TRUE, '', FALSE),
    'capacity'        => array('Capacity', 'Enter Capacity', TRUE, '', FALSE),
    'page_no'        => array('Page no', '', TRUE, '', FALSE),
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
  $controller = 'settings/same_karigars';
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