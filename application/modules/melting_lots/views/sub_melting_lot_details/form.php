<div class="table-responsive">
  <table class="table table-sm table-default fixedTable_js table-bordered table-striped">
    <thead> 
        <tr> 
          <th>Process</th>
          <th>Parent Lot No</th>
          <th>Lot No</th>
          <th>Description</th>
          <th class="text-right">Purity (%)</th>
          <?php if(HOST=='ARC'){ ?>
            <th class="text-right">Tone</th>
          <?php } elseif(HOST=='ARF'){ ?>
            <th>Colour</th>
          <?php }?>
          <th class="text-right">In Weight</th>
          <th class="text-right">Total Alloy Weight</th>
          <th class="text-right">Required Weight</th>
          <th class="text-right">Required Alloy Weight</th>
        </tr>
    </thead>
    <tbody class="sub_melting_lot_details">
      <?php if(!empty($melting_lot_details)) {
        $total_in_weight=0;
        foreach ($melting_lot_details as $index => $melting_lot_detail) { 
          if(($melting_lot_detail['product_name']!='HCL'||
              $melting_lot_detail['process_name']!='HCL Melting Process'||
              $melting_lot_detail['tounch_purity']!=0)&& 
             ($melting_lot_detail['product_name']!='Daily Drawer'|| 
              $melting_lot_detail['process_name']!='Melting' || 
              $melting_lot_detail['tounch_purity']!=0) &&
             ($melting_lot_detail['product_name']!='Ghiss Out'||
              $melting_lot_detail['process_name']!='Melting'||
              $melting_lot_detail['tounch_purity']!=0) && 
             ($melting_lot_detail['product_name']!='HCL Ghiss Out'|| 
              $melting_lot_detail['process_name']!='Melting'|| 
              $melting_lot_detail['tounch_purity']!=0)){
                $total_in_weight+=$melting_lot_detail['in_weight'];
         ?>
          <tr>            
              <td>
                <?= $melting_lot_detail['process_name'];
                    load_field('hidden',array('field' => 'process_id', 'class'=>'text-right',
                                              'controller' => 'melting_lot_details',
                                              'value' => $melting_lot_detail['process_id'],
                                              'name' => 'melting_lot_details['.$index.'][process_id]'));
                    load_field('hidden',array('field' => 'process_name', 'class'=>'text-right',
                                              'controller' => 'melting_lot_details',
                                              'value' => $melting_lot_detail['process_name'],
                                              'name' => 'melting_lot_details['.$index.'][process_name]')); ?>
              </td>
              <td><?= $melting_lot_detail['parent_lot_name'];?></td>
              <td><?= $melting_lot_detail['lot_no'];?></td>
              <td><?= $melting_lot_detail['description'];?></td>
              <td class="text-right in_purity">
                <?= $melting_lot_detail['in_purity'];              
                    load_field('hidden',array('field' => 'in_purity', 'class'=>'text-right',
                                              'controller' => 'melting_lot_details',
                                              'value' => $melting_lot_detail['in_purity'],
                                              'name' => 'melting_lot_details['.$index.'][in_purity]')); ?>
              </td>
              <?php if(HOST=='ARC'){?>
                <td><?= $melting_lot_detail['tone'];?></td>
              <?php } elseif(HOST=='ARF'){?>
                <td><?= $melting_lot_detail['melting_lot_category_two'];?></td>
              <?php }?>

               <td class="text-right in_weight">
                <span onclick="check_nearest_checkbox(this)">
                  <?= round($melting_lot_detail['in_weight'],4);
                      load_field('hidden',array('field' => 'in_weight', 'class'=>'text-right',
                                                'controller' => 'melting_lot_details',
                                                'value' => $melting_lot_detail['in_weight'],
                                                'name' => 'melting_lot_details['.$index.'][in_weight]')); ?>
                </span>
              </td>
              <td class="text-right total_alloy_weight">
                 <?php 
                  $pure_gold_weight = $melting_lot_detail['in_weight'] * $melting_lot_detail['in_purity'] / 100;
                  $total_weight =0;
                  if(!empty($melting_lot['lot_purity'])){
                    $total_weight = $pure_gold_weight / $melting_lot['lot_purity'] * 100;
                  }
                  $max_alloy_weight = $total_weight - $melting_lot_detail['in_weight'];
                  echo round($max_alloy_weight, 4); 
                ?>
              </td>
              <td class="text-right">
                <span onclick="check_nearest_checkbox(this)">
                  <?php if($melting_lot_detail['product_name'] ='Machine Chain') {
                          load_field('plain/text',array('field' =>'required_weight',
                                                      'controller' => 'melting_lot_details',
                                                      'class' =>'text-right required_weight',
                                                      'name' =>'melting_lot_details['.$index.'][required_weight]'));
                        }else{?>
                  <?php load_field('plain/text',array('field' =>'required_weight',
                                                      'readonly' => 'readonly',
                                                      'controller' => 'melting_lot_details',
                                                      'class' =>'text-right required_weight',
                                                      'name' =>'melting_lot_details['.$index.'][required_weight]')); 
                        } ?>
                </span>
              </td>
              <td class="text-right required_alloy_weight">0
                <!-- <?php load_field('plain/text',array('field' =>'required_alloy_weight',
                                                    'class'=>'text-right',
                                                    'name' =>'melting_lot_details['.$index.'][gross_weight]',
                                                    'class'=>'melting_lot_weight',
                                                    'id'=>$index));?> -->              
              </td>
            </tr>

          <?php  }  ?>  
        <?php  }  ?> 
        <tr class="bold">
          <td>Total</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <?php if(HOST=='ARF'){?>
            <td></td>
          <?php }?>
          <td class="text-right"><?=$total_in_weight?></td>
          <td></td>
          <td></td>
          <td></td>
        </tr> 
      <?php  }  ?>
    </tbody>
    <?php $this->load->view('melting_lots/melting_lots/subform'); ?>
  </table>
  <?php $this->load->view('melting_lots/sub_melting_lot_details/alloy_details_form'); ?>

  <?php $this->load->view('melting_lots/sub_melting_lot_details/melting_lot_without_tounch_purity_form'); ?>
</div>

    
