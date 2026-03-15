<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array(
    'page_title'          => 'Choco chain order List',
    'primary_table'       => 'choco_chain_orders',
    'default_column'      => 'id',
    'table'               => ['choco_chain_orders','choco_chain_bom_settings'],
    'join_conditions'     => ['choco_chain_orders.choco_chain_bom_setting_id = choco_chain_bom_settings.id'],
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'choco_chain_orders.id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'choco_chain_orders',
    'add_title'           => 'Add Choco Chain Order',
    'export_title'        => 'Export',
    'edit'                => '',
    'select_column'       => true,
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
  return array(
    array("Order ID", "order_id", TRUE, "id", TRUE, TRUE, 'CONCAT("ORD-",choco_chain_orders.id) as order_id', 'choco_chain_orders', FALSE,'autocomplete',''),
    array("Type", "type", TRUE, "type", TRUE, TRUE, 'type', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','type')),
    array("Chain", "chain", TRUE, "chain", TRUE, TRUE, 'chain', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','chain')),
    array("Melting", "melting", TRUE, "melting", TRUE, TRUE, 'melting', 'choco_chain_bom_settings', FALSE,'autocomplete',array('choco_chain_bom_settings','melting')),
    array("8\" Qty", "8_order_qty", TRUE, "8_order_qty", TRUE, TRUE, '8_order_qty', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','qty_8')),
    array("16\" Qty", "16_order_qty", TRUE, "16_order_qty", TRUE, TRUE, '16_order_qty', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','16_order_qty')),
    array("18\" Qty", "18_order_qty", TRUE, "18_order_qty", TRUE, TRUE, '18_order_qty', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','18_order_qty')),
    array("20\" Qty", "20_order_qty", TRUE, "20_order_qty", TRUE, TRUE, '20_order_qty', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','20_order_qty')),
    array("22\" Qty", "22_order_qty", TRUE, "22_order_qty", TRUE, TRUE, '22_order_qty', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','22_order_qty')),
    array("24\" Qty", "24_order_qty", TRUE, "24_order_qty", TRUE, TRUE, '24_order_qty', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','24_order_qty')),
    array("26\" Qty", "26_order_qty", TRUE, "26_order_qty", TRUE, TRUE, '26_order_qty', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','26_order_qty')),
    array("Custom length 1", "custom_1_length", TRUE, "custom_1_length", TRUE, TRUE, 'custom_1_length', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','custom_1_length')),
    array("Custom Qty 1", "custom_1_order_qty", TRUE, "custom_1_order_qty", TRUE, TRUE, 'custom_1_order_qty', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','custom_1_order_qty')),
    array("Custom length 2", "custom_2_length", TRUE, "custom_2_length", TRUE, TRUE, 'custom_2_length', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','custom_2_length')),
    array("Custom Qty 2", "custom_2_order_qty", TRUE, "custom_2_order_qty", TRUE, TRUE, 'custom_2_order_qty', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','custom_2_order_qty')),
    array("Tone", "tone", TRUE, "tone", TRUE, TRUE, 'tone', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','tone')),
    array("Order status", "status", TRUE, "status", TRUE, TRUE, 'status', 'choco_chain_orders', FALSE,'autocomplete',array('choco_chain_orders','status')),
    array("Action", "action", FALSE, "action", FALSE, FALSE),
  );
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

  $attributes['choco_chain_orders'] = array(
    'id'                 => array('ID', '', false, '', FALSE),
    '8_order_qty'        => array('8" quantity', 'Enter 8&quot; quantity', FALSE, '', FALSE),
    '16_order_qty'       => array('16" quantity', 'Enter 16&quot; quantity', FALSE, '', FALSE),
    '18_order_qty'       => array('18" quantity', 'Enter 18&quot; quantity', FALSE, '', FALSE),
    '20_order_qty'       => array('20" quantity', 'Enter 20&quot; quantity', FALSE, '', FALSE),
    '22_order_qty'       => array('22" quantity', 'Enter 22&quot; quantity', FALSE, '', FALSE),
    '24_order_qty'       => array('24" quantity', 'Enter 24&quot; quantity', FALSE, '', FALSE),
    '26_order_qty'       => array('26" quantity', 'Enter 26&quot; quantity', FALSE, '', FALSE),
    'custom_1_length'    => array('Custom length 1', 'Enter Custom length 1', FALSE, '', FALSE),
    'custom_1_order_qty' => array('Custom quantity 1', 'Enter Custom quantity 1', FALSE, '', FALSE),
    'custom_2_length'    => array('Custom length 2', 'Enter Custom length 2', FALSE, '', FALSE),
    'custom_2_order_qty' => array('Custom quantity 2', 'Enter Custom quantity 2', FALSE, '', FALSE),
    'tone'               => array('Tone', 'Enter Tone', TRUE, '', FALSE),
    'status'             => array('Order status', 'Select order status', TRUE, '', FALSE),
  );
 
  $attributes['choco_chain_bom_settings'] = array(
    'type'       => array('Type', 'Select Type', TRUE, '', FALSE),
    'chain'      => array('Chain', 'Select Chain', TRUE, '', FALSE),
    'melting'    => array('Melting', 'Select Melting', TRUE, '', TRUE),
  );
  return $attributes[$table][$field];
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $controller = 'choco_chains/choco_chain_orders';
  $actions["View"] = array('request' => "http", 
                           'url' => ADMIN_PATH.$controller.'/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn-sm btn_green');
  $actions["Edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.$controller.'/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'btn-sm btn_green');
  if($row['status'] == 'OPEN') {
    $actions["Close"] = array('request' => "ajax_post", 
                              'url' => ADMIN_PATH.$controller.'/update/'.$row['id'],
                              'post_data' => array('choco_chain_orders[id]' => $row['id'],
                                                   'choco_chain_orders[status]' => 'CLOSED',
                                                   'submittype' => 'json'),
                              'class' => ' btn_green',
                              'success_function' => '');
  } else {
    $actions["Open"] = array('request' => "ajax_post", 
                             'url' => ADMIN_PATH.$controller.'/update/'.$row['id'],
                             'post_data' => array('choco_chain_orders[id]' => $row['id'],
                                                  'choco_chain_orders[status]' => 'OPEN',
                                                  'submittype' => 'json'),
                             'class' => ' btn_green',
                             'success_function' => '');
  }
  return $actions;
}