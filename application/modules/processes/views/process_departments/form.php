<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <?php 
    if ($action == 'edit' || $action == 'update'): 
      load_field('hidden', array('field' => 'id')); 
    endif;
   ?>     
  <div class="row">    
  <?php 
     load_field('dropdown', array('field' => 'department_name','option'=>get_pending_ghiss_department(),'value'=>@$record['department_name']));
   
  ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>