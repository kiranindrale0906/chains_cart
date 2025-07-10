<?php

 function greater_than_equal_to_0_validation($field, $label = '', $value = 0) {
    if (empty($label)) $label = strtoupper(str_replace('_', ' ', $field));
    return array('field' => $field, 'label' => $label,
                 'rules' => array('trim', 'numeric', 'greater_than_equal_to['.$value.']'));
  }

  function numeric_validation($field, $label = '') {
    if (empty($label)) $label = strtoupper(str_replace('_', ' ', $field));
    return array('field' => $field, 'label' => $label,
                 'rules' => array('trim', 'numeric'));
  }

  function required_validation($field, $label = '') {
    if (empty($label)) $label = strtoupper(str_replace('_', ' ', $field));
    return array('field' => $field, 'label' => $label,
                 'rules' => array('trim', 'required'));
  }


?>