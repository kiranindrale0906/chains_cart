<tr class="table_market_order_<?=$index ?>">
              <td>
              <?php load_field('hidden', array('field'  => 'market_order_id','value'=>@$record['market_order_id'],'index' => $index,'controller'=>'market_order_details')); ?>
                  <?php load_field('plain/text', array('field' => 'design_name',
                                              'index' => $index,
                                             'controller' => 'market_order_details',
                                             'id' => 'design_name_'.$index,
                                             'class'=>'',
                                             'onkeyup' => 'on_change_market_design_name('.$index.',this)')); ?>
              </td> 
              <td>
              
                  <?php load_field('plain/text', array('field' => 'description',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td><td>
              
                  <?php load_field('plain/text', array('field' => '14_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
              
                  <?php load_field('plain/text', array('field' => '15_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '16_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '17_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '18_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '19_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '20_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 ));?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '21_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 ));?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '22_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '23_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '24_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '25_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '26_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '27_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '28_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '29_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 )); ?>
              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '30_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 ));?>

              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '31_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 ));?>

              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '32_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 ));?>

              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '33_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 ));?>

              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '34_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 ));?>

              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '35_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 ));?>

              </td>
              <td>
                  <?php load_field('plain/text', array('field' => '1_inch_qty',
                                                 'index' => $index,'controller'=>'market_order_details',
                                                 ));?>

              </td>
              
  <td>
    <?= getJsButton('Delete', 'javascript:void(0)', 'btn_red', '', 'delete_market_order('.$index.')'); ?>
  </td>

</tr>