<?php echo form_open_multipart(get_form_action($controller,$action, $record), 
                               'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
    
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>
    <?php load_field('text', array('field' => 'lot_no'));?>
  </div>
  <?php
  if($this->router->method!='edit' && $this->router->method!='update') {
    if (isset($wax_tree_processes) && !empty($wax_tree_processes)) {
      $this->load->view('wax_tree_process/wax_tree_lot_no_processes/formlist');
    }
  }
  ?>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>
