<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if($action=='create'):
      $market_order_id=$_GET['market_order_id'];
      load_field('hidden',array('field' => 'rope_chain_factory_order_id','value' =>$market_order_id));
      endif;
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>
    <?php load_field('text', array('field' => 'design_name','onkeyup' => 'on_change_custom_bunch_market_design_name(this)')); ?>
    <?php load_field('text', array('field' => 'bunch_weight'));?>
    <?php load_field('text', array('field' => 'bunch_length'));?>

    <?php if($action=='edit'):load_field('text', array('field' => 'per_inch_weight','readonly'=>'readonly'));endif;?>
    <?php if($action=='create'):load_field('text', array('field' => 'per_inch_weight'));endif;?>
    <?php load_field('text', array('field' => 'estimate_bunch_weight'));?>
    <?php load_field('text', array('field' => 'lot_no'));?>
    <?php load_field('dropdown', array('field' => 'status','option' =>array(array('id'=>"Pending",'name'=>"Pending"),
                                                                            array('id'=>"In Process",'name'=>"In Process"),
                                                                            array('id'=>"Ready",'name'=>"Ready"),
                                                                            array('id'=>"Ready For Market",'name'=>"Ready For Market"))));?>
 
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>
