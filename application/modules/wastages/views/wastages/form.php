<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>
    <?php load_field('dropdown', array('field' => 'product_name',
                                       'option' => get_product_names())) ?>
    <?php load_field('dropdown', array('field' => 'process_name',
                                       'option' => get_process_names())) ?>
    <?php load_field('dropdown', array('field' => 'department_name',
                                       'option' => get_all_department_names())) ?>                                       
    <?php load_field('text',array('field' => 'lot_no',)) ?>
    <?php load_field('text',array('field' => 'in_weight')) ?>
    <?php load_field('text',array('field' => 'in_purity')) ?>
    <?php load_field('submit', array('controller' => $controller)) ?>
  </div>
</form>