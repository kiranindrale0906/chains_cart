<h5 class="heading">CZ Processes </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue cz_wastage_select_all')); ?></th>
      <th>Chain Name</th>
      <th>Process Name</th>
      <th>Department Name</th>
      <th>Lot No</th>
      <th>Design Code</th>
      <th>CZ Wastage</th>
      <th>Balance CZ Wastage</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($processes as $index => $process) {
        $this->load->view('cz_processes/subform',
                          array('index'=> $index, 'process' => $process));
      }
    ?>
  </tbody>
</table>