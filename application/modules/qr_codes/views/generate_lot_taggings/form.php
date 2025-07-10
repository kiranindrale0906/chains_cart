<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update' || $action == 'create' || $action == 'store'):
        load_field('hidden', array('field' => 'id'));
      endif;
        load_field('hidden', array('field' => 'generate_lot_id','value'=>$generate_lot_id));
        load_field('text', array('field' => 'lot_no','readonly'=>'readonly'));
        load_field('text', array('field' => 'order_date','readonly'=>'readonly'));
        load_field('text', array('field' => 'due_date','readonly'=>'readonly'));
        load_field('text', array('field' => 'lot_weight','readonly'=>'readonly'));
        load_field('text', array('field' => 'lot_quantity','readonly'=>'readonly'));
        load_field('text', array('field' => 'color','readonly'=>'readonly'));
        load_field('text', array('field' => 'process_name','readonly'=>'readonly'));
      load_field('text', array('field' => 'purity'));
      ?>
<?php pd(validation_errors(),0); ?>
  </div>
 
  <div class="col-md-12">
    <div class="table-responsive">

        <?php 
        if (isset($order_details) && !empty($order_details)) {
          $this->load->view('qr_codes/generate_lot_taggings/formlist'); 
        }?>
    </div>
    <div class="row">
      <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue'));?>
    </div>
  </div> 
</form>
