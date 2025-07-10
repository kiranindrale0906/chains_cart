<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <?php 
    if ($action == 'edit' || $action == 'update'): 
      load_field('hidden', array('field' => 'id')); 
    endif;
   ?>     
  <div class="row">    
  <?php 
    load_field('text', array('field' => 'selected_date','readonly'=>'readonly'));
    load_field('text', array('field' => 'day','readonly'=>'readonly'));
    load_field('text', array('field' => 'open_time'));
    load_field('text', array('field' => 'close_time'));
    
    load_field('radio',array('field' => 'is_closed',
                              'col'=>'col-sm-2',
                              'option' => array(array('label' => 'Close',
                                                      'value'=> '1',
                                                      'checked'=>(($record['is_closed'] == 1)?' checked':'')),
                              array('label' => 'Open',
                                                      'value'=> '0',
                                                      'checked'=>(($record['is_closed'] == 0)?' checked':''))))); 

        /*load_field('text', array('field' => 'lot_no'));*/
  ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>