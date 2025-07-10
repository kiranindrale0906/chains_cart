<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if ( ! function_exists('four_decimal')) {
  function four_decimal($value, $zero_value='0'){
    if ($value == 0)
      return $zero_value;
    else
      return number_format((float)$value, 4, '.', '');
  }
}

if ( ! function_exists('two_decimal')) {
  function two_decimal($value, $zero_value='-'){
    if ($value == 0)
      return $zero_value;
    else
      return number_format((float)$value, 2, '.', '');
  }
}
 
 if ( ! function_exists('three_decimal')) {
  function three_decimal($value){
     return number_format((float)$value, 3, '.', '');
  }
}
 
