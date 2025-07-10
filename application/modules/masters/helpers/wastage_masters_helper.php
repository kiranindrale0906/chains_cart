<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return array(
    'page_title'          => 'Wastage Masters',
    'primary_table'       => 'wastage_masters',
    'default_column'      => 'id',
    'table'               => 'wastage_masters',
    'join_columns'        => '',
    'join_type'           => '',
    'where'               => '',
    'where_ids'           => '',
    'order_by'            => 'product_name',
    'limit'               => "20",
    'extra_select_column' => 'id',
    'actionFunction'      => '',
    'headingFunction'     => 'list_settings',
    'search_url'          => 'wastage_masters',
    'add_title'           => 'Add Wastage',
    'export_title'        => '',
    'edit'                => '',
    'clear_filter'        => true,
  );
}

function list_settings() {
  return array(
    array("Product Name", "product_name", TRUE, "product_name", TRUE, TRUE),
    array("Priority", "priority", TRUE, "priority", TRUE, TRUE),
    array("Category one", "category_one", TRUE, "category_one", TRUE, TRUE),
    array("Tone", "tone", TRUE, "tone", TRUE, TRUE),
    array("Purity", "out_lot_purity", TRUE, "out_lot_purity", TRUE, TRUE),
    array("Machine Size", "machine_size", TRUE, "machine_size", TRUE, TRUE),
    array("Design Name", "design_name", TRUE, "design_name", TRUE, TRUE),
    array("Wastage", "wastage", TRUE, "wastage", TRUE, TRUE),
    array("", "action", FALSE, "action", FALSE, FALSE),
  );
}

function get_row_actions($row, $url, $select_url, $filter) {
  $actions = array();
  $actions["edit"] = array('request' => "http", 
                           'url' => ADMIN_PATH.'masters/wastage_masters/edit/'.$row['id'],
                           'confirm_message' => "",
                           'class' => 'text-primary');
  $actions["delete"] = array('request' => "js",
                             'url' => ADMIN_PATH.'masters/wastage_masters/delete/'.$row['id'],
                             'confirm_message' => "Do you want to delete",
                             'js_function' => "",
                             'class' => 'text-danger');

  return $actions;
}

function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes['wastage_masters'] = array(
    'id' => array('', '', FALSE, '', FALSE),
    'product_name'  => array('Product Name', 'Enter Product Name', TRUE, '', TRUE),
    'priority'  => array('Priority', 'Enter Priority', TRUE, '', TRUE),
    'category_one'  => array('Category One', 'Enter Category One', TRUE, '', TRUE),
    'tone'  => array('Tone', 'Enter Tone', TRUE, '', TRUE),
    'out_lot_purity'  => array('Purity', 'Enter Purity', TRUE, '', TRUE),
    'machine_size'  => array('Machine Size', 'Enter Machine Size', TRUE, '', TRUE),
    'design_name'  => array('Design Name', 'Enter Design Name', TRUE, '', TRUE),
    'wastage'  => array('Wastage', 'Enter Wastage', FALSE, '', TRUE),
     );
  return $attributes[$table][$field];
}
