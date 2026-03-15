<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function get_process_structures() {
	$process_name='arc_melting_common';
  return array(
    'Melting Start' => start_structure($process_name),
    'Melting' => melting_structure($process_name)
    );
}