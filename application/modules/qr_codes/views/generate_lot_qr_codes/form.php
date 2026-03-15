<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update' || $action == 'create' || $action == 'store'):
        load_field('hidden', array('field' => 'id'));
      endif;
        load_field('hidden', array('field' => 'generate_lot_tagging_id','value'=>$generate_lot_tagging_id));

      load_field('text', array('field' => 'purity','value'=>$purity));
      load_field('text', array('field' => 'design_code'));
      load_field('dropdown', array('field' => 'percentage',
                                          'option'=>array(
                                                      array('id'=>00,'name'=>00),
                                                      array('id'=>50,'name'=>50),
                                                      array('id'=>60,'name'=>60),
                                                      array('id'=>70,'name'=>70),
                                                      array('id'=>75,'name'=>75),
                                                      array('id'=>80,'name'=>80),
                                                      array('id'=>100,'name'=>100)
                                                    ),
                                         'onchange'=>"change_value_on_select_percentage()")); 
    ?>  
  </div>
 
  <div class="col-md-12">
    <div class="table-responsive">
        <?php 
          $this->load->view('qr_codes/generate_lot_qr_codes/formlist'); 
        ?>
    </div>
    <div class="row">
      <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue'));?>
    </div>
  </div> 
</form>
