<h5 class="heading">Daily Drawer Processes </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue daily_drawer_wastage_select_all')); ?></th>
      <th>Chain Name</th>
      <th>Process Name</th>
      <th>Department Name</th>
      <th>Lot No</th>
      <th>Design Code</th>
      <th>Daily Drawer Wastage</th>
      <th>Balance Daily Drawer Wastage</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($processes as $index => $process) {
        $this->load->view('daily_drawer_processes/subform',
                          array('index'=> $index, 'process' => $process));
      }
    ?>
  </tbody>
</table>