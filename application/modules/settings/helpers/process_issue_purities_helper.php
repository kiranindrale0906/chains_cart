<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Process Issue Purities',
    'primary_table'       => 'process_issue_purities',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'name asc',
    'group_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'process_issue_purities',
    'add_title'           => 'Add Process Issue Purity',
    'export_title'        => '',
    'edit'                => '',
    'custom_table_header' => false,
    'select_column'       => false,
  );
}


function list_settings() {
  return array(
    array("Process ID", "process_id", TRUE, "process_id", TRUE, TRUE, 'process_id', 'process_id', FALSE,'',''),
    array("Wastage", "wastage", TRUE, "wastage", TRUE, TRUE, 'wastage', 'wastage', FALSE,'',''),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['process_issue_purities'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'process_id'      => array('Process ID', 'Enter Process ID', TRUE, '', FALSE),
    'chitti_purity'      => array('Chitti PUrity', 'Enter Chitti Purity', TRUE, '', FALSE),
    'wastage'         => array('Wastage', 'Enter Wastage', TRUE, '', FALSE),
    'design_chitti_name'         => array('Design Name', 'Enter Design Name', TRUE, '', FALSE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'settings/process_issue_purities';
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