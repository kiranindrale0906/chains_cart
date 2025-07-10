<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  $show = (isset($_GET['show_all'])) ? $_GET['show_all'] : '';
  if($show=='yes') $where='orders.status=1';
  else $where='orders.status=0';
  return array(
    'page_title'          => 'Orders List',
    'primary_table'       => 'orders',
    'default_column'      => 'id',
    'table'               => 'orders',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => $where,
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'orders',
    'add_title'           => '',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
    'custom_table_header' => TRUE,
  );
}

function list_settings() {
  return array(
    array("Chain Order Id", "id", TRUE, "id", FALSE, TRUE,'CONCAT("#",id) as id'),
    array("Chain Name", "chain_name", FALSE, "chain_name", TRUE, TRUE),
    array("Category 1", "category_1_label", FALSE, "category_1_label", FALSE, TRUE),
    array("Category 2", "category_2_label", FALSE, "category_2_label", FALSE, TRUE),
    array("Category 3", "category_3_label", FALSE, "category_3_label", FALSE, TRUE),
    array("Category 4", "category_4_label", FALSE, "category_4_label", FALSE, TRUE),
    array("Category 5", "category_5_label", FALSE, "category_5_label", FALSE, TRUE),
    array("Created Date", "created_at", FALSE, "created_at", TRUE, TRUE),
    array("Weight", "weight", FALSE, "weight", FALSE, TRUE),
    array("Purity", "lot_purity", FALSE, "lot_purity", FALSE, TRUE),
    array("Melting Lot Id", "melting_lot_id", FALSE, "melting_lot_id", FALSE, FALSE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $chain_name = ucwords($row['chain_name']);
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'orders/orders/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  $actions["view"] = array('request' => "http",
                           'url' => ADMIN_PATH.'orders/orders/view/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'blue');
  $show = (isset($_GET['show_all'])) ? $_GET['show_all'] : '';
  if($show!='yes')
    $actions["Hide"] = array('request' => "http",
                             'url' => ADMIN_PATH.'orders/orders/update/'.$row['id'].'?from=view',
                             'confirm_message' => "",
                             'class' => 'red',
                             'data_title' =>'View',
                             'i_class'=>'fal fa-file-alt font20');
  if(empty($row['melting_lot_id'])){
    $actions["Add Melting Lot"] = array('request' => "http", 
                                       'url' => ADMIN_PATH.'melting_lots/melting_lots/create?process_name='.$chain_name.'&chain_order_id='.$row['id'],
                                       'confirm_message' => "",
                                       'class' => 'text-primary');
  }else{
    $actions["View Melting Lot"] = array('request' => "http", 
                                       'url' => ADMIN_PATH.'melting_lots/melting_lots/view/'.$row['melting_lot_id'],
                                       'confirm_message' => "",
                                       'class' => 'text-primary');
  }
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['orders'] = array(
    'id'                => array('', '', FALSE, '', FALSE),
    'chain_name'        => array('', '', TRUE, '', TRUE),
    'lot_purity'        => array('', '', TRUE, '', TRUE),
    'weight'            => array('Weight', 'Enter Weight', TRUE, '', TRUE),
    'category_1_label'  => array('', '', TRUE, '', TRUE),
    'category_2_label'  => array('', '', FALSE, '', TRUE),
    'category_3_label'  => array('', '', FALSE, '', TRUE),
    'category_4_label'  => array('', '', FALSE, '', TRUE),
    'category_5_label'  => array('', '', FALSE, '', TRUE),
    'category_6_label'  => array('', '', FALSE, '', TRUE),
  );

  $attributes['order_details'] = array(
    'id'          => array('', '', FALSE, '', FALSE),
    'order_id'    => array('', '', FALSE, '', TRUE),
    'label_name'  => array('', '', FALSE, '', TRUE),
    'value'       => array('', '', FALSE, '', TRUE),
  );
  return $attributes[$table][$field];
}