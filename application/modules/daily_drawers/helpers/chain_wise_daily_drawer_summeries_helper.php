<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function getTableSettings() {
  return  array(
    'page_title' => 'Chain Wise Daily Drawer Summery',
  );
}


function get_field_attribute($table, $field) {
  $attributes = array(
    'chain_name'      => array('Products : ', '', FALSE, '', TRUE),
  );

  return $attributes[$field];
}