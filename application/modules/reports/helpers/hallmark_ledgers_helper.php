<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return  array(
    'page_title' => 'Hallmark Ledgers',
  );
}
function get_field_attribute($table, $field) {
  $attributes = array();

  $attributes = array(
    'id'           => array('ID', '', false, '', FALSE),
    'purity' => array('Purity', 'Select purity', TRUE, '', FALSE),
    'karigar' => array('Karigar', 'Select Karigar', TRUE, '', FALSE),
     );
  return $attributes[$field];
}

