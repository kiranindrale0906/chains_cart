<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function get_process_structures() {
  $process_name='refresh_internal_gpc_process';
  return array(
    'Cleaning'=> cleaning_structure($process_name),
    'Buffing'=> buffing_structure($process_name),
    'Steel Vibrator'=> steel_vibrator_structure($process_name),
    'GPC'=> gpc_structure($process_name),
    );
}

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}
