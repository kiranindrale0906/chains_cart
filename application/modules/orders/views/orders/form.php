<p><b><?php echo "Chain Name : ".ucfirst($record['chain_name']); ?></b></p>
<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>

    <?php load_field('hidden', array('field' => 'chain_name', 'value' => $record['chain_name']));
          load_field('dropdown', array('field' => 'lot_purity',
                                      'label' => 'Purity',
                                      'option' => $melting_lots_lot_purity));
          load_field('text', array('field' => 'weight',
                                   'label' => 'Weight'));
      foreach ($selected_labels as $key => $value) { 
        if((!empty($value)) && ($key != 'category_6_label')):
          if($key == 'category_1_label'){
            load_field('dropdown', array('field' => $key,
                                   'label' => ucfirst($value),
                                   'placeholder' => $value,
                                   'option' => $category_1));
          }elseif($key == 'category_2_label'){
            load_field('dropdown', array('field' => $key,
                                   'label' => ucfirst($value),
                                   'placeholder' => $value,
                                   'option' => $category_2));
          }elseif($key == 'category_3_label'){
            load_field('dropdown', array('field' => $key,
                                   'label' => ucfirst($value),
                                   'placeholder' => $value,
                                   'option' => $category_3));
          }elseif($key == 'category_4_label'){
            load_field('dropdown', array('field' => $key,
                                   'label' => ucfirst($value),
                                   'placeholder' => $value,
                                   'option' => $category_4));
          }elseif($key == 'category_5_label'){
            load_field('dropdown', array('field' => $key,
                                   'label' => ucfirst($value),
                                   'placeholder' => $value,
                                   'option' => $category_5));
          }
        endif;
      } ?>        
  </div>
  <?php $this->load->view('orders/orders/subform') ?>
  <?php load_buttons('submit',array('name' => 'Save',
                                    'class' => 'btn-sm btn_green')) ?>
</form>