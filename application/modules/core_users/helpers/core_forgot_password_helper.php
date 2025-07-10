<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function coreforgortpassword_get_field_attribute($table, $field) {
  $attributes = array();

  $attributes = array(
    'email'  => array('User Email ID ', 'Enter Email ID', TRUE, '', TRUE),
  );
  return $attributes[$field];
}
