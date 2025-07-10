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
    'extra_select_column' => '',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => '',
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
  
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['preview_pushnotifications'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'template_id'  => array('', '', FALSE, '', FALSE),
    'user_id'  => array('', '', TRUE, '', FALSE)  
  );
   return $attributes[$table][$field];
}
