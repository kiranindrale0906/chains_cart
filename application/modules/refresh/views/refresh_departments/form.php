<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <?php 
    if ($action == 'edit' || $action == 'update'): 
      load_field('hidden', array('field' => 'id')); 
    endif;
   ?>     
  <div class="row">    
  <?php load_field('hidden', array('field' => 'process_name','value'=>'Refresh'));
        /*load_field('text', array('field' => 'lot_no'));*/
        load_field('text', array('field' => 'in_weight'));
        load_field('dropdown', array('field' => 'in_lot_purity',
                                     'option' => get_purity()));
        load_field('dropdown', array('field' => 'hook_kdm_purity',
                                     'option' => get_melting_purity()));
        load_field('text', array('field' => 'quantity'));
        load_field('text', array('field' => 'account'));
        load_field('text', array('field' => 'description'));
  ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>