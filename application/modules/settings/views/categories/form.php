<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>

    <?php 
      load_field('dropdown', array('field' => 'product_name', 'option' => $products));
      
      if(    (!empty($product_name) && in_array($product_name, get_product_name_for_category('category_master'))) 
          || (!empty($record['product_name']) && in_array($record['product_name'], get_product_name_for_category('category_master')))){
        load_field('text', array('field' => 'category_one'));
      }else{
        load_field('text', array('field' => 'category_one'));
        load_field('text', array('field' => 'category_two'));
        load_field('text', array('field' => 'category_three'));
        load_field('text', array('field' => 'category_four'));
        load_field('text', array('field' => 'wastage'));
      }
    ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>