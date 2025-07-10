<?php
foreach ($selected_labels as $key => $value) { 
  if((!empty($value)) && ($key == 'category_6_label')){
    foreach ($category_6 as $key => $value) {
      load_field('hidden', array('field' => 'id',
                                 'index' => $key,
                                 'controller' => 'order_details'));

      load_field('hidden', array('field' => 'label_name', 
                                 'index' => $key, 
                                 'value' => $value['name'],
                                 'controller' => 'order_details'));

      load_field('text', array('field' => 'value',
                               'index' => $key, 
                               'label' => ucfirst($value['name']), 
                               'controller' => 'order_details'));
    }
  }
} 
?>       