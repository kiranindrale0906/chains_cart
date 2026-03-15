<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}

function get_process_structures() {
  if (HOST=='AR Gold')
    return array(
      // 'Start' => start_structure('ghiss_out_process'),
      'Ghiss Melting' => melting_structure('ghiss_out_process'),
      'Melting II' => melting_ii_structure('ghiss_out_process')
    );
  else
    return array(
      // 'Start' => start_structure('ghiss_out_process'),
      'Ghiss Melting' => melting_structure('ghiss_out_process')
    );
}
