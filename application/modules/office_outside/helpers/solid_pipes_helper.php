<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function get_process_structures() {
	$process_name='office_outside_solid_pipe';
  return array(
    'Melting Start' => start_structure($process_name),
    'Melting' => melting_structure($process_name),
    'Flatting'=> flatting_structure($process_name),
    'Pipe Making' => pipe_making_structure($process_name),
    // 'Diamond Cutting' => cutting_structure('solid_pipe'),
    'Hand Cutting' => cutting_structure($process_name),
    );
}

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}