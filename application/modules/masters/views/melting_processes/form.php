<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>
    <?php load_field('dropdown', array('field' => 'colour','option'=> $colours)); ?>        
    <?php load_field('dropdown', array('field' => 'purity','option'=> $purities)); ?>        
    <?php load_field('text', array('field' => 'process_name')) ?>          
  </div>
  <?php load_buttons('submit',array('name' => 'Save',
                                    'class' => 'btn-sm btn_green')) ?>
</form>