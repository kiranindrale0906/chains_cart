<div class="boxrow mb-2">
  <div class="float-left">
    <?php $page_details = @getTableSettings();
    $href = ADMIN_PATH.'lot_loss/lot_loss_view?';
    ?>
    <h6 class="heading blue bold text-uppercase mb-0">
      <?= @$page_details['page_title']; ?>
    </h6>
  </div>
</div>
<div class="boxrow mb-2">
  <a  href='<?= base_url() ?>reports/lot_reports?type='>Weight</a>
  <a class="ml-5" href='<?= base_url() ?>reports/lot_reports?type=_gross'> Gross</a>
  <a class="ml-5" href='<?= base_url() ?>reports/lot_reports?type=_fine'> Fine</a>
</div>
<div class="clear"></div>
<table class="table table-sm table-default table-hover">
  <thead  class='text-right'>
    <tr>
      <th class='text-left'>Lot No</th>
      <th class='text-left'>Row ID</th>
      <th>In Weight</th>
      <th>Balance</th>
      <th>FE In - FE Out - Wastage FE</th>
      <th>Solder In / Copper Out</th>
      <th>Hook</th>
      <th>In Melting Wastage</th>
      <th>Melting Wastage</th>
      <th>DD Wastage</th>
      <th>DD In + Out Weight</th>
      <th>Tounch + Fire Tounch</th>
      <th>Ghiss + Pending Ghiss</th>
      <th>Loss</th>
      <th>Refine Loss</th>
      <th>Tounch Loss Fine</th>
      <th>HCL Loss</th>
      <th>Strip Cutting HCL Loss</th>
      <th>HCL Wastage</th>
      <th>HCL Ghiss</th>
      <th>GPC Out</th>
      <th>Micro Coating</th>
      <th>Diff</th>
      <!-- <th>Daily Drawer Gross</th>
      <th>HCL Wastage Gross</th>
      <th>Loss Weight Gross</th>
      <th>Rope Ghiss Gross</th>
      <th>Tounch</th>
      <th>Out Weight</th>

      <th>Balance</th>      

      <th>Chain Out Purity</th>

      <th>Chain HCL Loss Gross</th>
      <th>HCL Process Loss Gross</th>
      <th>Total Loss Gross</th>

      <th>Chain HCL Loss Fine</th>
      <th>HCL Process Loss Fine</th>
      <th>Chain Tounch Loss Fine</th>
      <th>Tounch/Castic Dept Loss</th>
      <th>HCL Tounch Loss Fine</th>
      
      <th>Total Loss Fine</th> -->
    </tr>
  </thead>
  
  <tbody class='text-right'>
    <?php
      if(!empty($lot_reports)){
        $balance_total=$out_weight=$in_weight=$hook=$hcl_wastage=$loss_weight=$hcl_ghiss=$tounch_weight=
        $loss_gross=$loss_fine=$hcl_out_weight=$hcl_loss_gross=$hcl_loss_fine=$loss_fine_total=
        $hcl_process_hcl_loss_gross=$out_weight_hcl_loss_gross=$out_weight_hcl_loss_fine=
        $tounch_fine_loss=$total_hcl_loss_gross=$hcl_process_hcl_loss_fine=$tounch_loss_fine=$hcl_melting_tounch_fine_loss=$tounch_castic_dept_loss=0;
        
         foreach ($lot_reports as $parent_lot_id => $lot_report) {
        //     $in_weight += @$lot_report['in_weight']['weight'];
        //     $hook += @$lot_report['hook']['weight'];
        //     $hcl_wastage += @$lot_report['hcl_wastage']['weight'];
        //     $loss_weight += @$lot_report['loss_weight']['weight'];
        //     $hcl_ghiss += @$lot_report['hcl_ghiss']['weight'];
        //     $tounch_weight+=@$lot_report['tounch_weight']['weight'];
        //     $out_weight += @$lot_report['out_weight']['out_weight'];

            
        //     $loss_gross += @$lot_report['out_weight']['hcl_loss_gross'];
        //     $loss_fine += @$lot_report['out_weight']['hcl_loss_fine'];

        //     $hcl_loss_gross+= @$lot_report['hcl_process']['hcl_loss_gross'];
        //     $hcl_loss_fine+= @$lot_report['hcl_process']['hcl_loss_fine'];

        //     $hcl_loss_gross+= @$lot_report['hcl_process']['hcl_loss_gross'];
        //     $hcl_loss_fine+= @$lot_report['hcl_process']['hcl_loss_fine'];

        //     $balance_total +=@$lot_report['in_weight']['weight']
        //                          +@$lot_report['hook']['weight']
        //                          -@$lot_report['hcl_wastage']['weight']
        //                          -@$lot_report['loss_weight']['weight']
        //                          -@$lot_report['hcl_ghiss']['weight']
        //                          -@$lot_report['tounch_weight']['weight']
        //                          -@$lot_report['out_weight']['out_weight'];


        //    $out_weight_hcl_loss_gross+=four_decimal(@$lot_report['out_weight']['hcl_loss_gross']);
        //    $hcl_process_hcl_loss_gross+=four_decimal(@$lot_report['hcl_process']['hcl_loss_gross']);
        //    $total_hcl_loss_gross+=four_decimal(@$lot_report['out_weight']['hcl_loss_gross']
        //                          +@$lot_report['hcl_process']['hcl_loss_gross']);

        //    $out_weight_hcl_loss_fine+=four_decimal(@$lot_report['out_weight']['hcl_loss_fine']);
        //    $hcl_process_hcl_loss_fine+=four_decimal(@$lot_report['hcl_process']['hcl_loss_fine']);
        //    $tounch_loss_fine+=four_decimal(@$lot_report['tounch_fine_loss']['weight']);
        //    $tounch_castic_dept_loss+=four_decimal(@$lot_report['tounch_castic_department_loss']['weight']);
        //    $hcl_melting_tounch_fine_loss+=four_decimal(@$lot_report['hcl_melting_tounch_fine_loss']['weight']);

        //     $loss_fine_total +=@$lot_report['out_weight']['hcl_loss_fine']
        //                          +@$lot_report['hcl_process']['hcl_loss_fine']
        //                          +@$lot_report['tounch_fine_loss']['weight']
        //                          +@$lot_report['hcl_melting_tounch_fine_loss']['weight'];

          $this->load->view('reports/lot_reports/tbody', array('lot_report' => $lot_report,  'type' => $type)); 
        }?>

          <!-- <tr class="bg_gray bold">
          <td></td>
          <td></td>
          <td></td>
          <td><?=four_decimal($in_weight)?></td>
          <td><?=four_decimal($hook)?></td>
          <td><?=four_decimal($hcl_wastage)?></td>
          <td><?=four_decimal($loss_weight)?></td>
          <td><?=four_decimal($hcl_ghiss)?></td>
          <td><?=four_decimal($tounch_weight)?></td>
          <td><?=four_decimal($out_weight)?></td>
          <td><?=four_decimal($balance_total)?></td>
          <td></td>
          <td><?=four_decimal($out_weight_hcl_loss_gross)?></td>
          <td><?=four_decimal($hcl_process_hcl_loss_gross)?></td>
          <td><?=four_decimal($total_hcl_loss_gross)?></td>
          <td><?=four_decimal($out_weight_hcl_loss_fine)?></td>
          <td><?=four_decimal($hcl_process_hcl_loss_fine)?></td>
          <td><?=four_decimal($tounch_loss_fine)?></td>
          <td><?=four_decimal($tounch_castic_dept_loss)?></td>
          <td><?=four_decimal($hcl_melting_tounch_fine_loss)?></td>
          <td><?=four_decimal($loss_fine_total)?></td>
        </tr> -->
          
        </tr>
      <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
</table>