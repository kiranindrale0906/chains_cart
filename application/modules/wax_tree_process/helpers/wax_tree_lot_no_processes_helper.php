<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Wax Tree lot No Processes',
    'primary_table'       => 'wax_tree_process',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => 'lot_no!=""',
    'where_ids'           => '',
    'order_by'            => 'item_name asc',
    'group_by'            => 'lot_no',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'wax_tree_lot_no_process',
    'add_title'           => 'Add Wax tree lot no process',
    'export_title'        => '',
    'edit'                => '',
    'custom_table_header' => false,
    'select_column'       => false,
  );
}


function list_settings() {
  return array(
    array("Lot No", "lot_no", TRUE, "lot_no", TRUE, TRUE, 'lot_no', 'lot_no', FALSE,'',''),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['wax_tree_lot_no_processes'] = array(
    'id'              => array('ID', '', false, '', FALSE),
    'lot_no'            => array('Lot No', 'Enter Lot No', TRUE, '', FALSE),
  );$attributes['wax_tree_processes'] = array(
    'id'              => array('', '', false, '', FALSE),
    'wax_id'              => array('', '', false, '', FALSE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'wax_tree_process/wax_tree_lot_no_processes';
  $actions["View"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/view/'.$row['id'].'?lot_no='.$row['lot_no'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  return $actions;
}