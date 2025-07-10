<h5 class="heading">GPC Out </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Lot No</th>
      <th>Tone</th>
      <?php if(HOST=='ARC'){ ?>
        <th>Category Name</th>
        <th>Sub Category Name</th>
      <?php } ?>
      <th>Product Name</th>
      <th>Design Code</th>
      <th>Chitti Design Name</th>
      <th>Tounch Purity</th>
      <th>Quantity</th>
      <th>Chain</th>
      <th>Customer Name</th>
      <th>GPC Out</th>
      <th>Balance GPC Out</th>
      <th>Balance Quantity</th>
      <th>Gross Weight</th>
      <th>Wastage</th>
      <th>Out GPC Out</th>
      <th>Out Quantity</th>
      <th>Purity</th>
      <th>Fine</th>
      <th>Wastage Fine</th>
      <th>Item Code</th>
      <th>Chitti Purity</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $out_weight=$balance_gpc_out=$wastage_fine=0;
      foreach ($processes as $index => $process) {
        $process['chain_margin']=!empty($process['chain_margin'])?$process['chain_margin']:0;
        $out_weight+=$process['gpc_out'];
        $balance_gpc_out+=$process['balance_gpc_out'];
        $wastage_fine+=four_decimal($process['balance_gpc_out']*($process['out_lot_purity']+$process['chain_margin'])/100);

        $this->load->view('gpc_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
    <tr class="bg_gray bold">
      <td>Total</td>
      <td></td>
      <td></td>
      <?php if(HOST=='ARC'){ ?>
        <td></td>
        <td></td>
      <?php } ?>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?= $out_weight?></td>
     <?php if(HOST=='ARF'){ ?> <td></td><?php }?>
      <td><?= $balance_gpc_out?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?= $wastage_fine?></td>
      <td></td>
    </tr>

  </tbody>
</table>
