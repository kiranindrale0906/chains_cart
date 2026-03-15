<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>
    <?php load_field('text', array('field' => 'process_name')) ?>          
    <?php load_field('text', array('field' => 'product_name')) ?> 
    <?php load_field('text', array('field' => 'module_name')) ?>
    <?php load_field('text', array('field' => 'model_name')) ?>
    <?php load_field('text', array('field' => 'controller_name')) ?>
  </div>
  <?php load_buttons('submit',array('name' => 'Save',
                                    'class' => 'btn-sm btn_green')) ?>
</form>