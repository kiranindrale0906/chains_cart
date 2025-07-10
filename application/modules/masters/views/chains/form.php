<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>
    <?php load_field('text', array('field' => 'name')) ?>
    <?php load_field('text', array('field' => 'category_1_label')) ?>
    <?php load_field('text', array('field' => 'category_2_label')) ?>
    <?php load_field('text', array('field' => 'category_3_label')) ?>
    <?php load_field('text', array('field' => 'category_4_label')) ?>
    <?php load_field('text', array('field' => 'category_5_label')) ?>
    <?php load_field('text', array('field' => 'category_6_label')) ?>                 
  </div>
  <?php load_buttons('submit',array('name' => 'Save',
                                    'class' => 'btn-sm btn_green')) ?>
</form>