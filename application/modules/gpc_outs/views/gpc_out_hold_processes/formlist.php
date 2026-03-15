<h5 class="heading">Gpc Out Hold Processes </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <?php if($_SESSION['name']=="GPC HOLD"){ ?>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue gpc_out_hold_select_all')); ?></th>
    <?php }?>

      <th>Chain Name</th>
      <th>Process Name</th>
      <th>Department Name</th>
      <th>Lot No</th>
      <th>Design Code</th>
      <th>GPC OUT</th>
      <th>User Name</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($processes as $index => $process) {
        $this->load->view('gpc_out_hold_processes/subform',
                          array('index'=> $index, 'process' => $process));
      }
    ?>
  </tbody>
</table>