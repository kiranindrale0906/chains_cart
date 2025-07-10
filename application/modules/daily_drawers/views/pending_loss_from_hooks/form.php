<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
      load_field('dropdown', array('field' => 'karigar' ,
                                   'option'=> @$karigars)); ?>
      <?php load_field('dropdown', array('field' => 'in_lot_purity' ,
                                   'option'=> @$purity)); ?>
  </div>
  <div class="row">
    <?php
      load_field('text', array('field' => 'in_weight',
                               'readonly'=>'readonly'));
      load_field('text', array('field' => 'process_hook_in',
                               'name' => 'process_hook_in',
                               'class' => 'process_hook_in',
                               'readonly'=>'readonly'));
      load_field('text', array('field' => 'process_in_weight',
                               'name' => 'process_in_weight',
                               'class' => 'process_in_weight',
                               'readonly'=>'readonly'));
      load_field('text', array('field' => 'out_weight'));
      load_field('text', array('field' => 'loss',
                               'class' => 'loss',
                               'readonly'=>'readonly'));
      
    ?>            
  </div> 
  <?php
    if (!empty($processes)) {
      $this->load->view('pending_loss_from_hooks/formlist');
    }
  ?>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>