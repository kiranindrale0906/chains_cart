<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'GPC Powder Internal',
    'primary_table'       => 'gpc_powder_internals',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'id asc',
    'group_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'gpc_powder_internals',
    'add_title'           => 'Add GPC Powder Internal',
    'export_title'        => '',
    'edit'                => '',
    'custom_table_header' => false,
    'select_column'       => false,
  );
}


function list_settings() {
  return array(
    array("Weight", "weight", TRUE, "weight", TRUE, TRUE, 'weight', 'weight', FALSE),
    array("Description", "description", TRUE, "description", TRUE, TRUE, 'description', 'description', FALSE),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['gpc_powder_internals'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'weight'            => array('Weight', 'Select Weight', TRUE, '', FALSE),
    'description'            => array('Description', 'Select Description', TRUE, '', FALSE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/gpc_powder_internals';
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  $actions["delete"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  return $actions;
}