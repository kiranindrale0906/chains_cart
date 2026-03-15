<div class="boxrow mb-2">
  <div class="float-left">   
    <h6 class="heading blue bold text-uppercase mb-0">Karigar Detail</h6>
  </div>
</div>

<hr>

      <p class="m0"> Process name : <span class="font-weight-bold"> <?php echo $process_name; ?> </span> </p>
      <p class="m0"> Department name : <span class="font-weight-bold"> <?php echo $department_name; ?> </span> </p>
      <table class="table table-bordered table-sm table-default">
        <thead>
          <tr>
            <th class="text-center">Date</th>
            <th class="text-center">Karigar name</th>
            <th class="text-center">Design Code</th>
            <th class="text-center">Parent Lot No.</th>  
            <th class="text-center">Out weight </th>
            <th class="text-center">Rate</th>
            <th class="text-center">Amount</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($karigar_detail)){ 
            $total_outweight=0;
            $total_amount=0;
            foreach ($karigar_detail as $karigar) {
              $total_outweight=$total_outweight+$karigar['out_weight'];
              $total_amount=$total_amount+$karigar['amount']; ?>
          <tr>
            <td class="text-right"><?php echo $karigar['date']; ?></td>
            <td class="text-right"><?php echo $karigar['karigar_name']; ?></td>
            <td class="text-right"><?php echo !empty($karigar['design_code'])?$karigar['design_code']:''; ?></td>
            <td class="text-right"><?php echo $karigar['parent_lot_name']; ?></td>  
            <td class="text-right"><?php echo $karigar['out_weight']; ?></td>
            <td class="text-right"><?php echo $karigar['rate']; ?></td>
            <td class="text-right"><?php echo sprintf("%.2f", $karigar['amount']); ?></td>
          </tr>
          <?php } ?>
           <tr>
            <td class="text-right font-weight-bold">Total</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>  
            <td class="text-right font-weight-bold"><?php echo $total_outweight; ?></td>
            <td></td>
            <td class="text-right font-weight-bold"><?php echo sprintf("%.2f", round($total_amount, 2)); ?></td>
          </tr>
          <?php  } else { ?>
            <tr>
              <td colspan="7">No rates data found.</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <hr>
      