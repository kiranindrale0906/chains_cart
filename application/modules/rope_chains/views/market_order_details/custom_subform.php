<tr class="table_custom_market_order_<?=$index ?>">
              <td>
              <?php load_field('hidden', array('field'  => 'market_order_id','value'=>@$record['market_order_id'],'index' => $index,'controller'=>'custom_market_order_details')); ?>
                  <?php load_field('plain/text', array('field' => 'design_name',
                                              'index' => $index,
                                             'controller' => 'custom_market_order_details',
                                             'id' => 'design_name_'.$index,
                                             'class'=>'',
                                             'onkeyup' => 'on_change_market_design_name('.$index.','.$this->router->module.')')); ?>
              </td> 
              </td><td>
              
                  <?php load_field('plain/text', array('field' => 'description',
                                                 'index' => $index,'controller'=>'custom_market_order_details',
                                                 )); ?>
              </td>
              <td>
              
                  <?php load_field('plain/text', array('field' => 'inch_size',
                                                 'index' => $index,'controller'=>'custom_market_order_details',
                                                 )); ?>
              <td>
              
                  <?php load_field('plain/text', array('field' => 'inch_qty',
                                                 'index' => $index,'controller'=>'custom_market_order_details',
                                                 )); ?>
              </td>
              
              
  <td>
    <?= getJsButton('Delete', 'javascript:void(0)', 'btn_red', '', 'delete_custom_market_order('.$index.')'); ?>
  </td>

</tr>