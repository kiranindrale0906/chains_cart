<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function get_process_structures() {
	$process_name='office_outside_pipe_cutting';
  return array(
    // 'Melting Start' => start_structure($process_name),
    'CNC Department' => cnc_department_structure($process_name),
    'Round and Ball Chain Making'=> round_and_ball_chain_cutting_structure($process_name),
    'Final'=> final_structure($process_name));
}

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}