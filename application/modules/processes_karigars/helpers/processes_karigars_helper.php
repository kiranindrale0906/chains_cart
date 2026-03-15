<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Processes List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => 'karigar !=""',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'processes_karigars',
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
    array("Product Name", "product_name", TRUE, "product_name", FALSE, TRUE, "product_name as product_name"),
    array("Process Name", "process_name", TRUE, "process_name", FALSE, TRUE, "process_name as process_name"),
    array("Department Name", "department_name", TRUE, "department_name", FALSE, TRUE, "department_name as department_name"),
    array("Date", "created_at", TRUE, "  created_at", FALSE, TRUE),
    array("Karigar", "karigar", TRUE, "karigar", TRUE, TRUE),
    array("Melting", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'FORMAT(in_lot_purity,4) as in_lot_purity'),
    array("In WT", "in_weight", TRUE, "in_weight", TRUE, TRUE,'in_weight','','',
          'range','in_weight',true),
    array("Action", "action", FALSE, "action", FALSE, FALSE)
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

  $attributes = array(
    'id' => array('', '', TRUE, '', TRUE),
    'in_weight' => array('In Weight', 'Enter Weight', TRUE, '', TRUE),
    'out_weight' => array('Out Weight', 'Enter Weight', TRUE, '', TRUE),
    'product_name' => array('Product Name', '', FALSE, '', TRUE),
    'process_name' => array('Process Name', '', FALSE, '', TRUE),
    'department_name' => array('Deparment Name', '', FALSE, '', TRUE),
    'karigar' => array('Karigar', 'Enter Karigar', FALSE, '', TRUE),
    'in_lot_purity' => array('Melting', 'Select Melting', FALSE, '', TRUE),
  );

  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'processes_karigars/processes_karigars';
  $actions["Change Karigar Name"] = array('request' => "http",
                                          'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                                          'confirm_message' => "",
                                          'class' => 'btn_green',
                                          'data_title' =>'Change Karigar Name',
                                          'i_class'=>'fal fa-file-alt font20');
  return $actions;
}