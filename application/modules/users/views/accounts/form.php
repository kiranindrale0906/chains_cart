<form method="post" class="form-horizontal form-group-md form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <?php if ($action == 'edit' || $action == 'update'): ?>
    <?php load_field('hidden', array('field' => 'id')) ?>
  <?php endif; ?>     
  <h5 class="heading">Basic Details</h5>
  <div class="row">    
    <?php load_field('text', array('field' => 'name')) ?>
    <?php load_field('text', array('field' => 'email')) ?>
    <?php load_field('text', array('field' => 'phone_number')) ?>
    <?php load_field('text', array('field' => 'address')) ?>
    <?php load_field('text', array('field' => 'gst_no'));
     load_field('text', array('field' => 'license_no'));
     load_field('date', array('field' => 'license_validity_date','class'=>'datepicker_js')); ?>
 
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>