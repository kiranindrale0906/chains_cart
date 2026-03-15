<h5 class="heading">Process List</h5>
<div class="table-responsive">
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Date</th>
      <th>Narration</th>
      <th class="text-right">Tag No</th>
      <th class="text-right">Weight</th>
      <th class="text-right">Balance</th>
      <th class="text-right">Purity</th>
      <th class="text-right">Gross weight</th>
      <th class="text-right">Qauntity</th>
      <th class="text-right">Stone %</th>
      <th class="text-right">Stone</th>
      <th class="text-right">Making Charge</th>
      <th class="text-right">Category</th>
      <th class="text-right">Category-1</th>
      <th class="text-right">Colour</th>
      <th class="text-right">Code</th>
      <th class="text-right">Description</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $weight = $issue_fine = $balance = 0;
      foreach ($processes as $index => $process) {
        $weight += $process['accept_packing_list'];
        $balance += $process['balance'];
        $issue_fine += $process['in_weight']*$process['in_lot_purity']/100;
        $this->load->view('packing_slip_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
    <tr>
      <th>Total</th>
      <th></th>
      <th></th>
      <th></th>
      <th class="text-right"><?= four_decimal($weight) ?></th>
      <th class="text-right"><?= four_decimal($balance) ?></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </tbody>

</table>
</div>