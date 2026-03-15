<tr class="yellow_qr_codes_<?= $index ?>">
  <td>
    <?php load_field('plain/text', array('field' => 'item_code',
                                   'index' => $index,
                                   'horizontal'=>true, 
                                   'id'=>'yellow_weight_'.$index, 
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'yellow_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?> 
    </td>    
  <td>
    <?php load_field('plain/text', array('field' => 'weight',
                                   'index' => $index,
                                   'horizontal'=>true, 
                                   'id'=>'yellow_weight_'.$index, 
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'yellow_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?> 
    </td>    
    <td>    
    <?php  load_field('plain/text', array('field' => 'dispatch_weight',
                                   'index' => $index,
                                   'id'=>'yellow_dispatch_weight_'.$index,
                                   'horizontal'=>true,  
                                   'readonly'=>'readonly',
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'yellow_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td>
    <?php  load_field('plain/text', array('field' => 'net_weight',
                                   'index' => $index,
                                   'id'=>'yellow_net_weight_'.$index,
                                   'horizontal'=>true,  
                                   'readonly'=>'readonly',
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'yellow_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td>
    <?php  load_field('plain/text', array('field' => 'less',
                                   'index' => $index,
                                   'id'=>'yellow_less_'.$index,
                                   'horizontal'=>true,
                                   'readonly'=>'readonly', 
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'yellow_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td> 
  <td>
    <?php  load_field('plain/text', array('field' => 'total_stone',
                                   'index' => $index,

                                   'horizontal'=>true,
                                   'id'=>'yellow_total_stone_'.$index,
                                   'readonly'=>'readonly',  
                                   'class'=>'yellow_change_total_stone',  
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'yellow_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>  
  <td>
    <?php  load_field('plain/text', array('field' => 'km',
                                   'index' => $index,

                                   'horizontal'=>true,
                                   'id'=>'yellow_km_'.$index,
                                   'class'=>'yellow_change_km',  
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'yellow_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>  
  <td>
    <?php  load_field('plain/text', array('field' => 'stone_weight',
                                   'index' => $index,
                                   'horizontal'=>true, 

                                   'id'=>'yellow_stone_weight_'.$index, 
                                   'onkeyup'=>'change_yellow_stone('.$index.')',
				                           'col'=>'col-lg-6 col-md-6',
				                           'class'=>'yellow_change_stone',
                                   'controller' => 'yellow_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  

  <td>
    <?php  load_field('plain/text', array('field' => 'other_stone',
                                   'index' => $index,
                                   'horizontal'=>true,
                                   
                                   'id'=>'yellow_other_stone_'.$index,  
                                   'onkeyup'=>'change_yellow_other_stone('.$index.')',
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'yellow_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td>
    <?= getJsButton('Delete', 'javascript:void(0)', 'btn_red', '', 'delete_yellow_qr_codes('.$index.')'); ?>
    
  </td>

</tr>
