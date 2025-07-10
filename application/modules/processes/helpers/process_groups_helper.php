<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return array('page_title' => 'Flatting Process');
}

function list_settings() {
  return array();
}
function get_process_structures() {
  return array();
}
function get_field_attribute($table, $field) {
  $attributes = array();
  $attributes= array(
    'id' => array('', '', FALSE, '', FALSE),
    'lots' => array('', '', FALSE, '', FALSE),
    'product_name' => array('Product Name', '', FALSE, '', TRUE),
    'melting_lot_id' => array('Lot No', 'Select Lots', TRUE, '', TRUE),
    'parent_lot_id' => array('', '', TRUE, '', TRUE),
    'parent_lot_name' => array('', '', TRUE, '', TRUE),
    'process_id' => array('', '', TRUE, '', TRUE),
    'process_name' => array('', '', TRUE, '', TRUE),
    );
    
  return $attributes[$field];
}