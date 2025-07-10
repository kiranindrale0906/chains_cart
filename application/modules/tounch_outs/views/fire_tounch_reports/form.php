<form method="post" class="form-horizontal form-group-md form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>" autocomplete="off">
  <div class="row">
    <?php
        load_field('hidden', array('field' => 'id'));
        load_field('hidden', array('field' => 'page_no','name'=>'page_no','value'=>@$page_no));
        load_field('text', array('field' => 'out_weight',
                                 'readonly' => 'readonly'));
        load_field('text', array('field' => 'fire_tounch_in',
                                 'class' => 'fire_tounch_in',
                                 'readonly' => 'readonly'));
        load_field('text', array('field' => 'out_lot_purity',
                                 'readonly' => 'readonly'));
     		load_field('text', array('field' => 'fire_tounch_out',
                                 'class'=>'fire_tounch_out'));
        load_field('text', array('field' => 'fire_tounch_purity',
                                 'class'=>'fire_tounch_purity'));
        load_field('text', array('field' => 'fire_tounch_gross',
                                 'class'=>'fire_tounch_gross',
                                 'readonly' => 'readonly'));
     		load_field('text', array('field' => 'fire_tounch_fine'));
    ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>
