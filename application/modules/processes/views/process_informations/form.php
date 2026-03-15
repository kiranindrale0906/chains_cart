<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data" action="<?= get_form_action($controller, $action, $record) ?>">
  <?php 
    if ($action == 'edit' || $action == 'update'): 
      load_field('hidden', array('field' => 'id')); 
    endif;
      load_field('hidden', array('field' => 'process_id')); 
   ?>     
  <div class="row">    
  <?php 
    load_field('text', array('field' => 'in_weight'));
    load_field('text', array('field' => 'out_weight'));
    load_field('text', array('field' => 'wastage'));
    load_field('text', array('field' => 'loss'));
    load_field('text', array('field' => 'stone_vatav'));
  
  ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>