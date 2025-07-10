<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>
    <?php load_field('dropdown', array('field' => 'market_design_name',
                                   'option' => $market_design_names)); ?>
    <?php load_field('text', array('field' => 'inch_qty'));?>
    <?php load_field('text', array('field' => 'inch_size'));?>
    <?php load_field('text', array('field' => 'stock_used_qty'));?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>

  

