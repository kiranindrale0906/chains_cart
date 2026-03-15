
  <?php
    $sr_no=0;
    if(isset($records)){
    foreach ($records as $row_id => $record) { 
      $process = @$record[$department_name]; 
      $sr_no++; ?>
      <div class="<?= get_row_id($row_id, $department_name); ?>">
        <?php 
        $this->load->view('form', array('process' => $process,
                                              'department_columns' => $department_columns,
                                              'sr_no' => $sr_no)); ?>
      </div>
    <?php }}else{ ?>


    <?php } ?>

<?php $this->load->view('processes/processes/tfoot', array('department_columns' => $department_columns));?>
