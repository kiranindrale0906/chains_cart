<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return  array(
    'page_title' => 'Daily Drawer Wastage Ledgers',
  );
}


function get_field_attribute($table, $field) {
  $attributes = array(
    'hook_kdm_purity'      => array('Purity:', 'Select Purity', FALSE, '', TRUE),
  );

  return $attributes[$field];
}