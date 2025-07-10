<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
      load_field('dropdown', array('field' => 'in_purity' ,
                                   'option'=> @$purities));
      load_field('text', array('field' => 'in_weight',
                               'class' => 'daily_drawer_hold_in_weight',
                               'readonly'=>'readonly'));
        
    ?>  
  <?php
    if (!empty($processes)) {
      $this->load->view('daily_drawer_hold_processes/formlist');
    }
  ?>

  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>