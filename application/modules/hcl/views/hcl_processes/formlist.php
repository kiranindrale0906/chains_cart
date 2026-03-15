<h5 class="heading">HCL Processes </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue hcl_wastage_select_all')); ?></th>
      <th>Chain Name</th>
      <th>Process Name</th>
      <th>Department Name</th>
      <th>Lot No</th>
      <th>Design Code</th>
      <th class="text-right">HCL Wastage</th>
      <th class="text-right">Balance </th>
      <th class="text-right">Balance Gross</th>
      <th class="text-right">Balance Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $hcl_wastage = 0;
      $balance = 0;
      $balance_gross = 0;
      $balance_fine = 0;
      foreach ($processes as $index => $process) {
        $hcl_wastage += $process['hcl_wastage'];
        $balance += $process['balance_hcl_wastage'];
        $balance_gross += $process['balance_hcl_wastage'] * $process['wastage_purity'] / 100;
        $balance_fine += $process['balance_hcl_wastage'] * $process['wastage_purity'] / 100 * $process['wastage_lot_purity'] / 100;
        $this->load->view('hcl_processes/subform',
                          array('index'=> $index, 'process' => $process));
      }
    ?>
  </tbody>
  <tfoot>
    <tr class="bg_gray">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="text-right"><?= four_decimal($hcl_wastage) ?></td>
      <td class="text-right"><?= four_decimal($balance) ?></td>
      <td class="text-right"><?= four_decimal($balance_gross) ?></td>
      <td class="text-right"><?= four_decimal($balance_fine) ?></td>
    </tr>
  </tfoot>
</table>