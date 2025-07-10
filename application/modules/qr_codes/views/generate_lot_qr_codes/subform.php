<tr class="generate_lot_qr_codes_<?= $index ?>">
<?php 
  if($order['type_of_order'] =='export_order'){

  $image_path = ($order['create_flag'] == 1) ? ADMIN_PATH.'uploads/original/original/' : 'https://export-orders.ar-gold.in/uploads/orders/original/';
                  
  }elseif($order['type_of_order'] =='swarnshilp_order'){

  $image_path = ($order['create_flag'] == 1) ? ADMIN_PATH.'uploads/original/original/' : 'https://swarnshilp.ascra.in/uploads/';
                  
  }else{

  $image_path = ($order['create_flag'] == 1) ? ADMIN_PATH.'uploads/original/original/' : 'https://argold-catalog.8848digital.com/';
  }
  ?>
  <td>
    <?php load_field('plain/text', array('field' => 'item_code',
                                   'index' => $index,
                                   'readonly' => 'readonly',
                                   'value' => $order['item_code'],
                                   'horizontal'=>true,  
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'generate_lot_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td>
    <?php load_field('plain/text', array('field' => 'weight',
                                   'index' => $index,
                                   'horizontal'=>true, 
                                   'id'=>'generate_lot_weight_'.$index, 
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'generate_lot_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td>
    <?php load_field('plain/text', array('field' => 'length',
                                   'index' => $index,'value' => $order['size'],
                                   'horizontal'=>true,'readonly' => 'readonly',
                                   'id'=>'generate_lot_length_'.$index,
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'generate_lot_qr_code_details',
                                   'form_group_class'=>'mb-0'));
    ?>
  </td>
  <td>
    <?php  load_field('plain/text', array('field' => 'dispatch_weight',
                                   'index' => $index,
                                   'id'=>'generate_lot_dispatch_weight_'.$index,
                                   'horizontal'=>true,  
                                   'readonly'=>'readonly',
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'generate_lot_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td>
    <?php  load_field('plain/text', array('field' => 'net_weight',
                                   'index' => $index,
                                   'id'=>'generate_lot_net_weight_'.$index,
                                   'horizontal'=>true,  
                                   'readonly'=>'readonly',
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'generate_lot_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td>
    <?php  load_field('plain/text', array('field' => 'less',
                                   'index' => $index,
                                   'id'=>'generate_lot_less_'.$index,
                                   'horizontal'=>true,
                                   'readonly'=>'readonly', 
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'generate_lot_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td> 
  <td>
    <?php  load_field('plain/text', array('field' => 'total_stone',
                                   'index' => $index,

                                   'horizontal'=>true,
                                   'id'=>'generate_lot_total_stone_'.$index,
                                   'readonly'=>'readonly',  
                                   'class'=>'generate_lot_change_total_stone',  
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'generate_lot_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>  
  <td>
    <?php  load_field('plain/text', array('field' => 'stone_weight',
                                   'index' => $index,
                                   'horizontal'=>true, 

                                   'id'=>'generate_lot_stone_weight_'.$index, 
                                   'onkeyup'=>'change_generate_lot_stone('.$index.')',
                                   'col'=>'col-lg-6 col-md-6',
                                   'class'=>'generate_lot_change_stone',
                                   'controller' => 'generate_lot_qr_code_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td>
    <?php  load_field('plain/text', array('field' => 'other_stone',
                                   'index' => $index,
                                   'horizontal'=>true,
				  'onkeyup'=>'change_generate_lot_other_stone('.$index.')',
                                   'id'=>'generate_lot_other_stone_'.$index,
                                   'col'=>'col-lg-6 col-md-6',
                                   'class'=>'generate_lot_other_stone',
                                   'controller' => 'generate_lot_qr_code_details',
                                   'form_group_class'=>'mb-0'));
    ?>
  </td>
 <td> <?php  load_field('plain/hidden', array('field' => 'image',
                                   'index' => $index,
                                   'horizontal'=>true,
                                   'id'=>'generate_lot_other_stone_'.$index,
                                   'col'=>'col-lg-6 col-md-6','value' => $order['image'],
                                   'class'=>'generate_lot_other_stone',
                                   'controller' => 'generate_lot_qr_code_details',
                                   'form_group_class'=>'mb-0'));
    ?>

    <img class="show_img_popup" src="<?= $image_path.trim($order['image'],",") ?>" width=70 height=70/>
  </td>
  
</tr>
<div class="modal fade bd-example-modal-lg" id="ima_popup_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" id="img_popup_box"></div>
      </div>
    </div>
  </div>
</div>
