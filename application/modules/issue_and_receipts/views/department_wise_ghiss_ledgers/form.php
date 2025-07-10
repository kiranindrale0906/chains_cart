
<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
     
    ?>     
    </div> 
    <div class="row">

    <?php
     load_field('dropdown', array('field' => 'department_name',
                                   'name' => 'department_name',

                                   'option' => @$department_names,
                                   'class' => 'ghiss_ledger_department_name','col' => 'col-sm-4'));

     load_field('date',array('field' => 'start_date','class' => 'datepicker_js', 'col'=>'col-sm-4','value'=>!empty($start_date)?date('d M Y',strtotime($start_date)):''));?>
    <?php load_field('date',array('field' => 'end_date','class' => 'datepicker_js', 'col'=>'col-sm-4','value'=>!empty($end_date)?date('d M Y',strtotime($end_date)):''));?>  
    </div>
    <?php load_buttons('anchor', array('name' =>'SEARCH', 
                                        'class' =>'btn_blue ghiss_ledger_processes_search',
   
                                       'col' => 'col-md-3',)); ?> 
                                              
    <?php

      if (isset($processes) && !empty($processes)) {
        $this->load->view('issue_and_receipts/department_wise_ghiss_ledgers/formlist');
      }
    ?>
    </form>