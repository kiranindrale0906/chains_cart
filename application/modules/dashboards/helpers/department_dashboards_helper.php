<?php 
	

	function getTableSettings(){
		return array();
	}
	function get_field_attribute($table, $field) {
	  $attributes = array();
	  $attributes = array(
	    'id' => array('', '', TRUE, '', TRUE),
	    'in_lot_purity' => array('Lot Purity', 'Select Lot Purity', FALSE, '', TRUE),
	    );
	  return $attributes[$field];
	}
	
?>