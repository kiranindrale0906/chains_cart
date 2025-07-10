<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>
    <?php load_field('dropdown', array('field' => 'chain_name', 'option' =>get_process()));?>
    <?php load_field('text', array('field' => 'balance_gross'));?>
    
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>

   <!-- json_encode(get_melting_lots_lot_purity()) -->

  

