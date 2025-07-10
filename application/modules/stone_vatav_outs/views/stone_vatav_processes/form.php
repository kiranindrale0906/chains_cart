<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
      load_field('dropdown', array('field' => 'in_lot_purity',
                                   'name' => 'in_lot_purity',

                                   'option' => @$in_lot_purity,
                                   'class' => 'stone_vatav_melting_lots_purity'));
      load_field('text', array('field' => 'in_weight',
                               'class' => 'stone_vatav_in_weight',
                               'readonly'=>'readonly'));
      load_field('text', array('field' => 'ghiss'));
      load_field('text', array('field' => 'loss'));
    ?>            
  </div> 
  <?php
    if (isset($processes) && !empty($processes)) {
      $this->load->view('stone_vatav_processes/formlist');
    }
  ?>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>