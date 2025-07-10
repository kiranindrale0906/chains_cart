<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}

function get_process_structures() {
	$process_name='hcl_melting_process';
  return array(
    // 'Start' => start_structure($process_name),
    'HCL Process' => hcl_process_structure($process_name),
    'Melting'=> melting_structure($process_name));
}

