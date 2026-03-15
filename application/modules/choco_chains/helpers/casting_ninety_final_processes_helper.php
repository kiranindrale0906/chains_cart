<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function get_process_structures() {
  $process_name='choco_chain_casting_ninety_process';
  return array(      
    // 'Start' => start_structure($process_name),
    'Filing' => filing_structure($process_name),
    'Walnut'=> walnut_shampoo_structure($process_name),
    'Lobster'=> lobster_out_structure($process_name),
    'Steel Vibrator II'=> shampoo_and_steel_structure($process_name),
    'Buffing' => buffing_structure($process_name),
    'Hand Cutting' => hand_cutting_structure($process_name),
    'Hand Dull' => hand_dull_structure($process_name),
    'Buffing II' => buffing_two_structure($process_name),
    'GPC Or Rodium' => gpc_structure($process_name));
}

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}