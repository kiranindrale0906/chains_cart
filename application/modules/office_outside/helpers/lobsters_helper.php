<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function get_process_structures() {
	$process_name='office_outside_lobster';
  return array(
    'Melting Start' => start_structure($process_name),
    'Buffing' => buffing_structure($process_name));
}


function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}