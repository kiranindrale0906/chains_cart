<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>
    <?php load_field('dropdown', array('field' => 'product_name',
                                       'option' => $product_names));
          load_field('text', array('field' => 'priority'));
          load_field('dropdown', array('field' => 'category_one',
                                       'option' => $category_one_names));
          load_field('dropdown', array('field' => 'tone',
                                       'option' => $tones));
          load_field('dropdown', array('field' => 'out_lot_purity',
                                       'option' => $out_lot_purities));
          load_field('dropdown', array('field' => 'machine_size',
                                       'option' => $machine_sizes));
          load_field('dropdown', array('field' => 'design_name',
                                       'option' => $design_names));
          load_field('text', array('field' => 'wastage'));
       ?>      
  </div>
  <?php load_buttons('submit',array('name' => 'Save',
                                    'class' => 'btn-sm btn_green')) ?>
</form>
