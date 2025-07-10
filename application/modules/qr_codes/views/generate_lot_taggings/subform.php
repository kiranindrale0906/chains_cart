<?php 
  if($order['type_of_order'] =='export_order'){

  $image_path = ($order['create_flag'] == 1) ? ADMIN_PATH.'uploads/original/original/' : 'https://export-orders.ar-gold.in/uploads/orders/original/';
                  
  }elseif($order['type_of_order'] =='swarnshilp_order'){

  $image_path = ($order['create_flag'] == 1) ? ADMIN_PATH.'uploads/original/original/' : 'https://swarnshilp.ascra.in/uploads/';
                  
  }else{

  $image_path = ($order['create_flag'] == 1) ? ADMIN_PATH.'uploads/original/original/' : 'https://argold-catalog.8848digital.com/';
  }
  ?>
<tr class="order_<?= $order['id']?>">
  <td>
    <?php load_field('checkbox', array('field' => 'order_id',
                                       'class' => 'genarate_lot_id',
                                       'index' => $index,
                                       'option' => array(
                                                    array('chk_id' => $index,
                                                          'value' => $order['id'],
                                                          'label' => '',
                                                          'checked' => (!empty($orderes_out_wastage_details[$index]['id']) 
                                                                        ? 'checked' : ''))),
                                       'controller' => 'generate_lot_tagging_details'));?>
  </td>
  <td><?php echo $order['item_code'];?></td>
  <td><?php echo $order['bom_factory_code'];?></td>
  <td><?php echo $order['order_type'];?></td>
  <td><?php echo $order['customer_name'];?></td>
  <td>
    <?php load_field('plain/text', array('field' => 'length',
                                   'index' => $index,
                                   'value' => $order['size'],
                                   'readonly'=>'readonly',
                                   'horizontal'=>true,  
                                   'col'=>'col-25',
                                   'controller' => 'generate_lot_tagging_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td><?php echo $order['weight'];?></td>
  <td>
    <?php load_field('plain/text', array('field' => 'weight',
                                   'index' => $index,
                                   'onchange'=>'onchange_generate_lot_gross_weight('.$index.')',
                                   'horizontal'=>true,  
                                   'col'=>'col-25',
                                   'controller' => 'generate_lot_tagging_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  
  <td ><?php
   load_field('text', array('field' => 'quantity','col'=> 'col-25',
                                   'class' => 'balance_quantity','value'=>$order['rem_balance_quantity'],
                                   'index' => $index,
                                   'controller' => 'generate_lot_tagging_details')); ?>
  </td>
  <td class="rem_order_quantity"><?php echo $order['rem_balance_quantity'];?></td>
  <td class="order_quantity"><?php echo $order['balance_quantity'];?></td>
  <td>
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
