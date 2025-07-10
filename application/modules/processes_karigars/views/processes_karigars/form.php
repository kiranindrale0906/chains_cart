<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <?php if ($action == 'edit' || $action == 'update'): ?>
    <?php load_field('hidden', array('field' => 'id')) ?>
  <?php endif;?>     
  <div class="row">    
  <?php 
    load_field('text', array('field' => 'product_name', 'readonly' => 'readonly'));
    load_field('text', array('field' => 'process_name', 'readonly' => 'readonly'));
    load_field('text', array('field' => 'department_name', 'readonly' => 'readonly'));
    load_field('text', array('field' => 'in_weight','readonly' => 'readonly'));
    load_field('text', array('field' => 'out_weight', 'readonly' => 'readonly'));  
    load_field('text', array('field' => 'in_lot_purity', 'readonly' => 'readonly'));
    load_field('dropdown', array('field' => 'karigar', 'option' => /*get_karigar_dropdown_with_host()*/));  
  ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>