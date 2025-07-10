<form method="post" 
      class="form-horizontal form-group-md form_radius_none" 
      enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <?php load_field('hidden', array('field' => 'template_id')) ?>
  <?php load_field('text',array('field' => 'mobile_no')) ?>
  <hr>
  <div class='boxrow'>
   <?php load_buttons('submit',array('class'=> 'btn btn-primary pull-right','name'=>'Send SMS')); ?>
  </div> 
</form> 
<div class='row mt-3'>
<?php load_card(array('url'=>'',
                        'view'=>'communications/preview_smservices/view',
                        'col'=>'col-lg-12 mt-5',
                        'title'=>'SMS Preview',
                        'button'=>''));?>
</div>