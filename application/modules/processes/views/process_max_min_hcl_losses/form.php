<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data" action="<?= get_form_action($controller, $action, $record) ?>">
  <?php 
    if ($action == 'edit' || $action == 'update'): 
      load_field('hidden', array('field' => 'id')); 
    endif;
   ?>     
  <div class="row">    
  <?php 
    load_field('text', array('field' => 'max_hcl_loss'));
    load_field('text', array('field' => 'min_hcl_loss'));
  
  ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>