<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    
      load_field('dropdown', array('field' => 'chain_name', 'option' => $products));
    
      if (   (!empty($product_name) || $record['chain_name']) 
          && (in_array($product_name, get_product_name_for_category()) || in_array($record['chain_name'], get_product_name_for_category()) ||$record['chain_name']=='KA Chain' )){
        load_field('dropdown', array('field' => 'category_one', 'option' => $category_ones));
      } 
    
      if (!empty($product_name) && (   $product_name=='KA Chain' 
                                            || $record['chain_name']=='KA Chain')){
        //load_field('dropdown', array('field' => 'category_three', 'option' => $category_threes));
        load_field('text', array('field' => 'category_three'));
      }

      if (!empty($product_name) && (   in_array($product_name, array('KA Chain', 'Fancy Chain','Ball Chain')) 
                                            || in_array($record['chain_name'], array('KA Chain','Ball Chain', 'Fancy Chain')))){
        load_field('dropdown', array('field' => 'category_four', 'option'=>$category_fours));
      }

      load_field('text', array('field' => 'chain_purity'));
      load_field('text', array('field' => 'chitti_purity'));
      load_field('text', array('field' => 'chain_margin'));
    ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>
