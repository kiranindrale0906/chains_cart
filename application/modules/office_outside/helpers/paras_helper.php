<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function get_process_structures() {
	$process_name='office_outside_para';
  return array(
    'Melting Start' => start_structure($process_name),
    'Melting' => melting_structure($process_name),
    'Flatting'=> flatting_structure($process_name),
    'Pipe And Para Making'=> pipe_and_para_making_structure($process_name),
   );
 }

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}