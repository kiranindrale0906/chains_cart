<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
        load_field('dropdown', array('field' => 'product_name',
                                     'option' => get_issue_department_product_names()));
      if(!empty($record['product_name']) 
         && ($record['product_name']=='GPC Out' || 
             $record['product_name']=='Finish Good' || 
             $record['product_name']=='Hallmark Out' || 
             $record['product_name']=='GPC Repair Out' || 
             $record['product_name']=='GPC Loss Out')){ ?>
        <?php load_field('dropdown', array('field' => 'chain_purity',
                                           'option' => $chain_purity));?>
        <?php if($record['product_name']=='GPC Out'){
          //if(HOST=='ARF'){?>
          <?php load_field('dropdown', array('field' => 'customer_name',
                                           'option' => $customer_name));?>
      <?php }}?>
      <?php
        if(!empty($record['product_name']) 
            && ($record['product_name']=='GPC Repair Out')){ ?>
        <?php load_field('dropdown', array('field'  => 'hook_kdm_purity',
                                           'option' => $hook_kdm_purity));?>
      <?php }?>
      <?php 
        if(!empty($record['product_name']) && $record['product_name']=='Castic Loss'){ ?>                                    
          <?php load_field('dropdown', array('field' => 'category_one',
                                             'option' => $castic_loss_categories));?>
       <?php  if(!empty($record['category_one']) ){?>                                      
          <?php load_field('dropdown', array('field' => 'parent_lot_name',
                                             'option' => $parent_lot_name));?>
        
      <?php }}  ?>
      <?php 
        if(!empty($record['product_name']) && $record['product_name']=='QC Out'){ ?>                                    
          <?php load_field('dropdown', array('field' => 'category_one',
                                             'option' => $domestic_categories));?>
               
      <?php }?>
      <?php if(!empty($record['product_name'])&& ($record['product_name']=='Ghiss Melting Loss')){ ?>
        <?php load_field('dropdown', array('field' => 'department_name',
                                           'option' => $department_name));
    }?>
    <?php load_field('dropdown', array('field' => 'account_id','option'=>$account_names));?> 
  <?php /*}elseif($record['product_name']!='Hallmark Out'){?>
    <?php load_field('text', array('field' => 'account_id','class'=>'autocomplete_account'));*/?> 
    <?php //load_field('dropdown', array('field' => 'company_name','option'=>get_issue_department_comapny_name()));?>           
    <?php //load_field('text', array('field' => 'issue_type'));?>
    <?php if(!empty($record['account_id'])&& (in_array($record['account_id'],array("ARF Software","ARF Software (May 2022)","ARC Software (May 2022)","AR Gold Software (May 2022)", "ARF Software (Aug 2022)","ARC Software (Aug 2022)","AR Gold Software (Aug 2022)"))) && HOST!="Export"){ ?>
        <?php load_field('dropdown', array('field' => 'internal_wastage',
                                           'option' => $internal_wastages));
    }?>
    <?php load_field('text', array('field' => 'description'));?>
    <?php load_field('text', array('field' => 'in_weight',
                                   'readonly' => true,));?>
    <?php load_field('text', array('field' => 'in_purity',
                                   'readonly' => true)); ?>
    <?php load_field('text', array('field' => 'in_fine',
                                   'readonly' => true));?>
    <?php 
    if($record['product_name'] == 'Hallmark Out' || $record['product_name'] == 'GPC Out'){
    load_field('text', array('field' => 'quantity',
                                   'readonly' => true)); 
    }?>
    
    <?php 
      if($record['product_name'] != 'Daily Drawer Wastage' && 
         $record['product_name'] != 'Melting Wastage' && 
         $record['product_name'] != 'HCL Loss' && 
         $record['product_name'] != 'Refine Loss' && 
         $record['product_name'] != 'Tounch Loss Fine' && 
         $record['product_name'] != 'Cutting Ghiss' && 
         $record['product_name'] != 'Ice Cutting Ghiss' && 
         $record['product_name'] != 'Hand Cutting Ghiss' && 
         $record['product_name'] != 'Hand Dull Ghiss' && 
         $record['product_name'] != 'Sand Dull Ghiss' && 
         $record['product_name'] != 'Chitti Out' && 
         $record['product_name'] != 'GPC Out' && 
         $record['product_name'] != 'Hallmark Out' && 
         $record['product_name'] != 'Hallmark Receipt' && 
         $record['product_name'] != 'GPC Repair Out' &&
         $record['product_name'] != 'GPC Loss Out' && 
         $record['product_name'] != 'Huid' && 
         $record['product_name'] != 'QC Out' && 
         $record['product_name'] != 'Domestic Internal' && 
         $record['product_name'] != 'Export Internal' && 
         $record['product_name'] != 'Packing Slip' && 
         $record['product_name'] != 'Ghiss Melting Loss' && 
         $record['product_name'] != 'Fire Tounch Loss') {

        if (!empty($record['product_name']) && 
            ($record['product_name'] == 'GPC Out' || 
             $record['product_name'] == 'Finish Good' || 
             $record['product_name'] == 'Hallmark Out' || 
             $record['product_name'] == 'Hallmark Receipt' || 
             $record['product_name'] == 'GPC Repair Out' || 
             $record['product_name'] == 'GPC Loss Out'))
          load_field('text', array('field' => 'out_purity', 'readonly' => true));
        else 
          load_field('text', array('field' => 'out_purity'));
          load_field('text', array('field' => 'wastage_percentage',
                                   'readonly' => true));
          load_field('text', array('field' => 'out_fine',
                                   'readonly' => true,));
      } 
    ?>
    <?php load_field('hidden', array('field' => 'field_name',
                                     'name' => 'field_name',
                                     'value' => @$record['product_name']));?>

    <?php 
     if($record['product_name'] == 'GPC Out'){
      load_field('text', array('field' => 'wastage_fine','readonly' => true,
                               'name' => 'wastage_fine'));
     }?>
  </div>
  <hr>
  <?php
    if (isset($processes) && !empty($processes)) {
      if ($record['product_name'] == 'Melting Wastage') {
        $this->load->view('melting_wastage_details/formlist');
      } elseif($record['product_name'] == 'Daily Drawer Wastage') {
        $this->load->view('daily_drawer_wastage_details/formlist');
      } elseif($record['product_name'] == 'HCL Loss') {
        $this->load->view('hcl_loss_details/formlist');
      }elseif($record['product_name'] == 'Refine Loss') {
        $this->load->view('refine_loss_details/formlist');
      } elseif($record['product_name'] == 'Tounch Loss Fine') {
        $this->load->view('tounch_loss_fine_details/formlist');
      } elseif($record['product_name'] == 'Cutting Ghiss' || 
               $record['product_name'] == 'Hand Cutting Ghiss' || 
               $record['product_name'] == 'Hand Dull Ghiss' || 
               $record['product_name'] == 'Sand Dull Ghiss' || 
               $record['product_name'] == 'Ice Cutting Ghiss') {
        $this->load->view('cutting_ghiss_details/formlist');
      } elseif($record['product_name'] == 'GPC Out'|| 
               // $record['product_name'] == 'QC Out'|| 
               $record['product_name'] == 'Finish Good') {
        $this->load->view('gpc_details/formlist');
      } elseif($record['product_name'] == 'GPC Repair Out') {
        $this->load->view('gpc_repair_out_details/formlist');
      } elseif($record['product_name'] == 'GPC Loss Out') {
        $this->load->view('gpc_loss_out_details/formlist');
      } elseif($record['product_name'] == 'Ghiss Melting Loss') {
        $this->load->view('ghiss_melting_loss_details/formlist');
      } elseif($record['product_name'] == 'Castic Loss') {
        $this->load->view('castic_loss_details/formlist');
      } elseif($record['product_name'] == 'Finished Goods Receipt') {
        $this->load->view('finished_goods_receipt_details/formlist');
      } elseif($record['product_name'] == 'Export Internal'||$record['product_name'] == 'Domestic Internal') {
        $this->load->view('export_internal_details/formlist');
      }elseif($record['product_name'] == 'Packing Slip') {
        $this->load->view('packing_slip_details/formlist');
      }elseif($record['product_name'] == 'Fire Tounch Loss') {
        $this->load->view('fire_tounch_loss_details/formlist');
      } elseif($record['product_name'] == 'Chitti Out') {
        $this->load->view('issue_department_chitti_details/formlist');
      }elseif($record['product_name'] == 'Hallmark Out') {
        $this->load->view('hallmark_out_details/formlist');
      } else {
        $this->load->view('issue_department_details/formlist');
      }
    }
    // echo validation_errors();die;
  ?>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>
