<?php if(!empty($selected_labels['category_6_label'])){ ?>
<hr><h5><?php echo 'Enter '.ucfirst($selected_labels['category_6_label']); ?></h5><hr>
  <div class="row">
<?php
  foreach ($order_details as $key => $value) { 
        load_field('text', array('field' => 'category_6_label',
                                 'index' => $key, 
                                 'readonly' => 'readonly',
                                 'label' => ucfirst($value['label_name']), 
                                 'value' => $value['value']));
  } 
}
?>       
</div>