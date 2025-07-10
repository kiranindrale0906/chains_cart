<?php 
	function list_array(){
		return array('ka_chain_worker_balance');
	}

	function getTableSettings(){
		return array();
	}
	function get_field_attribute($table, $field) {
	  $attributes = array();
	  $attributes = array(
	    'id' => array('', '', TRUE, '', TRUE),
	    'worker' => array('Worker', 'Select Worker', FALSE, '', TRUE),
	    );
	  return $attributes[$field];
	}
	
?>