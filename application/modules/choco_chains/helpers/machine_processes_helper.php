<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function get_process_structures() {
	$process_name='choco_chain_machine';
  return array( 
    // 'Start' => start_structure($process_name),
    'Chain Making'=> chain_making_structure($process_name));
}

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}