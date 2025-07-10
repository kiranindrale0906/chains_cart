<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>
    <?php load_field('dropdown', array('field' => 'product_name', 'option' =>get_process(),'class'=>'onchane_process_name'));?>

    <?php load_field('dropdown', array('field' => 'alloy_id','option'=>$alloy_types));?>

    <?php load_field('dropdown', array('field' => 'alloy_purity','option'=>$purities,'class'=>'lot_purity'));?>

    <?php load_field('text', array('field' => 'weight'));?>
    <?php load_field('dropdown', array('field' => 'chain','option'=>$chains));?>
    <?php load_field('dropdown', array('field' => 'tone','option'=>$tone));?>

    <?php 

      load_field('dropdown', array('field' => 'category_one','option'=>$category_one));
      if(HOST=='ARF'){
      load_field('dropdown', array('field' => 'machine_size','option'=>$machine_sizes));
      load_field('dropdown', array('field' => 'design_name','option'=>$design_names));
      }
    ?>
     <?php //load_field('dropdown', array('field' => 'wastage_percentage',
    //                                    'option'=>array(
    //                                     array('id'=>'Less then 99%','name'=>'Less-than 99%'),
    //                                     array('id'=>'Greater then 99%','name'=>'Greater-than 99%'))));?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>

   <!-- json_encode(get_melting_lots_lot_purity()) -->

  

