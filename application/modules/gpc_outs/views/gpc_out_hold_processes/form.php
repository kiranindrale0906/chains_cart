<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
          load_field('dropdown', array('field' => 'product_name',
                                       'class' => '',
                                       'col' => 'col-md-4',
                                       'option' => $product_names)); 
          load_field('dropdown', array('field' => 'melting',
                                       'class' => '',
                                       'col' => 'col-md-4',
                                       'option' => $purities)); 
        if($_SESSION['name']=="GPC HOLD"){ 
          load_field('text', array('field' => 'in_weight',
                               'class' => 'gpc_out',
                               'readonly'=>'readonly'));
        }
        
    ?>                            
  </div>
  <div>
   <?php load_buttons('anchor', array('name' =>'SEARCH', 
                                      'class' =>'btn_blue gpc_out_processes_search',
                                      'col' => 'col-md-3',)); ?> 
  
   </div> 
  <?php
    if (!empty($processes)) {
      $this->load->view('gpc_out_hold_processes/formlist');
    }
  ?>
<?php if($_SESSION['name']=="GPC HOLD"){ ?>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
<?php } ?>
</form>