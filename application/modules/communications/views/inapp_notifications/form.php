<form method="post"  class="form-horizontal form-group-md form_radius_none"  enctype="multipart/form-data" action="<?= get_form_action($controller, $action, $record) ?>">
  <?php load_field('hidden', array('field' => 'id')) ?>
  <?php load_field('text',array('field' => 'user_id')) ?>
  <?php load_field('text',array('field' => 'link')) ?>
  <?php load_field('text',array('field' => 'message')) ?>
  <hr>
  <div class='boxrow'>
     <?php load_buttons('submit',
     					array('class'=> 'btn btn-primary float-right',
     								'name'=>'Submit')); ?>
  </div>          
</form>       
