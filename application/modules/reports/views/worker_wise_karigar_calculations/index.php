<div class="boxrow mb-2">
  <div class="float-left">   
    <h6 class="heading blue bold text-uppercase mb-0">Karigar Calculations</h6>
  </div>
</div>

<?php $this->load->view('reports/worker_wise_karigar_calculations/search');?>

<hr>
<?php
  $design_code_header = "Design Code";
  $product_name = !empty($_GET['karigar_calculations']['product_name']) ? $_GET['karigar_calculations']['product_name'] : '';
  $department_name = !empty($_GET['karigar_calculations']['department_name']) ? $_GET['karigar_calculations']['department_name']  : '';

  if(!empty($product_name) && ($product_name=="Machine Chain" || $product_name=="Indo tally Chain" || $product_name=="Hollow Choco Chain" || $product_name=="Choco Chain"))
    $design_code_header="Lot No."; 
  else if(strtolower($department_name)=="chain making" && $product_name=="Imp Italy Chain")
    $design_code_header = "Concept";  

  if(!empty($calculations)) {
    foreach ($calculations as $process_name => $departments) {
      foreach ($departments as $department_name => $department) { ?>
        <p class="m0"> Process name : <span class="font-weight-bold"> <?php echo $process_name; ?> </span> </p>
        <p class="m0"> Department name : <span class="font-weight-bold"> <?php echo $department_name; ?> </span> </p>
        <table class="table table-bordered table-sm table-default">
          <thead>
            <tr>
              <th class="text-center">Date</th>
              <th class="text-center">Karigar name</th>
              <th class="text-center"><?=$design_code_header?></th>
              <?php if(HOST == 'ARF') : ?>
                <th class="text-center">Machine Size</th>
              <?php endif; ?>
              <th class="text-center">Lot No.</th>  
              <th class="text-center">Parent Lot No.</th>  
              <th class="text-center">In Lot Purity </th>
              <th class="text-center">Out weight </th>
              <?php if(HOST == 'ARF') : ?>
                <th class="text-center">Loss</th>
              <?php endif; ?>
              <th class="text-center">Rate</th>
              <th class="text-center">Amount</th>
              <th class="text-center">No Of Workers</th>
              <th class="text-center">Avg Out Weight</th>
              <?php if(!empty($product_name) && ($product_name=="Indo tally Chain" || $product_name=="Hollow Choco Chain" || $product_name=="Imp Italy Chain")) { ?>
              <th class="text-center">Action</th>  
              <?php } ?>  

            </tr>
          </thead>
          <tbody>
            <?php if(!empty($department['karigars'])) { 
              $total_outweight=0;
              $total_loss=0;
              $total_amount=0;
              foreach ($department['karigars'] as $karigar) {
                $total_outweight=$total_outweight+$karigar['out_weight'];
                $total_loss=$total_loss+$karigar['loss'];
                $total_amount=$total_amount+$karigar['amount'];
              ?>
            <tr>
              <td class="text-right"><?php echo $karigar['date']; ?></td>
              <td class="text-right"><?php echo $karigar['karigar_name']; ?></td>
              <td class="text-right"><?php echo !empty($karigar['design_code'])?$karigar['design_code']:''; ?></td>
              <?php if(HOST == 'ARF') : ?>
                <td class="text-right"><?php echo $karigar['machine_size']; ?></t>
              <?php endif; ?>
              <td class="text-right"><?php echo !empty($karigar['lot_no'])?$karigar['lot_no']:''; ?></td>
              <td class="text-right"><?php echo $karigar['parent_lot_name']; ?></td>
              <td class="text-right"><?php echo four_decimal($karigar['in_lot_purity']); ?></td>
              <td class="text-right"><?php echo $karigar['out_weight']; ?></td>
              <?php if(HOST == 'ARF') : ?>
                <td class="text-right"><?php echo $karigar['loss']; ?></td>
              <?php endif; ?>
              <td class="text-right"><?php echo $karigar['rate']; ?></td>
              <td class="text-right"><?php echo sprintf("%.2f", $karigar['amount']); ?></td>
              <td class="text-right"><?php echo $karigar['no_of_workers']; ?></td>
              <td class="text-right"><?php echo !empty($karigar['no_of_workers'])&&$karigar['no_of_workers']!=0?four_decimal($karigar['out_weight']/$karigar['no_of_workers']):four_decimal($karigar['out_weight']); ?></td>
              <?php if(!empty($product_name) && ($product_name=="Indo tally Chain" || $product_name=="Hollow Choco Chain" || $product_name=="Imp Italy Chain")) { ?>
              <td class="text-center"> 
                 <a href="<?=ADMIN_PATH.'reports/worker_wise_karigar_calculations/view/0?karigar_name='.$karigar['karigar_name'].'&parent_lot_name='.$karigar['parent_lot_name'].'&rate='.$karigar['rate'].'&date='.$karigar['date'].'&process_name='.$process_name.'&department_name='.$department_name.'&product_name='.@$product_name?>" class="btn_blue" target="_blank">View </a> 
              </td>  
              <?php } ?> 
            </tr>
            <?php } ?>
             <tr>
              <td class="text-right font-weight-bold">Total</td>
              <td></td>
              <td></td>
              <?php if($product_name!='Indo tally Chain') : ?>
                <td>&nbsp;</td>
              <?php endif; ?>
              <?php if(HOST == 'ARF') : ?>
                <td>&nbsp;</td>
              <?php endif; ?>
              <td>&nbsp;</td>  
              <td>&nbsp;</td>  
              <td class="text-right font-weight-bold"><?php echo $total_outweight; ?></td>
              <?php if(HOST == 'ARF') : ?>
                <td class="text-right font-weight-bold"><?php echo $total_loss; ?></td>
              <?php endif; ?>
              <td></td>
              <td class="text-right font-weight-bold"><?php echo sprintf("%.2f", round($total_amount, 2)); ?></td>
              <td class="text-right font-weight-bold"></td>
              <?php if(!empty($product_name) && ($product_name=="Indo tally Chain" || $product_name=="Hollow Choco Chain" || $product_name=="Imp Italy Chain")) { ?>
              <td>&nbsp;</td>  
              <?php } ?>  
            </tr>
            <?php  } else { ?>
              <tr>
                <td colspan="9">No rates data found.</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <hr>
      <?php
}}} else {
  echo "No records found";
} ?>