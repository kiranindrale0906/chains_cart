<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>

  <?php load_field('hidden', array('field' => 'id','value'=>'1')) ?>
  <?php load_field('dropdown', array('field' => 'out_lot_purity','option'=>$out_lot_purities)) ?>
  <?php

    if (isset($processes) && !empty($processes)) {
        $this->load->view('finish_good_details/formlist');
        load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); 
    }
  ?>
</form>
