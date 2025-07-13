<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('get_field_attribute')) {
	function get_field_attribute($table, $field) {
	  return process_field_attributes($table, $field);
	}
}

function get_process_structures() {
	$process_name='rope_chain_melting_process';
  return array(
    'Melting Start' => start_structure($process_name),
    'Melting'=> melting_structure($process_name),
    'Tounch Hold Department'=> tounch_hold_department_structure($process_name),
    'Tounch Department'=> tounch_department_structure($process_name),
    'Flatting Hold'=> flatting_hold_structure($process_name),
    'Flatting'=> flatting_structure($process_name),
	  'Stripping Hold'=> stripping_hold_structure($process_name),
	  'Stripping'=> stripping_structure($process_name),
	  'Tube Forming Hold'=> tube_forming_hold_structure($process_name),
	  'Tube Forming'=> tube_forming_structure($process_name),
	  'Bull Block Hold'=> bull_block_hold_structure($process_name),
    'Bull Block'=> bull_block_structure($process_name),
  	'Wire Making Hold'=> wire_making_hold_structure($process_name),
    'Wire Making'=> wire_making_structure($process_name),
  );
}

