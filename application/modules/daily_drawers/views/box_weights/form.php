<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  <div class="row">
    <?php 
      load_field('dropdown', array('field' => 'daily_drawer_type' ,
                                   'option'=>@get_daily_drawer_receipt_type()));
      load_field('dropdown', array('field' => 'purity' ,'option'=>$purities));
      load_field('dropdown', array('field' => 'karigar','option'=>$karigars));  
      load_field('text', array('field' => 'weight'));  
    ?>     
  </div> 
  
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>