<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function getTableSettings() {
  return  array(
    'page_title'          => 'Stock Summary Report',
  );
}

function get_field_attribute($table, $field) {
  $attributes = array(
    'id'            => array('', '', FALSE, '', TRUE),
    'start_date'       => array('Start date', '', FALSE, '', TRUE),
    'end_date'          => array('End date', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}
