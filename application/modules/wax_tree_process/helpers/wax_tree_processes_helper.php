<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Wax Tree Processes',
    'primary_table'       => 'wax_tree_process',
    'default_column'      => 'id',
    'table'               => '',
    'join_conditions'     => '',
    'join_type'           => '',
    'where'               => 'status="Pending"',
    'where_ids'           => '',
    'order_by'            => 'id desc',
    'group_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'wax_tree_process',
    'add_title'           => 'Add Wax tree process',
    'export_title'        => '',
    'edit'                => '',
    'custom_table_header' => true,
    'select_column'       => false,
  );
}


function list_settings() {
  return array(
    array("Date", "updated_at", TRUE, "updated_at", TRUE, TRUE, 'updated_at', 'updated_at', FALSE,'',''),
    array("Tree Number", "id", TRUE, "id", TRUE, TRUE, 'id', 'id', FALSE,'',''),
    array("Type", "type", TRUE, "type", TRUE, TRUE, 'type', 'type', FALSE,'',''),
    array("Item Name", "item_name", TRUE, "item_name", TRUE, TRUE, 'item_name', 'item_name', FALSE,'',''),
    array("Tone", "tone", TRUE, "tone", TRUE, TRUE, 'tone', 'tone', FALSE,'',''),
    array("Melting", "melting", TRUE, "melting", TRUE, TRUE, 'melting', 'melting', FALSE,'',''),
    array("Tree Gross Wt", "tree_gross_wt", TRUE, "tree_gross_wt", TRUE, TRUE, 'tree_gross_wt', 'tree_gross_wt', FALSE,'',''),
    array("Tree Base Wt", "tree_base_wt", TRUE, "tree_base_wt", TRUE, TRUE, 'tree_base_wt', 'tree_base_wt', FALSE,'',''),
    array("Stone Wt", "stone_wt", TRUE, "stone_wt", TRUE, TRUE, 'stone_wt', 'stone_wt', FALSE,'',''),
    array("Tree Net Wt", "tree_net_wt", TRUE, "tree_net_wt", TRUE, TRUE, 'tree_net_wt', 'tree_net_wt', FALSE,'',''),
    array("Gold Ratio", "gold_ratio", TRUE, "gold_ratio", TRUE, TRUE, 'gold_ratio', 'gold_ratio', FALSE,'',''),
    array("Total Required Gold", "total_required_gold", TRUE, "total_required_gold", TRUE, TRUE, 'total_required_gold', 'total_required_gold', FALSE,'',''),
    array("Lot No", "lot_no", TRUE, "lot_no", TRUE, TRUE, 'lot_no', 'lot_no', FALSE,'',''),
    array("Status", "status", TRUE, "status", TRUE, TRUE, 'status', 'status', FALSE,'',''),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes['wax_tree_processes'] = array(
    'id'              => array('Wax Tree No.', '', false, '', FALSE),
    'type'            => array('Type', 'Select Type', TRUE, '', FALSE),
    'item_name'       => array('Item Name', 'Enter Item Name', TRUE, '', FALSE),
    'tone'         => array('Tone', 'Enter Tone', TRUE, '', FALSE),
    'melting'         => array('Melting', 'Enter Melting', TRUE, '', FALSE),
    'tree_gross_wt'   => array('Tree Gross Wt', 'Enter Tree Gross Wt', TRUE, '', FALSE),
    'tree_base_wt'    => array('Tree Base Wt', 'Enter Tree Base Wt', TRUE, '', FALSE),
    'tree_net_wt'    => array('Tree Net Wt', 'Enter Tree Net Wt', FALSE, '', FALSE),
    'total_required_gold'    => array('Total Required Gold', 'Enter Total Required Gold', FALSE, '', FALSE),
    'stone_wt'        => array('Stone Wt', 'Enter Stone Wt', TRUE, '', FALSE),
    'gold_ratio'      => array('Gold Ratio', 'Enter Gold Ratio', TRUE, '', FALSE),

  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'wax_tree_process/wax_tree_processes';
  $actions["Add Lot No"] = array('request' => "http",
                           'url' => ADMIN_PATH.'wax_tree_process/wax_tree_lot_no_processes/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'blue',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');
  $actions["Edit"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'green',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  $actions["Delete"] = array('request' => "http",
                           'url' => ADMIN_PATH.$controller.'/delete/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'red',
                           'data_title' =>'View',
                            'i_class'=>'fal fa-file-alt font20');

  return $actions;
}