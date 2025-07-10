<form class="fields-group-sm" method="GET" enctype="multipart/form-data" 
    action="<?=ADMIN_PATH."reports/timing_reports/index"?>">
  <div class="row">
    <?php 
    load_field('dropdown', array('field' => 'department_name', 'col'=>'col-sm-3', 
                                       'option' => $departments, 
                                       'id' => 'timing_report_department_name', 'class' => 'timing_report_filter')); 
    load_field('dropdown', array('field' => 'product_name', 'col'=>'col-sm-3', 
                                       'option' => $products, 
                                       'id' => 'timing_report_product_name', 'class' => 'timing_report_filter', 
                                       /*'onchange' => 'get_departments(this);'*/));
    load_field('dropdown', array('field' => 'process_name', 'col'=>'col-sm-3', 
                                       'option' => $processes, 
                                       'id' => 'timing_report_product_name', 'class' => 'timing_report_filter', 
                                       /*'onchange' => 'get_processes(this);'*/));
                                       ?>
                                        
    <?php load_field('date',array('field' => 'from_date', 'col'=>'col-sm-3', 
                                  'id' => 'timing_report_from_date', 'class' => 'timing_report_filter datepicker_js'));?>
    <?php load_field('date',array('field' => 'to_date', 'col'=>'col-sm-3', 
                                  'id' => 'timing_report_to_date', 'class' => 'timing_report_filter datepicker_js'));
          load_field('text', array('field' => 'hours', 'col'=>'col-sm-3', 'class' => 'timing_report_filter' ));
                                  ?>
    </div>

  <div class="row">
    <div class="col-sm-3">
      <div class="form-group ">
        <?php load_buttons('submit',array('class'=> 'btn-sm btn_blue float-left', 'name'=>'Submit')); ?> 
      </div>
    </div>
  </div>

</form>