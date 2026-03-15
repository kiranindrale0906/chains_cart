<?php 
	function list_array(){
		return array('ka_chain_karigar_balance');
	}

	function getTableSettings(){
		return array();
	}
	function get_field_attribute($table, $field) {
	  $attributes = array();
	  $attributes = array(
	    'id' => array('', '', TRUE, '', TRUE),
	    'karigar' => array('Karigar', 'Select Karigar', FALSE, '', TRUE),
	    );
	  return $attributes[$field];
	}
	
?>