<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Loss Categories',
    'primary_table'       => 'loss_categories',
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
    'headingFunction'     => 'loss_categories',
    'search_url'          => 'loss_categories',
    'add_title'           => 'Add Loss Category',
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
    array("ID", "id", TRUE, "id", TRUE, TRUE, 'loss_categories.id', 'loss_categories', FALSE,'autocomplete',''),
    array("Name", "name", TRUE, "name", TRUE, TRUE, 'loss_categories.name', 'name', FALSE,'autocomplete',''),
    array("Department Name", "department_name", TRUE, "department_name", TRUE, TRUE, 'loss_categories.department_name', 'department_name', FALSE,'autocomplete',''),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['loss_categories'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'page_no'              => array('Page no', '', false, '', FALSE),
    'name'    => array('Name', 'Enter Name', TRUE, '', FALSE),
    'department_name'    => array('Department Name', 'Department Name', TRUE, '', FALSE),
  
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
  $controller = 'settings/loss_categories';
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'].$page_no,
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');
  $actions["delete"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'].$page_no,
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  

  return $actions;
}