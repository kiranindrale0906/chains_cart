<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>
    <?php load_field('text', array('field' => 'product_name','value'=>'GPC Powder','readonly' => true));?>
    <?php load_field('text', array('field' => 'account_id','value'=>'GPC Powder '.HOST.HOSTVERSION,'readonly' => true));?>
    <?php load_field('dropdown', array('field' => 'company_name','option'=>get_issue_department_comapny_name()));?>

    <?php load_field('text', array('field' => 'in_weight'));?>
    <?php 
    if(HOST=='ARC' || HOST=='ARF'){
      // load_field('dropdown', array('field' => 'in_purity','option'=>array(array('id'=>70,'name'=>70)))); 
      load_field('text', array('field' => 'in_purity','value'=>'70','readonly'=>'readonly')); 
    }else{

    load_field('text', array('field' => 'in_purity')); 
    }

    ?>
    <?php load_field('text', array('field' => 'description'));?>
    
  </div>
  
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>
