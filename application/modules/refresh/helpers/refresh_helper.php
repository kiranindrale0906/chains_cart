<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('get_field_attribute')) {
	function get_field_attribute($table, $field) {
	  return process_field_attributes($table, $field);
	}
}

function get_process_structures() {
	$process_name = 'refresh';
  if(HOST=='ARC' || HOST=='ARF'){
    return array(
    // 'Start'             => start_structure($process_name),
    'Refresh-Repairing' => refresh_repairing_structure($process_name),
    'Buffing' => buffing_structure($process_name),
    'Hallmark Out' => hallmark_in_structure($process_name),
    'GPC'               => gpc_structure($process_name),
    'Factory Hold'      => factory_hold_structure($process_name)
  );
  }else{

  return array(
    // 'Start'             => start_structure($process_name),
    'Refresh-Repairing' => refresh_repairing_structure($process_name),
    'Buffing' => buffing_structure($process_name),
    'Hallmark Out' => hallmark_in_structure($process_name),
    'GPC'               => gpc_structure($process_name),
    'Factory Hold'      => factory_hold_structure($process_name)
  );
  }
}

