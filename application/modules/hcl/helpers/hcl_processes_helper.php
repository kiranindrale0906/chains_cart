<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'HCL PROCESS',

    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => 'product_name="HCL" and process_name="HCL Melting Process" and department_name = "HCL Process"',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'hcl_processes',
    'add_title'           => 'ADD HCL PROCESS ENTRY',
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
    //array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Lot No", "lot_no", TRUE, "lot_no", TRUE, TRUE),
    array("Gross Weight", "in_weight", TRUE, "in_weight", TRUE, TRUE),
    array("Out Weight", "out_weight", TRUE, "out_weight", TRUE, TRUE),
    array("FE Out", "fe_out", TRUE, "fe_out", TRUE, TRUE),
    array("Expected Out", "expected_out_weight", TRUE, "expected_out_weight", TRUE, TRUE, 'ROUND(in_weight * in_purity / 100, 4) as expected_out_weight'),
    array("Loss Gross", "loss_gross", TRUE, "loss_gross", TRUE, TRUE, 'ROUND(((in_weight * in_purity / 100) - out_weight), 4) as loss_gross'),
    array("Loss Fine", "loss_fine", TRUE, "loss_fine", TRUE, TRUE, 'ROUND(((in_weight * in_purity / 100) - out_weight) * in_lot_purity / 100, 4) as loss_fine'),
    //array("Action", "action", FALSE, "action", FALSE, FALSE)
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
  $attributes['hcl_processes'] = array(
    'id' => array('', '', FALSE, '', FALSE),
   'parent_lot_id' => array('Parent Lot No', 'Select Parent Lots', FALSE, '', TRUE),
   'melting_lot_id' => array('Melting Lot No', 'Select Melting Lots', FALSE, '', TRUE),
    'in_weight' => array('Gross Weight', '', TRUE, '', TRUE),
    'process_name'  => array('Process', '', FALSE, '', TRUE),
  );
  $attributes["process_out_wastage_details"] = array(
    "id" => array("", "", FALSE, "", FALSE),
    "process_id"  => array("", "", FALSE, "", TRUE),
  );
  return $attributes[$table][$field];
}


function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'hcl/hcl_processes';
  // $actions["Edit"] = array('request' => "http",
  //                          'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
  //                          'confirm_message' => "",
  //                          'class' => 'btn_green',
  //                          'data_title' =>'View',
  //                           'i_class'=>'fal fa-file-alt font20');

  // $actions["Delete"] = array('request' => "http",
  //                              'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
  //                              'class' => 'btn_red',
  //                              'confirm_message' => "Do you want to delete",
  //                              'data_title' => "Delete",
  //                              'i_class' => 'far fa-trash-alt font20');
  return $actions;
}