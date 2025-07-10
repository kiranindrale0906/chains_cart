<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>
    <?php load_field('dropdown', array('field' => 'product_name',
                                        'option' => $product_names));
          load_field('dropdown', array('field' => 'process_name',
                                       'option' => $process_names));
          load_field('dropdown', array('field' => 'department_name',
                                       'option' => $department_names));
          load_field('dropdown', array('field' => 'machine_size',
                                       'option' => $machine_sizes));
          load_field('dropdown', array('field' => 'design_code',
                                       'option' => $design_codes));
          load_field('dropdown', array('field' => 'category_one',
                                       'option' => $category_one_names));
          load_field('dropdown', array('field' => 'category_two',
                                       'option' => $category_two_names));
          load_field('dropdown', array('field' => 'category_three',
                                       'option' => $category_three_names));
          load_field('dropdown', array('field' => 'category_four',
                                       'option' => $category_four_names));
          load_field('text', array('field' => 'machine_name'));
          load_field('text', array('field' => 'machine_count'));
          load_field('text', array('field' => 'out_capacity'));
       ?>      
  </div>
  <?php load_buttons('submit',array('name' => 'Save',
                                    'class' => 'btn-sm btn_green')) ?>
</form>
