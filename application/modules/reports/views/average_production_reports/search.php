<form class="fields-group-sm" method="GET" enctype="multipart/form-data" 
    action="<?=ADMIN_PATH."reports/average_production_reports/index"?>">
  <div class="row">
    <?php load_field('dropdown', array('field' => 'department_name', 'col'=>'col-sm-3', 
                                       'option' => $departments));?>
    <?php load_field('dropdown', array('field' => 'karigar_name', 'col'=>'col-sm-3', 
                                       'option' => $karigars));?>
    <?php load_field('date',array('field' => 'from_date', 'col'=>'col-sm-3','class' => 'datepicker_js'));?>
    <?php load_field('date',array('field' => 'to_date', 'col'=>'col-sm-3','class' => ' datepicker_js'));?>
    </div>

  <div class="row">
    <div class="col-sm-3">
      <div class="form-group ">
        <?php load_buttons('submit',array('class'=> 'btn-sm btn_blue float-left', 'name'=>'Submit')); ?> 
      </div>
    </div>
  </div>

</form>