<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
      /*load_field('dropdown', array('field' => 'department_name',
                                   'name' => 'department_name',
                                   'option' => $department_name,
                                   'class' => 'tounch_ghiss_melting_lots_department_name'));*/
      load_field('text', array('field' => 'in_weight',
                               'class' => 'tounch_ghiss_out_in_weight',
                               'readonly'=>'readonly'));
    ?>            
  </div> 
  <?php
    if (isset($processes) && !empty($processes)) {
      $this->load->view('tounch_ghiss_out_processes/formlist');
    }
  ?>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>