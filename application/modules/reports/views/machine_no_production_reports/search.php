<form class="fields-group-sm" method="GET" enctype="multipart/form-data" 
    action="<?=ADMIN_PATH."reports/machine_no_production_reports/index"?>">
  <div class="row">
    <?php load_field('dropdown', array('field' => 'product_name', 'col'=>'col-sm-3', 
                                       'option' => $product_names));?>
    <?php load_field('dropdown', array('field' => 'process_name', 'col'=>'col-sm-3', 
                                       'option' => $process_names));?>
   <?php load_field('dropdown', array('field' => 'department_name', 'col'=>'col-sm-3', 
                                       'option' => $department_names));?>
    <?php load_field('dropdown', array('field' => 'machine_no', 'col'=>'col-sm-3', 
                                       'option' => $machine_nos));?>
    <?php load_field('date',array('field' => 'from_date', 'col'=>'col-sm-3','class' => 'datepicker_js'));?>
    <?php load_field('date',array('field' => 'to_date', 'col'=>'col-sm-3','class' => ' datepicker_js'));?>
    <?php load_field('dropdown', array('field' => 'under_utilization', 'col'=>'col-sm-3', 
                                       'option' => array(array('name' => 'Yes', 'id' => 'Yes'),
                                                         array('name' => 'No', 'id' => 'No'))));?>
    <?php load_field('dropdown', array('field' => 'group_by', 'col'=>'col-sm-3', 
                                       'option' => array(array('name' => 'None', 'id' => 'None'),
                                                         array('name' => 'Date', 'id' => 'Date'),
                                                         array('name' => 'Machine Size', 'id' => 'Machine Size'))));?>                                                         
    
    </div>

  <div class="row">
    <div class="col-sm-3">
      <div class="form-group ">
        <?php load_buttons('submit',array('class'=> 'btn-sm btn_blue float-left', 'name'=>'Submit')); ?> 
      </div>
    </div>
  </div>

</form>