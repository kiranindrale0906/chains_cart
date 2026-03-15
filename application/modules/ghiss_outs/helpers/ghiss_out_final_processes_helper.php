<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}

function get_process_structures() {
  return array(
    //'Start' => start_structure('ghiss_out_process'),
    'Ghiss Melting' => melting_structure('ghiss_out_final_process'),
  );
}
