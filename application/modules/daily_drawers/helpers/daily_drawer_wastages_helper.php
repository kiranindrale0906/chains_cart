<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
   $show = (isset($_GET['show_all'])) ? $_GET['show_all'] : '';
  if($show=='yes') $where='product_name="Daily Drawer Wastage"';
  else $where='product_name="Daily Drawer Wastage" and archive=0';
  return  array(
    'page_title'          => 'Daily Drawer Wastages List',
    'primary_table'       => 'processes',
    'default_column'      => '',
    'table'               => 'processes',
    'table'               => ['processes','users'],
    'join_conditions'     => ['users.id=processes.created_by'],
    'where'               => $where,
    'where_ids'           => '',
    'order_by'            => 'processes.created_at desc',
    'limit'               => "20",
    'filter'              => ' ',
    'extra_select_column' => 'processes.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'daily_drawer_wastages',
    'add_title'           => 'Add Daily Drawer Wastage',
    'export_title'        => '',
    'import_title'        => '',
    'custom_table_header' => true
  );
}

function list_settings() {
  return array(
    array("Type", "type", TRUE, "type", TRUE, TRUE),
    array("Date", "processes.created_at", TRUE, "processes.created_at", FALSE, TRUE),
    array("Karigar", "karigar", TRUE, "karigar", TRUE, TRUE),
    array("Melting", "in_lot_purity", TRUE, "in_lot_purity", TRUE, TRUE,'FORMAT(in_lot_purity,4) as in_lot_purity'),
    array("Daily Drawer Wastage", "daily_drawer_wastage", TRUE, "daily_drawer_wastage", TRUE, TRUE,'daily_drawer_wastage','','',
          'range','daily_drawer_wastage',true),
    array("Chain Name", "chain_name", TRUE, "chain_name", TRUE, TRUE),
    array("Created by", "name", TRUE, "name", TRUE, TRUE, 'users.name name', 'users', FALSE,'autocomplete'),
    array("", "action", FALSE, "action", FALSE, FALSE));
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes = array(
    'id' => array('', '', TRUE, '', TRUE),
    'row_id' => array('', '', TRUE, '', TRUE),
    'type' => array('Type', '', FALSE, '', TRUE),
    'account' => array('Account', '', FALSE, '', TRUE),
    'chain_name' => array('Select Chain', 'Select', FALSE, '', TRUE),
    'in_weight' => array('Weight', 'Enter Weight', TRUE, '', TRUE),
    'process_name' => array('Process Name', '', FALSE, '', TRUE),
    'karigar' => array('Karigar', 'Enter Karigar', FALSE, '', TRUE),
    'in_lot_purity' => array('Melting', 'Select Melting', FALSE, '', TRUE),
  );
  return $attributes[$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/processes/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');
  $actions["Hide"] = array('request' => "http",
                           'url' => ADMIN_PATH.'processes/process_archives/update/'.$row['id'].'?from=view',
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                           'i_class'=>'fal fa-file-alt font20');
  
  return $actions;
}


