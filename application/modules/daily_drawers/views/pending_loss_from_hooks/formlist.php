<h5 class="heading">Daily Drawer Processes </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue pending_loss_from_hook_select_all')); ?></th>
      <th>Date</th>
      <th>Lot No</th>
      <th>Product Name</th>
      <th>Design Code</th>
      <th>Purity</th>
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