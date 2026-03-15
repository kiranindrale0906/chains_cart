<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('str_replace_space_dash_dot')) {
  function str_replace_space_dash_dot($str, $value='_', $strtolower = TRUE){
    $str = str_replace(' ', $value, $str);
    $str = str_replace('-', $value, $str);
    $str = str_replace('.', $value, $str);
    $str = str_replace(',', $value, $str);
    $str = str_replace('+', $value, $str);
    if ($strtolower) $str = strtolower($str);
    return $str;
  }
}
if (!function_exists('str_replace_underscore')) {
  function str_replace_underscore($str, $value=' ', $ucwords = TRUE){
    $str = str_replace('_', $value, $str);
    if ($ucwords) $str = ucwords($str);
    return $str;
  }
}
