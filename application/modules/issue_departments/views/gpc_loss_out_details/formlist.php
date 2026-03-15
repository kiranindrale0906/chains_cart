<h5 class="heading">GPC Repair Out </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Lot No</th>
      <th>Tone</th>
      <th>Product Name</th>
      <th>Design Code</th>
      <th>Chitti Design Name</th>
      <th>Tounch Purity</th>
      <th>Chain</th>
      <th>Customer Name</th>
      <th>GPC Out</th>
      <th>Balance GPC Out</th>
      <th>GPC Loss Out</th>
      <th>Out GPC Loss Out</th>
      <th>Purity</th>
      <th>Fine</th>
      <th>Wastage</th>
      <th>Chitti Purity</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $out_weight=$balance_gpc_out=0;
      foreach ($processes as $index => $process) {
        $out_weight+=$process['gpc_out'];
        $balance_gpc_out+=$process['balance_gpc_out'];
        $this->load->view('gpc_loss_out_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
    <tr class="bg_gray bold">
      <td>Total</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?= $out_weight?></td>
      <td><?= $balance_gpc_out?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>