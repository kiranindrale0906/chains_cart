<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>
    <?php load_field('text', array('field' => 'design_code')) ?>                 
    <?php load_field('text', array('field' => 'range')) ?>
    <?php load_field('text', array('field' => 'weight')) ?>
    <?php load_field('text', array('field' => 'length')) ?>
  </div>
  <?php load_buttons('submit',array('name' => 'Save',
                                    'class' => 'btn-sm btn_blue')) ?>
</form>