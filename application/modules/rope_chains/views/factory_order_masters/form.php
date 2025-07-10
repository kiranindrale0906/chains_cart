<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">  
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>

    <?php load_field('text', array('field'  => 'category_name')); ?>
    <?php load_field('text', array('field'  => 'design_name')); ?>
    <?php load_field('text', array('field'  => 'wire_size'));?>
    <?php load_field('text', array('field'  => 'wt_in_18_inch')); ?>
    <?php load_field('text', array('field'  => 'wt_in_18_inch_with_iron')); ?>
    <?php load_field('text', array('field'  => 'langdi_percentage')); ?>
    <?php load_field('text', array('field'  => 'kdm_percentage_au_plus_fe')); ?>
    <?php load_field('text', array('field'  => 'kdm_percentage_joinning')); ?>
    <?php load_field('text', array('field'  => 'hook_no')); ?>
    <?php load_field('text', array('field'  => 'hook_quantity')); ?>
    <?php load_field('text', array('field'  => 'hook_weight')); ?>
    <?php load_field('text', array('field'  => 'lopster_no')); ?>
    <?php load_field('text', array('field'  => 'lopster_quantity')); ?>
    <?php load_field('text', array('field'  => 'lopster_weight')); ?>
    <?php load_field('text', array('field'  => 's_no')); ?>
    <?php load_field('text', array('field'  => 's_quantity')); ?>
    <?php load_field('text', array('field'  => 's_weight')); ?>
    <?php load_field('text', array('field'  => 'thickness')); ?>
  </div>
  <?php load_buttons('submit',array('name' => 'Save',
                                    'class' => 'btn-sm btn_black')) ?>
</form>