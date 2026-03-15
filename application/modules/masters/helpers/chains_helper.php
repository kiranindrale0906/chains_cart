<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Chains',
    'primary_table'       => 'chains',
    'default_column'      => 'id',
    'table'               => 'chains',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => '',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'chains',
    'add_title'           => 'Add Chains',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Name", "name", FALSE, "name", FALSE, TRUE),
    array("Category 1 label", "category_1_label", FALSE, "category_1_label", FALSE, TRUE),
    array("Category 2 label", "category_2_label", FALSE, "category_2_label", FALSE, TRUE),
    array("Category 3 label", "category_3_label", FALSE, "category_3_label", FALSE, TRUE),
    array("Category 4 label", "category_4_label", FALSE, "category_4_label", FALSE, TRUE),
    array("Category 5 label", "category_5_label", FALSE, "category_5_label", FALSE, TRUE),
    array("Category 6 label", "category_6_label", FALSE, "category_6_label", FALSE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/chains/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  $actions["Add order"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'orders/orders/create?chain_name='.$row['name'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['chains'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'name'  => array('Name', 'Name', TRUE, '', TRUE),
    'category_1_label'  => array('Category 1 Label', 'Category 1 Label', FALSE, '', TRUE),
    'category_2_label'  => array('Category 2 Label', 'Category 2 Label', FALSE, '', TRUE),
    'category_3_label'  => array('Category 3 Label', 'Category 3 Label', FALSE, '', TRUE),
    'category_4_label'  => array('Category 4 Label', 'Category 4 Label', FALSE, '', TRUE),
    'category_5_label'  => array('Category 5 Label', 'Category 5 Label', FALSE, '', TRUE),
    'category_6_label'  => array('Category 6 Label', 'Category 6 Label', FALSE, '', TRUE),
  );
  return $attributes[$table][$field];
}