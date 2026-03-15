<?php
  if (!empty($import))
    $this->load->view('choco_chain_bom_settings/import'); 
?>
<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>

    <?php load_field('text', array('field' => 'type'));?>
    <?php load_field('text', array('field' => 'chain'));?>
    <?php load_field('text', array('field' => 'die_1_code'));?>
    <?php load_field('text', array('field' => 'die_2_code'));?>
    <?php load_field('text', array('field' => 'melting'));?>
    <?php load_field('text', array('field' => 'wt_in_18_inch'));?>
    <?php load_field('text', array('field' => 'no_of_die_pcs_in_18_inch'));?>
    <?php load_field('text', array('field' => 'die_pcs_wt_in_18_inch'));?>
    <?php load_field('text', array('field' => 'die_1_pcs_per_18_inch'));?>
    <?php load_field('text', array('field' => 'die_1_wt_per_pcs'));?>
    <?php load_field('text', array('field' => 'die_1_wt'));?>
    <?php load_field('text', array('field' => 'die_2_pcs_per_18_inch'));?>
    <?php load_field('text', array('field' => 'die_2_wt_per_pcs'));?>
    <?php load_field('text', array('field' => 'die_2_wt'));?>
    <?php load_field('text', array('field' => 'die_1_strip_per_pc_width'));?>
    <?php load_field('text', array('field' => 'die_1_strip_per_pc_thickness'));?>
    <?php load_field('text', array('field' => 'die_1_strip_precentage'));?>
    <?php load_field('text', array('field' => 'die_1_strip_per_pc_wt'));?>
    <?php load_field('text', array('field' => 'die_2_strip_per_pc_width'));?>
    <?php load_field('text', array('field' => 'die_2_strip_per_pc_thickness'));?>
    <?php load_field('text', array('field' => 'die_2_strip_precentage'));?>
    <?php load_field('text', array('field' => 'die_2_strip_per_pc_wt'));?>
    <?php load_field('text', array('field' => 'die_1_strip_to_langari_percentage'));?>
    <?php load_field('text', array('field' => 'die_1_langari_name'));?>
    <?php load_field('text', array('field' => 'die_1_langari_per_pc_size'));?>
    <?php load_field('text', array('field' => 'die_1_langari_per_pc_wt'));?>
    <?php load_field('text', array('field' => 'die_2_strip_to_langari_percentage'));?>
    <?php load_field('text', array('field' => 'die_2_langari_name'));?>
    <?php load_field('text', array('field' => 'die_2_langari_per_pc_size'));?>
    <?php load_field('text', array('field' => 'die_2_langari_per_pc_wt'));?>
    <?php load_field('text', array('field' => 'hook_per_chain_size'));?>
    <?php load_field('text', array('field' => 'hook_per_chain_qty'));?>
    <?php load_field('text', array('field' => 'hook_per_chain_wt'));?>
    <?php load_field('text', array('field' => 'lock_per_chain_size'));?>
    <?php load_field('text', array('field' => 'lock_per_chain_qty'));?>
    <?php load_field('text', array('field' => 'lock_per_chain_wt'));?>
    <?php load_field('text', array('field' => 'kdm_per_inch'));?>
    <?php load_field('text', array('field' => 'solid_wire_per_inch_size'));?>
    <?php load_field('text', array('field' => 'solid_wire_per_inch_wt'));?>
    <?php load_field('text', array('field' => 'pipe_type_size'));?>
    <?php load_field('text', array('field' => 'pipe_finish'));?>
    <?php load_field('text', array('field' => 'pipe_pcs'));?>
    <?php load_field('text', array('field' => 'pipe_wt_per_pc'));?>
    <?php load_field('text', array('field' => 'pipe_total_wt'));?>
    <?php load_field('text', array('field' => 'wt_per_inch'));?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>