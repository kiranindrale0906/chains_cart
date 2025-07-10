<form method="post" class="form-horizontal fields-group-sm" enctype="multipart/form-data" id="project_template"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update') {
        load_field('hidden', array('field' => 'id'));
      }
      load_field('text', array('field' => 'person_name',
                               'class' => 'parent_order_field'));
      load_field('dropdown', array('field'  => 'chain_name',
                                   'option' => $chain_names,
                                   'class'  => 'parent_order_field'));
      load_field('dropdown', array('field'  => 'melting',
                                   'option' => $meltings,
                                   'class'  => 'parent_order_field'));
      load_field('text', array('field' => 'name'));
    ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>

