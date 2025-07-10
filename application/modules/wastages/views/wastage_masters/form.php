<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>
    <?php load_field('text', array('field' => 'customer_name','class'=>'autocomplete_account'));?> 
    
  </div>
    <?php
    $this->load->view('wastage_masters/formlist'); ?>
    <?php load_buttons('submit', array('name'=>'SAVE','class'=>'btn_blue')); ?>
</form>