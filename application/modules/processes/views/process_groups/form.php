<form method="post" class="form-horizontal fields-group-sm mb-0 " 
      enctype="multipart/form-data" action="<?= get_form_action("processes/process_groups", 'store', @$record) ?>">
  <div class="table-responsive">
    <?php 
      if(!empty($flatting_processes)) {
        foreach ($flatting_processes as $index => $process) { 
          load_field('plain/checkbox',array('field' => 'process_id',
                                            'name' => 'process_ids[]',
                                            'id' => 'check_'.$index,
                                            'option' => array(array('label' => $process['lot_no'] .' ('. $process['parent_lot_name'].')',
                                                                    'value' => $process['id'] ,
                                                                    'chk_id'=>'check_'.$index))));
          load_field('hidden',array('field' => 'product_name','name'=>'product_name','value'=>$process['product_name']));
          load_field('hidden',array('field' => 'process_name','name'=>'process_name','value'=>$process_name));
        }
      } else { ?>
        <p> Record Not Found.</p>
      <?php } 
    ?>
  </div>
  <?php if(!empty($flatting_processes)) { ?>
    <div class="modal-footer">
      <?php load_buttons('submit',array('name'=> 'Save', 'class'=>'btn-sm btn_blue float-right ajax_post'));?>
    </div> 
  <?php } 
  //pd(validation_errors(),0); 
  ?>  

</form>


