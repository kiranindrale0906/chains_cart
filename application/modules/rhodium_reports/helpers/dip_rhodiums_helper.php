<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title' => 'Dip Report',
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
