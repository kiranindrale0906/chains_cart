<tr class="department_workers_<?= $index ?>">
  <td>
    <?php load_field('hidden', array('field' => 'id',
                                     'index' => $index,
                                     'controller' => 'department_workers')); ?>

    <?php load_field('plain/date', array('field' => 'date',
                                    'class'=>'datepicker_js',
                                   'index' => $index,
                                   'horizontal'=>true,  
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'department_workers',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td>
    <?php  load_field('plain/text', array('field' => 'worker_count',
                                   'index' => $index,
                                   'horizontal'=>true,  
                                   'col'=>'col-lg-6 col-md-6',
                                   'controller' => 'department_workers',
                                   'form_group_class'=>'mb-0')); 
    ?>     
  </td>
  <td>
    <?= getJsButton('Delete', 'javascript:void(0)', 'btn_red', '', 'delete_departments('.$index.')'); ?>
    <?php load_field('hidden', array('field' => 'delete',
                                     'controller' => 'department_workers',
                                     'index' => $index)); ?>
  </td>

</tr>