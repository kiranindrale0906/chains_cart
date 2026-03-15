<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}

function get_process_structures() {
if(HOST == 'ARF' || HOST == 'ARC'){
  return array(
    // 'Start' => start_structure('daily_drawer_melting_process'),
    'Daily Drawer Wastage' => melting_structure('daily_drawer_melting_process'));
 }else{
  return array(
    // 'Start' => start_structure('daily_drawer_melting_process'),
    'Melting' => melting_structure('daily_drawer_melting_process'));
 }
 
}
