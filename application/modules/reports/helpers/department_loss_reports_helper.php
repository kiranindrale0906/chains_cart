<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title'          => 'Department Loss Report',
    'primary_table'       => 'processes',
    'default_column'      => 'processes.id',
    'table'               => array('processes'),
    'join_conditions'     => array(),
    'join_type'           =>'',
    'where'               => 'lot_no!=""',
    'where_ids'           => '',
    'order_by'            => '',
    'group_by'            => 'processes.melting_lot_id',
    'limit'               => "50",
    'filter'              => ' ',
    'extra_select_column' => 'processes.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'lot_loss',
    'add_title'           => '',
    'export_title'        => '',
    'import_title'        => ''
  );
}


function get_field_attribute($table, $field) {
  $attributes = array(
    'id'              => array('', '', FALSE, '', TRUE),
    'date'       => array('Date', '', FALSE, '', TRUE),
    'to_date'         => array('To date', '', FALSE, '', TRUE),
   );

  return $attributes[$field];
}
function list_settings() {
  return array();
}