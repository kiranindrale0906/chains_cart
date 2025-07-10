<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  <div class="row">
    <?php
    if ($action == 'edit' || $action == 'update'):
      load_field('hidden', array('field' => 'id'));
    endif; 
      load_field('text', array('field' => 'in_weight',
                             'class' => 'melting_wastage_refine_out_in_weight',
                             'readonly'=>'readonly'));
    ?>            
  </div>  
  <?php
    if (isset($processes) && !empty($processes)) {
      $this->load->view('melting_wastage_refine_out_processes/formlist');
    }
  ?>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>