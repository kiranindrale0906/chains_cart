<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>

    <?php 
    if(isset($blank)&&$blank==1) {
      load_field('text', array('field' => 'product_name'));
    } else {
      load_field('dropdown', array('field' => 'product_name', 'option' => $products));
    }
    ?>
    <?php load_field('text', array('field' => 'purity_in_kt'));?>
    <?php load_field('text', array('field' => 'lot_purity'));?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>