<?php

function negative_checks() {
  $function_array = [];
  foreach (get_non_negative_process_fields() as $index => $field) 
    $function_array[] = negative_process_field_check($field, $index);

  foreach (get_non_negative_process_detail_fields() as $index => $field) 
    $function_array[] = negative_process_detail_field_check($field, $index);
  return $function_array;
}

function get_non_negative_process_fields() {
  return array( 'daily_drawer_wastage', 'out_daily_drawer_wastage', 'issue_daily_drawer_wastage', 'balance_daily_drawer_wastage',
                'melting_wastage', 'in_melting_wastage', 'out_melting_wastage', 'issue_melting_wastage', 'balance_melting_wastage', 'out_opening_melting_wastage',
                'ghiss',  'out_ghiss', 'issue_ghiss', 'balance_ghiss',
                'pending_ghiss', 'out_pending_ghiss', 'balance_pending_ghiss',
                'tounch_ghiss', 'out_tounch_ghiss', 'balance_tounch_ghiss',
                'tounch_in', 'tounch_out', 'out_tounch_out', 'balance_tounch_out',
                'fire_tounch_in', 'fire_tounch_out', 'out_fire_tounch_out', 'balance_fire_tounch_out',
                'hcl_wastage', 'out_hcl_wastage', 'balance_hcl_wastage',
                'hcl_ghiss', 'out_hcl_ghiss', 'balance_hcl_ghiss',
                'solder_wastage', 'out_solder_wastage', 'balance_solder_wastage',

                'fe_in', 'fe_out', 'wastage_fe',
                'solder_in',
                'hook_in', 'hook_out', 'daily_drawer_in_weight', 'daily_drawer_out_weight',
                'micro_coating',
                'alloy_weight', 'out_alloy_weight',
                'in_plain_rod', 'in_rod', 'out_rod', 'out_machine_gold',
                'copper_in', 'copper_out',
                'stone_vatav', 'out_stone_vatav', 
                'liquor_in', 'liquor_out',
                'gemstone_in', 'gemstone_out',

                'expected_out_weight',

                'in_weight', 'out_weight', 'bounch_out', 'factory_out', 'customer_out', 'recutting_out', 'repair_out',
                'gpc_out', 'issue_gpc_out', 'balance_gpc_out',
                'balance', 'balance_gross', 'balance_fine'
              );  //closing_out
}

function get_non_negative_process_detail_fields() {
  return array( 'daily_drawer_wastage', 
                'melting_wastage', 'in_melting_wastage',
                'hcl_wastage',
                'fe_in',
                'ghiss', 'hcl_ghiss', 
                'hook_in', 'hook_out', 'daily_drawer_in_weight', 'daily_drawer_out_weight',
                'tounch_in',
                'gemstone_in', 'gemstone_out',
                'pending_ghiss',
                'out_weight', 'customer_out', 'factory_out', 'recutting_out',
                'fire_tounch_in',
                'in_rod', 'gpc_out'
              ); //, 'bounch_out'
}

function negative_process_field_check($field, $index) {
  return array('srno'  => 'NEGP'.$index,
               'title' => 'Negative '.str_replace('_', ' ', $field),
               'A'     => 'select sum('.$field.') as weight from processes where '.$field.' < 0;',
               'query' => 'select id, product_name, process_name, department_name, id as url, '.$field.'
                                  from processes 
                                  where '.$field.' < 0');
}

function negative_process_detail_field_check($field, $index) {
  return array('srno'  => 'NEGPD'.$index,
               'title' => 'Negative (process details) '.str_replace('_', ' ', $field),
               'A'     => 'select sum('.$field.') as weight from process_details where '.$field.' < 0;',
               'query' => 'select processes.id, processes.product_name, processes.process_name, processes.department_name, processes.id as url, process_details.'.$field.'
                                  from process_details inner join processes on processes.id = process_details.process_id
                                  where process_details.'.$field.' < 0');
}