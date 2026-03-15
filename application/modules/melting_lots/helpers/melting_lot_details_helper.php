<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title'          => 'Melting Lots List',
    'primary_table'       => 'melting_lots',
    'default_column'      => 'melting_lots.id',
    'table'               => 'melting_lots',
    'join_columns'        => '',
    'join_type'           =>'',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "50",
    'filter'              => ' ',
    'extra_select_column' => 'melting_lots.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'melting_lots',
    'add_title'           => 'Add Melting Lot',
    'export_title'        => '',
    'import_title'        => ''
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
  return array();
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
  $attributes['melting_lot_details'] = array(
    'id'            => array('', '', TRUE, '', TRUE),
    'melting_lot_id'            => array('', '', TRUE, '', TRUE),
    'process_id'  => array('', '', TRUE, '', TRUE),
    'process_name'  => array('', '', TRUE, '', TRUE),
    'in_purity'  => array('', '', TRUE, '', TRUE),    
    'in_weight'  => array('In Weight', '', FALSE, '', TRUE),
    'alloy_weight' => array('', '', TRUE, '', TRUE),
    'wastage_weight' => array('', '', TRUE, '', TRUE),
    'pure_gold_weight' => array('', '', TRUE, '', TRUE),
    'lot_purity' => array('', '', TRUE, '', TRUE),
    'lot_purity' => array('', '', TRUE, '', TRUE),
    'alloy_vodatar'  => array('', '', TRUE, '', TRUE),
    'description'  => array('', '', TRUE, '', TRUE),
    'gross_weight'  => array('gross_weight', '', FALSE, '', TRUE),
    'required_weight'  => array('Required Weight', '', FALSE, '', TRUE),
    'required_alloy_weight'  => array('Required Alloy Weight', '', FALSE, '', TRUE),
  );
  $attributes['melting_lots'] = array(
    'id' => array('', '', TRUE, '', TRUE),
    'alloy_weight' => array('', '', TRUE, '', TRUE),
    'wastage_weight' => array('', '', TRUE, '', TRUE),
    'additional_alloy_weight' => array('', '', TRUE, '', TRUE),
    'alloy_vodatar'  => array('', '', TRUE, '', TRUE),
    'pure_gold_weight' => array('', '', TRUE, '', TRUE),
    'gross_weight'  => array('gross_weight', '', FALSE, '', TRUE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'melting_lots/melting_lots';
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'blue',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  $actions["Delete"] = array('request' => "http",
                               'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                               'class' => 'red',
                               'confirm_message' => "Do you want to delete",
                               'data_title' => "Delete",
                               'i_class' => 'far fa-trash-alt font20');
  return $actions;
}




