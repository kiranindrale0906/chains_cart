<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data" action="<?= get_form_action($controller, $action, $record) ?>">
  <?php 
    if ($action == 'edit' || $action == 'update'): 
      load_field('hidden', array('field' => 'id')); 
    endif;
   ?>     
  <div class="row">    
  <?php 
  //if (in_array($record['product_name'], array('Sisma Chain', 'KA Chain', 'Fancy Chain'))) {
    load_field('dropdown', array('field' => 'machine_no', 'option'=>$machine_names, 
                                 'value'=>@$record['machine_no']));
  //}else{
  //   load_field('text', array('field' => 'machine_no','value'=>@$record['machine_no']));
  //}
  ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>