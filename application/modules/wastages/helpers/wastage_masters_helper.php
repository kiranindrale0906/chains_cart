<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Wastage Masters',
    'primary_table'       => 'wastage_masters',
    'default_column'      => 'id',
    'table'               => 'wastage_masters',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'wastage_masters',
    'add_title'           => 'Add Wastage master',
    'export_title'        => '',
    'edit'                => '',
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
    array("Customer Name", "customer_name", TRUE, "customer_name", TRUE, TRUE),
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
  $attributes['wastage_masters'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'customer_name' => array('Customer Name', '', FALSE, '', TRUE),
    );
  $attributes['wastage_master_details'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'chain' => array('', '', FALSE, '', TRUE),
    'category_name' => array('', '', FALSE, '', TRUE),
    'tone' => array('', '', FALSE, '', TRUE),
    'purity' => array('', '', FALSE, '', TRUE),
    'machine_size' => array('', '', FALSE, '', TRUE),
    'design' => array('', '', FALSE, '', TRUE),
    'machine_size' => array('', '', FALSE, '', TRUE),
    'design' => array('', '', FALSE, '', TRUE),
    'wastage' => array('', '', FALSE, '', TRUE),
    'factory_purity' => array('', '', FALSE, '', TRUE),
    'wastage' => array('', '', FALSE, '', TRUE),
    'sequance' => array('', '', FALSE, '', TRUE),
    );
  return $attributes[$table][$field];
}
function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'wastages/wastage_masters';

  
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'Edit',
                           'i_class'=>'fal fa-file-alt font20');

  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'blue',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  $actions["Delete"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'Delete',
                           'i_class'=>'fal fa-file-alt font20');


  return $actions;
}
