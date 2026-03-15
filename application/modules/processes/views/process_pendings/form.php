<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data" action="<?= get_form_action($controller, $action, $record) ?>">
  <?php 
    if ($action == 'edit' || $action == 'update'): 
      load_field('hidden', array('field' => 'id')); 
    endif;
   ?>     
  <div class="row">    
  <?php 
  //if (in_array($record['product_name'], array('Sisma Chain', 'KA Chain', 'Fancy Chain'))) {
    load_field('dropdown', array('field' => 'status', 'option'=>array(array('id'=>"Pending","name"=>"Pending"),
                                                                      array('id'=>"Complete","name"=>"Complete")), 
                                 'value'=>@$record['status']));
  //}else{
  //   load_field('text', array('field' => 'melting_lot_category_one','value'=>@$record['melting_lot_category_one']));
  //}
  ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>