<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title' => 'Hook and Lock Report',
  );
}


function get_field_attribute($table, $field) {
  $attributes = array(
    'process'   => array('Process', 'Select', FALSE, '', TRUE),
    'melting'   => array('Melting', 'Select', FALSE, '', TRUE),
    'from_date' => array('From date', '', FALSE, '', TRUE),
    'to_date'   => array('To date', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}

function get_processes_with_orders() {
  return array(
    // 'All',
    'Rope Chain', 'Machine Chain', 'Round Box Chain', 'Choco Chain');
}

function get_chain_order_processes_dropdown() {
  return generate_dropdown(get_processes_with_orders());
}

function get_meltings() {
  return array('All', '92', '83', '75');
}

function get_meltings_dropdown() {
  return generate_dropdown(get_meltings());
}

function get_chain_order_report_data() {
  return array(
    'Rope Chain' => array(
      'bom_fields' => array('varient'),
    ),
    'Machine Chain' => array(
      'bom_fields' => array('size as varient'),
    ),
    'Round Box Chain' => array(
      'bom_fields' => array('chain_name as varient'),
    ),
    'Choco Chain' => array(
      'bom_fields' => array('chain as varient'),
    ),
  );
}