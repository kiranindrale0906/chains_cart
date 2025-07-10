<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Finish Good List',
    'primary_table'       => 'processes',
    'default_column'      => 'id',
    'table'               => array('processes'),
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => 'finish_good=1',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'group_by'            => 'processes.out_lot_purity',
    'limit'               => "20",
    'extra_select_column' => 'processes.id,processes.out_lot_purity',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'finish_goods',
    'add_title'           => 'Add Finish Goods',
    'export_title'        => '',
    'clear_filter'        => true,
    'edit'                => ''
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
  7 => module name
  8 => exact match(true or false) not like query == match
  9 => filter(autocomplete,select,statis,multiselect etc.)
  10 => array('table name', 'field name')
*/

function list_settings() {
  return array(
    array("Lot No", "lot_no", TRUE, "lot_no", TRUE, TRUE,'GROUP_CONCAT(lot_no) as lot_no','','','',''),
    array("Weight", "gpc_out", TRUE, "gpc_out", TRUE, TRUE,'sum(gpc_out) as gpc_out','','','','',true),
    array("Purity", "out_lot_purity", TRUE, "out_lot_purity", TRUE, TRUE),
    array("Quantity", "quantity", TRUE, "quantity", TRUE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
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

  $attributes['finish_goods'] = array(
    'id' => array('', '', TRUE, '', TRUE),
    'product_name' => array('Product Name', 'Select Product', TRUE, '', TRUE),
    'account_id'    => array('Account Type', 'Select Account Type', FALSE, '', TRUE),
    'issue_type'    => array('Issue Type', 'Select Issue Type', TRUE, '', TRUE),
    'description'  => array('Description', 'Enter Description', FALSE, '', TRUE),
    'in_weight'  => array('Total Weight', '', TRUE, '', TRUE),
    'in_purity'  => array('Melting', '', TRUE, '', TRUE),
    'in_fine'  => array('Fine', '', TRUE, '', TRUE),
    'out_purity'  => array('Issue Melting', 'Enter Issue Melting', TRUE, '', TRUE),
    'wastage_percentage'  => array('Customer Wastage', 'Enter Customer Wastage', TRUE, '', TRUE),
    'out_fine'  => array('Issue Fine', '', TRUE, '', TRUE),
    'field_name' => array('', '', TRUE, '', TRUE),
    'company_name' => array('Company Name', '', FALSE, '', TRUE),
    'out_lot_purity' => array('Purity', '', FALSE, '', TRUE),
  );

  $attributes['finish_good_details'] = array(
    'process_id' => array('', '', TRUE, '', TRUE),
    'out_weight' => array('', '', TRUE, '', TRUE),
  );

  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.'issue_departments/finish_goods/view/1?id='.$row['id'].'&purity='.$row['out_lot_purity'],
                           'confirm_message' => "",
                           'class' => 'blue',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');

  return $actions;
}

