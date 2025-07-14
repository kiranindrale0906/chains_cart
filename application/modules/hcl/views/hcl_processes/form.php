<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>

     <?php 
      load_field('dropdown', array('field' => 'process_name','option'=>@get_process_hcl(),'class'=>'hcl_process_name'));
      load_field('dropdown', array('field' => 'parent_lot_id','option'=>$parent_lot_nos,'col' => 'col-md-6'));
      load_field('dropdown', array('field' => 'melting_lot_id','option'=>$lot_nos,'col' => 'col-md-6 hcl_lots','value'=>@$record['melting_lot_id']));?>    


    <?php load_field('text',array('field' => 'in_weight',
                                  'class' => 'hcl_in_weight',
                                  'readonly'=>'readonly')) ?>
  </div>
  <?php
    if (isset($processes) && !empty($processes)) {
      $this->load->view('hcl_processes/formlist');
    }
  ?>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
<?php //pd(validation_errors(),0); ?>
</form>
<script type="text/javascript">
  var melting_lot_id = "<?= $record["melting_lot_id"]?>";
</script>