<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function get_process_structures() {
  $process_name='choco_chain_rnd_process';
  return array(
    'Melting Start' => final_process_start_structure($process_name),
    'Filing' => filing_structure($process_name),
    'Lobster'=> lobster_out_structure($process_name),
    'Hand Cutting' => hand_cutting_structure($process_name),
    'Hand Dull' => hand_dull_structure($process_name),
    'Buffing' => buffing_structure($process_name),
    'Hallmark Out' => hallmark_in_structure($process_name),
    'GPC'=> gpc_structure($process_name),
    'Quality' => quality_structure($process_name),
    'Hallmarking' => hallmarking_structure($process_name));
}

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}