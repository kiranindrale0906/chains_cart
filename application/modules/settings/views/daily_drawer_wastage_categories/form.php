<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>
    <?php load_field('dropdown', array('field' => 'product_name', 'option' => $products, 'id' => 'product'));?>
    <?php load_field('dropdown', array('field' => 'process_name', 'option' => $processes, 'id' => 'process'));?>
    <?php load_field('dropdown', array('field' => 'department_name', 'option' => $departments, 'id' => 'department'));?>
   
    <?php load_field('text', array('field' => 'name'));?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>

<script>
  var dropdown_data = <?php echo json_encode($dropdown_data); ?>;
</script>