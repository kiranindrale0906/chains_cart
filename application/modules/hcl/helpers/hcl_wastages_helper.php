<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'HCL WASTAGES',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => 'processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => 'hcl_wastage > 0',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'hcl_wastages',
    'add_title'           => '',
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
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Parent Lot Name", "parent_lot_name", TRUE, "parent_lot_name", TRUE, TRUE),
    array("Lot No", "lot_no", TRUE, "lot_no", TRUE, TRUE),
    array("Department", "department_name", TRUE, "department_name", TRUE, TRUE),
    //array("Out Purity(%)", "out_purity", TRUE, "out_purity", TRUE, TRUE),
    //array("Lot Purity(%)", "out_lot_purity", TRUE, "out_lot_purity", TRUE, TRUE),
    array("HCL Wastage", "hcl_wastage", TRUE, "hcl_wastage", TRUE, TRUE,'hcl_wastage','','','','',true),

    array("Out HCL Wastage", "out_hcl_wastage", TRUE, "out_hcl_wastage", TRUE, TRUE,'out_hcl_wastage','','','','',true),

    array("Balance HCL Wastage", "balance_hcl_wastage", TRUE, "balance_hcl_wastage", TRUE, TRUE,'balance_hcl_wastage','','','','',true),

    array("Balance HCL Wastage Gross", "balance_hcl_wastage_gross", TRUE, "balance_hcl_wastage_gross", TRUE, TRUE,'FORMAT(balance_hcl_wastage * out_purity / 100,4) as balance_hcl_wastage_gross','','','','',true),

    array("Balance HCL Wastage Fine", "balance_hcl_wastage_fine", TRUE, "balance_hcl_wastage_fine", TRUE, TRUE,'FORMAT(hcl_wastage * out_purity / 100 * out_lot_purity / 100,4) as balance_hcl_wastage_fine','','','','',true),
    array("Action", "action", FALSE, "action", FALSE, FALSE));
}
function get_process_structures() {
  return array(
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
  $attributes['hcl_wastages'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'product_name' => array('Product Name', '', FALSE, '', TRUE),
    'process_name'  => array('Process Name', '', TRUE, '', TRUE),
    'department_name'  => array('Department Name', '', FALSE, '', TRUE),
    'lot_no' => array('Lot No', '', FALSE, '', TRUE),
    'process_date'  => array('Date', '', FALSE, '', TRUE),
    'in_weight'  => array('IN Weight', '', FALSE, '', TRUE),
    'in_purity'  => array('IN Purity', '', FALSE, '', TRUE),
  );
  return $attributes[$table][$field];
}
function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/processes/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');
  
  return $actions;
}



