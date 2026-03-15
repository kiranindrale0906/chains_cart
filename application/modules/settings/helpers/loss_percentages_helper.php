<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Loss percentages rates',
    'primary_table'       => 'loss_percentages',
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
    'search_url'          => 'loss_percentages',
    'add_title'           => 'Add loss percentages',
    'export_title'        => 'Export',
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
    array("ID", "id", TRUE, "id", TRUE, TRUE, 'loss_percentages.id', 'loss_percentages', FALSE,'autocomplete',''),
    array("Product name", "product_name", TRUE, "product_name", TRUE, TRUE, 'product_name', 'loss_percentages', FALSE,'autocomplete',array('loss_percentages','product_name')),
    array("Process name", "process_name", TRUE, "process_name", TRUE, TRUE, 'process_name', 'loss_percentages', FALSE,'autocomplete',array('loss_percentages','process_name')),
    array("Department name", "department_name", TRUE, "department_name", TRUE, TRUE, 'department_name', 'loss_percentages', FALSE,'autocomplete',array('loss_percentages','department_name')),
    array("Karigar name", "karigar_name", TRUE, "karigar_name", TRUE, TRUE, 'karigar_name', 'loss_percentages', FALSE,'autocomplete',array('loss_percentages','karigar_name')),
    array("Loss percentage", "loss_percentage", TRUE, "loss_percentage", TRUE, TRUE, 'loss_percentage', 'loss_percentages', FALSE,'autocomplete',array('loss_percentages','loss_percentage')),
    array("Max Loss percentage", "max_loss_percentage", TRUE, "max_loss_percentage", TRUE, TRUE, 'max_loss_percentage', 'loss_percentages', FALSE,'autocomplete',array('loss_percentages','max_loss_percentage')),
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

  $attributes['loss_percentages'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'product_name'    => array('Product name', 'Select Product name', TRUE, '', FALSE),
    'process_name'    => array('Process name', 'Select Process name', TRUE, '', FALSE),
    'department_name' => array('Department name', 'Select Department name', TRUE, '', FALSE),
    'karigar_name' => array('Karigar', 'Select Karigar', TRUE, '', FALSE),
    'loss_percentage' => array('Auto Calculate Loss Percentage', 'Enter Loss percentage', TRUE, '', FALSE),
    'max_loss_percentage' => array('Max Loss Allowed Percentage', 'Enter Max Loss percentage', TRUE, '', FALSE),
     'page_no'              => array('page_no', '', false, '', FALSE),
  
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
  $controller = 'settings/loss_percentages';
  // $actions["Edit"] = array('request' => "http", 
  //                          'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
  //                          'confirm_message' => "",
  //                          'class' => 'green');
  $actions["Delete"] = array('request' => "http",
                             'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                             'confirm_message' => "Do you want to delete?",
                             'class' => 'red');
  return $actions;
}