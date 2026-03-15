<tr class="table_wastage_<?=$index ?>">
              
              <?php load_field('hidden', array('field'  => 'wastage_master_id','value'=>@$record['wastage_master_id'],'index' => $index,'controller'=>'wastage_details')); ?>
             <td>
              
                  <?php load_field('plain/text', array('field' => 'chain',
                                                 'index' => $index,
                                                 'controller'=>'wastage_details',
                                                 // 'option'=>$chains
                                                 )); ?>
              </td>
              <td>
              
                  <?php load_field('plain/text', array('field' => 'category_name',
                                                 'index' => $index,
                                                 'controller'=>'wastage_details',  )); ?>
              </td><td>
              
                  <?php load_field('plain/text', array('field' => 'tone',
                                                 'index' => $index,
                                                 'controller'=>'wastage_details',
                                                 //'option'=>$tones
                                                 )); ?>
              </td><td>
              
                  <?php load_field('plain/text', array('field' => 'purity',
                                                 'index' => $index,
                                                 'controller'=>'wastage_details',
                                                 //'option'=>$purities
                                                 )); ?>
              </td><td>
              
                  <?php load_field('plain/text', array('field' => 'machine_size',
                                                 'index' => $index,
                                                 'controller'=>'wastage_details',
                                                 //'option'=>$machine_sizes

                                                 )); ?>
              </td> <td>
              
                  <?php load_field('plain/text', array('field' => 'design',
                                                 'index' => $index,
                                                 'controller'=>'wastage_details',
                                                 //'option'=>$designs
                                                 )); ?>
              </td> <td>
              
                  <?php load_field('plain/text', array('field' => 'wastage',
                                                 'index' => $index,
                                                 'controller'=>'wastage_details',
                                                 )); ?>
              </td> <td>
              
                  <?php load_field('plain/text', array('field' => 'factory_purity',
                                                 'index' => $index,
                                                 'controller'=>'wastage_details',
                                                 )); ?>
              </td> <td>
              
                  <?php load_field('plain/text', array('field' => 'sequance',
                                                 'index' => $index,
                                                 'controller'=>'wastage_details',
                                                 )); ?>
              </td> 
              <td>
    <?= getJsButton('Delete', 'javascript:void(0)', 'btn_red', '', 'delete_wastage_master('.$index.')'); ?>
  </td>

</tr>