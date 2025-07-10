<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <?php if ($action == 'edit' || $action == 'update'): ?>
    <?php load_field('hidden', array('field' => 'id')) ?>
  <?php endif;
   ?>     
  <div class="row">    
  <?php 
        load_field('dropdown', array('field' => 'melting_lots' ,'option'=>@$melting_lots,'class'=>'search_melting_lots'));
        load_field('dropdown', array('field' => 'departments' ,'option'=>@$type));
  ?>
  </div>
</form>