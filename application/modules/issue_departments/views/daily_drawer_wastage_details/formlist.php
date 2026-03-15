<h5 class="heading">Daily Drawer Wastages </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Department Name</th>
      <th>Process</th>
      <th>Quantity</th>
      <th>Daily Drawer Wastage</th>
      <th>Balance Daily Drawer Wastage</th>
      <th>Out Weight</th>
      <th>Gross Weight</th>
      <th>Purity</th>
      <th>Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $balance_daily_drawer_wastage=$daily_drawer_wastage=0;
      foreach ($processes as $index => $process) {
        $daily_drawer_wastage+=$process['daily_drawer_wastage'];
        $balance_daily_drawer_wastage+=$process['balance_daily_drawer_wastage'];
        $this->load->view('daily_drawer_wastage_details/subform',
                          array('index'=> $index, 'process' => $process));
      }
    ?>
    <tr class="bg_gray bold">
      <td>Total</td>
      <td></td>
      <td></td>
      <td></td>
      <td><?= $daily_drawer_wastage?></td>
      <td><?= $balance_daily_drawer_wastage ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>