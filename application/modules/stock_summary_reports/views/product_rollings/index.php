<?php 
if($show_form){ ?>
  <div class="boxrow mb-2">
    <div class="float-left">
      <h6 class="heading blue bold text-uppercase mb-0"><?= @getTableSettings()['page_title']; ?></h6>
    </div>
  </div
 } ?>



<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue pending_loss_from_hook_select_all')); ?></th>
      <th>Date</th>
      <th>Lot No</th>
      <th>Design Code</th>
      <th>In Weight</th>
      <th>Out Weight</th>
      <th>Hook</th>
      <th>Loss</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($processes as $index => $process) {
        $this->load->view('pending_loss_from_hooks/subform',
                          array('index'=> $index, 'process' => $process));
      }
    ?>
  </tbody>
</table>