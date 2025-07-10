<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
<?php if(!empty($_GET['json'])&&$_GET['json']==1){?>
  <div class="row">
    <?php load_field('textarea', array('field' => 'jsoncode','name'=>'jsoncode'));?>
  </div>
    <div class="row">
    <div class="col-sm-3">
      <div class="form-group ">
       <?php load_buttons('anchor', array('name' =>'SEARCH', 
                                      'class' =>'btn_blue processes_json_search',
                                      'col' => 'col-md-3',)); ?> 
      </div>
    </div>
  </div>   
   <?php }else{ ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>
    <?php 
        
    load_field('text', array('field' => 'product_name'/*, 'option' => $products, 'id' => 'product'*/));
    load_field('text', array('field' => 'process_name'/*, 'option' => $processes, 'id' => 'process'*/));
    load_field('text', array('field' => 'department_name'/*, 'option' => $departments, 'id' => 'department'*/));
    load_field('text', array('field' => 'karigar'));
    load_field('text', array('field' => 'lot_no'));
    load_field('text', array('field' => 'in_lot_purity'));
    load_field('text', array('field' => 'in_purity'));
    load_field('text', array('field' => 'hook_kdm_purity'));
    load_field('text', array('field' => 'in_weight'));
    load_field('text', array('field' => 'out_weight'));
    load_field('text', array('field' => 'daily_drawer_in_weight'));
    load_field('text', array('field' => 'melting_wastage'));
    load_field('text', array('field' => 'daily_drawer_wastage'));
    load_field('text', array('field' => 'hcl_wastage'));
    load_field('text', array('field' => 'wastage_fe'));
    load_field('text', array('field' => 'ghiss'));
    load_field('text', array('field' => 'hcl_ghiss'));
    load_field('text', array('field' => 'pending_ghiss'));
    load_field('text', array('field' => 'loss'));
    // load_field('text', array('field' => 'karigar_loss'));
    load_field('text', array('field' => 'pending_loss'));
    // load_field('text', array('field' => 'refine_loss'));
    load_field('text', array('field' => 'tounch_in'));
    load_field('text', array('field' => 'fire_tounch_in'));
    load_field('text', array('field' => 'fe_in'));
    load_field('text', array('field' => 'fe_out'));
    load_field('text', array('field' => 'copper_in'));
    load_field('text', array('field' => 'solder_in'));
    load_field('text', array('field' => 'gpc_out'));
    load_field('text', array('field' => 'micro_coating'));
    load_field('text', array('field' => 'repair_out'));
    load_field('text', array('field' => 'description'));
    load_field('text', array('field' => 'design_code'));
    load_field('text', array('field' => 'machine_size'));
    load_field('text', array('field' => 'melting_lot_category_one'));
    load_field('text', array('field' => 'melting_lot_category_two'));
    load_field('text', array('field' => 'melting_lot_category_three'));
    load_field('text', array('field' => 'melting_lot_category_four'));
    load_field('text', array('field' => 'melting_lot_chain_name'));
    load_field('text', array('field' => 'order_id'));
    load_field('text', array('field' => 'order_detail_id'));

    
    // echo validation_errors();
    ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); }?>
</form>
<script>
  var dropdown_data = <?php echo json_encode(get_product_process_department_data()); ?>;
</script><!-- 
                                                +$this->attributes['alloy_weight']
                                                +$this->attributes['in_rod']
                                                +$this->attributes['in_machine_gold']

                                                +$this->attributes['hook_in']
                                                -$this->attributes['hook_out']

                                                +$this->attributes['micro_coating']
                                                +@$this->attributes['stone_vatav']
                                                +@$this->attributes['liquor_in']
                                                -@$this->attributes['liquor_out']
                                                -$this->attributes['out_rod']
                                                -$this->attributes['out_machine_gold']
                                                
                                                - $this->attributes['bounch_out']
                                                - $this->attributes['factory_out']
                                                - $this->attributes['customer_out']
                                                - $this->attributes['recutting_out']
                                                - $this->attributes['copper_out']
                                                - $this->attributes['out_weight'] 
                                                + $this->attributes['flash_wire'] 

                                                - $this->attributes['daily_drawer_in_weight']
                                                - $this->attributes['daily_drawer_out_weight']

                                                - $this->attributes['refine_loss']
                                                - $this->attributes['out_alloy_weight']

                                                - $this->attributes['melting_wastage'] 
                                                - $this->attributes['in_melting_wastage'] 
                                                - $this->attributes['solder_wastage'] 
                                                - $this->attributes['hcl_wastage']  
                                                - $this->attributes['daily_drawer_wastage'] 
                                                - $this->attributes['wastage_fe'] 

                                                - $this->attributes['tounch_in'] 
                                                - $this->attributes['fire_tounch_in'] 
                                                - $this->attributes['ghiss']
                                                - $this->attributes['hcl_ghiss'] 
                                                - $this->attributes['pending_ghiss'] 
                                                - $this->attributes['loss']
                                                - $this->attributes['karigar_loss']
                                                - $this->attributes['pending_loss']

                                                - $this->attributes['next_department_wastage']

                                                - $this->attributes['gpc_out']
                                                - $this->attributes['repair_outrepair_out'],10); -->
