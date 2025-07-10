<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => '',
    'primary_table'       => '',
    'default_column'      => '',
    'table'               => '',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => '',
    'add_title'           => '',
    'export_title'        => '',
    'edit'                => '',
    'select_column'       => true,
    'arrange_column'      => true,
    'custom_table_header' => false,
    'clear_filter'        => true,
    'save_dashboard'      => false,
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
  $attributes['preview_emails'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'template_id'  => array('', '', FALSE, '', FALSE),
    'emailto'  => array('', 'Enter Email Id', TRUE, '', FALSE)  
  );
   return $attributes[$table][$field];
}