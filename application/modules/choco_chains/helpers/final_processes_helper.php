<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('get_field_attribute')) {
  function get_field_attribute($table, $field) {
    //print_r($table);print_r($field);
    return process_field_attributes($table, $field);
  }
}

function get_process_structures() {
  $process_name='choco_chain_final_process';
  return array(
     // 'Start' => start_structure($process_name),
    'Filing' => filing_structure($process_name),
    'Steel Vibrator'=> shampoo_and_steel_structure($process_name),
    'Hand Cutting' => hand_cutting_structure($process_name),
    'Hand Dull' => hand_dull_structure($process_name),
    'Buffing' => buffing_structure($process_name),
    'GPC' => gpc_structure($process_name));
}

