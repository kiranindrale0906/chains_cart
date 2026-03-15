<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function get_field_attribute($table, $field) {
  return process_field_attributes($table, $field);
}

function get_process_structures() {
    return array(
      'Refine Melting' => melting_structure('melting_wastage_refine_out_process')
    );
}
