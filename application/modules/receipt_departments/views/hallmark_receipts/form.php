<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <?php if ($action == 'edit' || $action == 'update'): ?>
    <?php load_field('hidden', array('field' => 'id')) ?>
  <?php endif;
   ?>     
  <div class="row">    
  <?php 
    load_field('hidden', array('field' => 'process_name','value'=>'Hallmark Receipt')); 
    load_field('text', array('field' => 'account'));
    load_field('text', array('field' => 'in_weight'));
    load_field('text', array('field' => 'in_lot_purity',
                             'readonly' => 'readonly', 
                             'value' => '92'));
    load_field('text', array('field' => 'description'));
  ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
  <?php// pd(validation_errors(),0); ?>
</form>