<tr class="karigar_rate_workers_<?= $index ?>">
  <td>
    <?php load_field('hidden', array('field' => 'id',
                                     'index' => $index,
                                     'controller' => 'karigar_rate_worker_details')); ?>

    <?php load_field('plain/date', array('field' => 'date',
                                    'class'=>'datepicker_js',
                                   'index' => $index,
                                   'horizontal'=>true,  
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'karigar_rate_worker_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td>
    <?php  load_field('plain/text', array('field' => 'no_of_workers',
                                   'index' => $index,
                                   'horizontal'=>true,  
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'karigar_rate_worker_details',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td>
    <?= getJsButton('Delete', 'javascript:void(0)', 'btn_red', '', 'delete_karigar_rate_workers('.$index.')'); ?>
    <?php load_field('hidden', array('field' => 'delete',
                                     'controller' => 'karigar_rate_worker_details',
                                     'index' => $index)); ?>
  </td>

</tr>