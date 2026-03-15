<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('get_field_attribute')) {
	function get_field_attribute($table, $field) {
	  return process_field_attributes($table, $field);
	}
}

function get_process_structures() {
	$process_name='refresh_hold';
  return array(
    // 'Start' => start_structure($process_name),
    'Refresh Hold'=>refresh_hold_structure($process_name),
    );
}

