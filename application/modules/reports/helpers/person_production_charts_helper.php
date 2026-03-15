<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title' => 'Person Production Charts',
  );
}

function get_field_attribute($table, $field) {
  $attributes = array(
    'from_date' => array('From date', '', FALSE, '', TRUE),
    'to_date'   => array('To date', '', FALSE, '', TRUE),
    'process_name'   => array('Process Name', '', FALSE, '', TRUE),
    'department_name'   => array('Department Name', '', FALSE, '', TRUE),
    'karigar_name'   => array('Karigar Name', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}
