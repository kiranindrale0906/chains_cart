<?php echo form_open_multipart(get_form_action($controller,$action, $record), 
                               'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
    
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>
    <?php load_field('label_with_value', array('field' => 'id'));?>
    <?php load_field('text', array('field' => 'item_name'));?>
    <?php load_field('dropdown', array('field' => 'type','option'=>array(array('id'=>'Wax','name'=>'Wax'),array('id'=>'Project','name'=>'Project'))));?>
    <?php load_field('dropdown', array('field' => 'melting','option'=>array(array('id'=>'92','name'=>'92'),array('id'=>'75','name'=>'75'))));?>
    <?php load_field('dropdown', array('field' => 'tone','option'=>array(array('id'=>'Yellow','name'=>'Yellow'),array('id'=>'Pink','name'=>'Pink'))));?>
    <?php load_field('text', array('field' => 'tree_gross_wt','class'=>'tree_gross_wt'));?>
    <?php load_field('text', array('field' => 'tree_base_wt','class'=>'tree_base_wt'));?>
    <?php load_field('text', array('field' => 'stone_wt','class'=>'stone_wt'));?>
    <?php load_field('text', array('field' => 'tree_net_wt','class'=>'tree_net_wt','readonly'=>true));?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>
