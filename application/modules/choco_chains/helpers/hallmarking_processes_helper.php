<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('get_field_attribute')) {
  function get_field_attribute($table, $field) {
    //print_r($table);print_r($field);
    return process_field_attributes($table, $field);
  }
}

function get_process_structures() {
  $process_name='choco_chain_hallmarking_process';
  return array(
    'Hallmarking' => hallmarking_structure($process_name),
    'GPC' => gpc_structure($process_name)
    // 'Start' => start_structure($process_name),
    /*'Steel Vibrator' => polish_structure($process_name),
    'Buffing' => buffing_structure($process_name),
    'GPC' => gpc_structure($process_name),
    'Quality' => quality_structure($process_name),*/
    );
}

