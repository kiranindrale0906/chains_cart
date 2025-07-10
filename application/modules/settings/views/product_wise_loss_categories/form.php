<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php

      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
      load_field('hidden', array('field' => 'page_no','name'=>'page_no','value'=>@$page_no));
    ?>
    <?php 
      if(isset($blank)&&$blank==1) {
        load_field('text', array('field' => 'product_name'));
        load_field('text', array('field' => 'process_name'));
        load_field('text', array('field' => 'department_name'));
        
      } else {
        load_field('dropdown', array('field' => 'product_name', 'option' => $products, 'id' => 'product'));
        load_field('dropdown', array('field' => 'process_name', 'option' => $processes, 'id' => 'process'));
        load_field('dropdown', array('field' => 'department_name', 'option' => $departments, 'id' => 'department'));
        load_field('text', array('field' => 'category'));
      } ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>
<script>
  var dropdown_data = <?php echo json_encode(get_product_process_department_data()); ?>;
</script>