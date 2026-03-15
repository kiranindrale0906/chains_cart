<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <?php if ($action == 'edit' || $action == 'update'): ?>
    <?php load_field('hidden', array('field' => 'id')) ?>
  <?php endif;?>     
  <div class="row">    
  <?php  
    load_field('dropdown', array('field' => 'daily_drawer_type' ,'option'=>@get_daily_drawer_receipt_type()));
  ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
  <?php// pd(validation_errors(),0); ?>
</form>