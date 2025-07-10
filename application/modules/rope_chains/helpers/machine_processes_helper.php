<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('get_field_attribute')) {
	function get_field_attribute($table, $field) {
	  return process_field_attributes($table, $field);
	}
}

function get_process_structures() {
	$process_name='rope_chain_machine_process';
  return array(
    'Machine Department'=> machine_department_structure($process_name),
    'Hook'=> hook_structure($process_name),
    'Drum'=> drum_structure($process_name),
    'HCL'=> hcl_structure($process_name),
    'Hook I'=> hook_i_structure($process_name),
    'Drum I'=> drum_i_structure($process_name));
}

