<form class="fields-group-sm" method="GET" enctype="multipart/form-data" 
    action="<?=ADMIN_PATH."reports/worker_wise_karigar_calculations/index"?>">
  <div class="row">
    <?php 
    // load_field('dropdown', array('field' => 'product_name', 'col'=>'col-sm-3', 
    //                                    'option' => $products, 
    //                                    'id' => 'karigar_calculation_product_name', 'class' => 'karigar_calculation_filter', 
    //                                    'onchange' => 'get_departments(this);'));
                                        ?>
    <?php load_field('dropdown', array('field' => 'type', 'col'=>'col-sm-3', 
                                       'option' => array(array('id'=>'ghiss','name'=>'Ghiss'),
                                                        array('id'=>'hook_in','name'=>'Hook In')), 
                                       'id' => 'type', 'class' => 'karigar_calculation_filter')); ?>
                                  
    <?php load_field('date',array('field' => 'from_date', 'col'=>'col-sm-3', 
                                  'id' => 'karigar_calculation_from_date', 'class' => 'karigar_calculation_filter datepicker_js'));?>
    <?php load_field('date',array('field' => 'to_date', 'col'=>'col-sm-3', 
                                  'id' => 'karigar_calculation_to_date', 'class' => 'karigar_calculation_filter datepicker_js'));?>
    <?php 

     load_field('dropdown', array('field' => 'department_name', 'col'=>'col-sm-3', 
                                        'option' => $departments, 
                                        'id' => 'karigar_calculation_department_name', 'class' => 'karigar_calculation_filter')); 
                                       ?>
    <?php load_field('dropdown', array('field' => 'karigar_name', 'col'=>'col-sm-3', 
                                       'option' => $karigar_list, 
                                       'id' => 'karigar_name', 'class' => 'karigar_calculation_filter')); ?>
    <?php load_field('dropdown', array('field' => 'in_lot_purity', 'col'=>'col-sm-3', 
                                       'option' => $in_lot_purity, 
                                       'id' => 'in_lot_purity', 'class' => 'in_lot_purity_calculation_filter')); ?>
  </div>

  <div class="row">
    <div class="col-sm-3">
      <div class="form-group ">
        <?php load_buttons('submit',array('class'=> 'btn-sm btn_blue float-left', 'name'=>'Submit')); ?> 
      </div>
    </div>
  </div>

</form>