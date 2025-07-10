<tr class="table_bunch_order_<?= $index ?>">
              <td>
              <?php load_field('hidden', array('field'  => 'factory_order_id','value'=>@$record['factory_order_id'],'index' => $index,'controller'=>'bunch_order_details')); ?>
                  <?php load_field('plain/text', array('field' => 'design_name',
                                              'index' => $index,
                                             'controller' => 'bunch_order_details',
                                             'id' => 'design_name_'.$index,
                                             'class'=>'',
                                             'onkeyup' => 'on_change_bunch_market_design_name('.$index.',this)')); ?>
              </td> 
              
              <td>
              
                  <?php load_field('plain/text', array('field' => 'description','id' => 'description_'.$index,'class' => 'description','index' => $index,'controller'=>'bunch_order_details',
                                                 )); ?>
              </td>
              <td>
              
                  <?php load_field('plain/text', array('field' => 'bunch_weight','id' => 'bunch_weight_'.$index,'class' => 'bunch_weight','onkeyup' => 'onchange_bunch_weight('.$index.',this)',
                                                 'index' => $index,'controller'=>'bunch_order_details',
                                                 )); ?>
              </td>
              <td>
              
                  <?php load_field('plain/text', array('field' => 'bunch_length',
                                                 'index' => $index,'controller'=>'bunch_order_details',
                                                 'id' => 'bunch_length_'.$index,
                                                 'class' => 'bunch_length',
                                                 'onkeyup' => 'onchange_bunch_length('.$index.',this)'
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => 'per_inch_weight',
                                                 'id' => 'per_inch_weight_'.$index,
                                                 'readonly'=>true,
                                                 'index' => $index,'controller'=>'bunch_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => 'estimate_bunch_weight',
                                                 'index' => $index,'controller'=>'bunch_order_details',
                                                 'readonly'=>true,
                                                 'id' => 'estimate_bunch_weight_'.$index
                                                 )); ?>
              </td>
              
  <td>
    <?= getJsButton('Delete', 'javascript:void(0)', 'btn_red', '', 'delete_bunch_order('.$index.')'); ?>
  </td>

</tr>