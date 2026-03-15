<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function get_process_structures() {
	$process_name='choco_chain_combine_process';
  return array(
    'Melting Start' => start_structure($process_name),
    'Combine' => melting_structure($process_name));
}

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}