<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function get_process_structures() {
  $process_name='choco_chain_quality_process';
  return array(      
    // 'Start' => start_structure($process_name),
    'Hand Cutting' => hand_cutting_structure($process_name),
    'Hand Dull' => hand_dull_structure($process_name),
    'Buffing' => buffing_structure($process_name),
    'Hallmark Out' => hallmark_in_structure($process_name),
    'GPC Or Rodium' => gpc_structure($process_name));
    }

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}