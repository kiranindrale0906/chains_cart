<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>
    <?php load_field('dropdown', array('field'      => 'melting',
                                       'option'     => $meltings,
                                       'id'         => 'melting',
                                       'controller' => 'rope_chain_bom_settings'));?>
    <?php load_field('dropdown', array('field'      => 'chain_code',
                                       'option'     => $chain_codes,
                                       'id'         => 'chain_code',
                                       'controller' => 'rope_chain_bom_settings'));?>
    <?php load_field('dropdown', array('field'      => 'varient',
                                       'option'     => $varients,
                                       'id'         => 'varient',
                                       'controller' => 'rope_chain_bom_settings'));?>

    <?php load_field('number', array('field' => '8_order_qty'));?>
    <?php load_field('number', array('field' => '16_order_qty'));?>
    <?php load_field('number', array('field' => '18_order_qty'));?>
    <?php load_field('number', array('field' => '20_order_qty'));?>
    <?php load_field('number', array('field' => '22_order_qty'));?>
    <?php load_field('number', array('field' => '24_order_qty'));?>
    <?php load_field('number', array('field' => '26_order_qty'));?>
    <?php load_field('number', array('field' => 'custom_1_length'));?>
    <?php load_field('number', array('field' => 'custom_1_order_qty'));?>
    <?php load_field('number', array('field' => 'custom_2_length'));?>
    <?php load_field('number', array('field' => 'custom_2_order_qty'));?>
    <?php 
    if ($action == 'edit' || $action == 'update')
      load_field('dropdown', array('field' => 'status', 'option' => get_order_status()));
    ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>