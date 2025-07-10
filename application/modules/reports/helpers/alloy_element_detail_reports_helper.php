<?php 
	function getTableSettings() {
  return array();
}
function get_field_attribute($table, $field) {
  $attributes = array(
    'id'              => array('', '', FALSE, '', TRUE),
    'company_name'       => array('Company Name', '', FALSE, '', TRUE),
    'alloy_name'       => array('Alloy Name', '', FALSE, '', TRUE),
    );

  return $attributes[$field];
}


?>