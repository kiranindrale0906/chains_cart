<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Melting Processes',
    'primary_table'       => 'melting_processes',
    'default_column'      => 'id',
    'table'               => 'melting_processes',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'melting_processes',
    'add_title'           => 'Add Melting Processes',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Process Name ", "process_name", FALSE, "process_name", FALSE, TRUE),
    array("Colour", "colour", TRUE, "colour", TRUE, TRUE),
    array("Purity ", "purity ", FALSE, "purity ", FALSE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/melting_processes/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['melting_processes'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'colour'  => array('Colour', 'Select', TRUE, '', TRUE),
    'purity'  => array('Purity', 'Select Purity', TRUE, '', TRUE),
    'process_name'  => array('Process Name', 'Process Name', TRUE, '', TRUE),
  );
  return $attributes[$table][$field];
}