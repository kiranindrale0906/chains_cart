<h5 class="heading">Cutting Ghiss Out </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Product Name</th>
      <th>Lot No</th>
      <th>Design Code</th>
      <th>Ghiss</th>
      <th>Purity</th>
      <th>Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $ghiss=$ghiss_fine=0;
      foreach ($processes as $index => $process) {
        $ghiss+=$process['ghiss'];
        $ghiss_fine+=four_decimal((($process['ghiss'] * $process['out_lot_purity']) / 100));
        
        $this->load->view('cutting_ghiss_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
    <tr class="bg_gray bold">
      <td>Total</td>
      <td></td>
      <td></td>
      <td></td>
      <td><?= $ghiss?></td>
      <td></td>
      <td><?= $ghiss_fine ?></td>
    </tr>
  </tbody>
</table>