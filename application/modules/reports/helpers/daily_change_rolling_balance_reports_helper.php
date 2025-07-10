<?php 
function getTableSettings() {
  return array();
}
function get_field_attribute($table, $field) {
  $attributes = array(
    'chain_name'   => array('Chain name', 'Select', FALSE, '', TRUE),
     );

  return $attributes[$field];
}

?>