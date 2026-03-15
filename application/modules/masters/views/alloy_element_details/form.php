<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>
    <?php load_field('text', array('field' => 'company_name')) ?>          
    <?php load_field('text', array('field' => 'alloy_name')) ?> 
    <?php load_field('text', array('field' => 'ag')) ?>
    <?php load_field('text', array('field' => 'cu')) ?>
    <?php load_field('text', array('field' => 'zn')) ?>
    <?php load_field('text', array('field' => 'i_n')) ?>
    <?php load_field('text', array('field' => 'ir')) ?>
    <?php load_field('text', array('field' => 'co')) ?>
    <?php load_field('text', array('field' => 'ru')) ?>
    <?php load_field('text', array('field' => 'ni')) ?>
    <?php load_field('text', array('field' => 'xi')) ?>
    <?php load_field('text', array('field' => 'ga')) ?>
    <?php load_field('text', array('field' => 'ta')) ?>
    <?php load_field('text', array('field' => 'ge')) ?>
    <?php load_field('text', array('field' => 'extra')) ?>
  </div>
  <?php load_buttons('submit',array('name' => 'Save',
                                    'class' => 'btn-sm btn_green')) ?>
</form>