<form method="post" class="form-horizontal fields-group-sm" enctype="multipart/form-data" id="project_template"
      action="<?= get_form_action($controller, $action, $record) ?>">
<div class="table-responsive">
  <table class="table table-sm table-default fixedTable_js table-bordered table-striped">
    <thead> 
        <tr> 
            <th>Chain Name</th>
            <th>Process Name</th>
            <th>Category One</th>
            <th>Machine Size</th>
            <th>Design Code</th>
            <th>Karigar</th>
            <th>Description</th>
            <th class="text-right">Purity (%)</th>
            <th class="text-right">In Weight</th>
            <!-- <th class="text-right">Total Alloy Weight</th> -->
            <th class="text-right">Required Weight</th>
            <th class="text-right">Required Alloy Weight</th>
            <th class="text-right">Created By</th>
          </tr>
      </tr>
    </thead>
    <tbody class="melting_lot_details">
      <?php 
        load_field('hidden',array('field' => 'melting_lot_id', 'class'=>'text-right',
                                             'controller' => 'melting_lot_details',
                                             'value' => $melting_lot_id,
                                             'name' => 'melting_lot_id'));
      if(!empty($melting_lot_details)) {
        foreach ($melting_lot_details as $index => $melting_lot_detail) { ?>
          <tr>    
            <td><?= $melting_lot_detail['product_name'] ?></td>        
              <td>
                <?= $melting_lot_detail['process_name'];
                    load_field('hidden',array('field' => 'process_id', 'class'=>'text-right',
                                              'controller' => 'melting_lot_details',
                                              'value' => $melting_lot_detail['process_id'],
                                              'name' => 'melting_lot_details['.$index.'][process_id]'));
                    load_field('hidden',array('field' => 'melting_lot_id', 'class'=>'text-right',
                                              'controller' => 'melting_lot_details',
                                              'value' => $melting_lot_id,
                                              'name' => 'melting_lot_details['.$index.'][melting_lot_id]'));
                    
                    load_field('hidden',array('field' => 'lot_purity', 'class'=>'text-right out_lot_purity',
                                              'controller' => 'melting_lot_details',
                                              'value' =>isset($_GET['out_lot_purity'])?$_GET['out_lot_purity']:$melting_lot_detail['in_purity'] ,
                                              'name' => 'out_lot_purity'));
                    load_field('hidden',array('field' => 'process_name', 'class'=>'text-right',
                                              'controller' => 'melting_lot_details',
                                              'value' => $melting_lot_detail['process_name'],
                                              'name' => 'melting_lot_details['.$index.'][process_name]')); ?>
              </td>
              <td><?= $melting_lot_detail['melting_lot_category_one'] ?></td>        
              <td><?= $melting_lot_detail['machine_size'] ?></td>        
              <td><?= $melting_lot_detail['design_code'] ?></td>        
              <td><?= $melting_lot_detail['karigar_name'] ?></td>        
              <td><?= $melting_lot_detail['description'];              
                    load_field('hidden',array('field' => 'description', 'class'=>'text-right',
                                              'controller' => 'melting_lot_details',
                                              'value' => $melting_lot_detail['description'],
                                              'name' => 'melting_lot_details['.$index.'][description]')); ?>
              </td>
              <td class="text-right melting_detail_in_purity">
                <?= $melting_lot_detail['in_purity'];              
                    load_field('hidden',array('field' => 'in_purity', 'class'=>'text-right',
                                              'controller' => 'melting_lot_details',
                                              'value' => $melting_lot_detail['in_purity'],
                                              'name' => 'melting_lot_details['.$index.'][in_purity]')); ?>
              </td>
               <td class="text-right melting_detail_in_weight">
                <span onclick="check_nearest_checkbox(this)">
                  <?= round($melting_lot_detail['in_weight'],4);
                      load_field('hidden',array('field' => 'in_weight', 'class'=>'text-right',
                                                'controller' => 'melting_lot_details',
                                                'value' => $melting_lot_detail['in_weight'],
                                                'name' => 'melting_lot_details['.$index.'][in_weight]')); ?>
                </span>
              </td>
              <!-- <td class="text-right total_melting_detail_alloy_weight">
                <?php 
                  // $pure_gold_weight = $melting_lot_detail['in_weight'] * $melting_lot_detail['in_purity'] / 100;
                  // $total_weight =0;
                  // if(!empty($melting_lot['lot_purity'])){
                  //   $total_weight = $pure_gold_weight / $melting_lot['lot_purity'] * 100;
                  // }
                  // $max_alloy_weight = $total_weight - $melting_lot_detail['in_weight'];
                  // echo round($max_alloy_weight, 4); 
                ?> 
              </td> -->
              <td class="text-right">
                <span onclick="check_nearest_checkbox(this)">
                  <?php load_field('plain/text',array('field' =>'required_weight',
                                                      'controller' => 'melting_lot_details',
                                                      'class' =>'text-right melting_detail_required_weight',
                                                      'name' =>'melting_lot_details['.$index.'][required_weight]')); ?>
                </span>
              </td>
              <td class="text-right melting_detail_required_alloy_weight">0
                <!-- <?php load_field('plain/text',array('field' =>'melting_detail_required_alloy_weight',
                                                    'class'=>'text-right',
                                                    'name' =>'melting_lot_details['.$index.'][gross_weight]',
                                                    'class'=>'melting_lot_weight',
                                                    'id'=>$index));?> -->              
              </td>
             <td><?= $melting_lot_detail['created_by'] ?></td> 
            </tr>
        <?php  }  ?>  
      <?php  }  ?>
      <?php //pd(validation_errors(),0); ?>
    </tbody>
    <?php //$this->load->view('melting_lots/melting_lots/subform'); ?>

  </table>
   <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</div>
</form>
 
    