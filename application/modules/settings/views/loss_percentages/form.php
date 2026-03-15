<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
      load_field('hidden', array('field' => 'page_no','name'=>'page_no','value'=>@$page_no));
    ?>
    <?php load_field('dropdown', array('field' => 'product_name', 'option' => $products));?>
    <?php load_field('dropdown', array('field' => 'process_name', 'option' => $processes));?>
    <?php load_field('dropdown', array('field' => 'department_name', 'option' => $departments));?>
    <?php load_field('dropdown', array('field' => 'karigar_name', 'option' => $karigars));?>
    <?php load_field('text', array('field' => 'loss_percentage'));?>
    <?php load_field('text', array('field' => 'max_loss_percentage'));?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>