<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>" onSubmit="return confirm('Do you want to submit?') ">
  <?php if ($action == 'edit' || $action == 'update'): ?>
    <?php load_field('hidden', array('field' => 'id')) ?>
  <?php endif;?>     
  <div class="row">    
  <?php 
    load_field('dropdown', array('field' => 'type' ,
                                 'option'=>@get_daily_drawer_receipt_type()));
    load_field('text', array('field' => 'in_weight'));  
    load_field('dropdown', array('field' => 'in_lot_purity' ,'option'=>get_melting_purity()));
    load_field('dropdown', array('field' => 'karigar','option'=>$karigars, 'name' => 'karigar'));  
  ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue confirm_before_save')); ?>
</form>