<div class="row">
  <div class="col-sm-12">
  <h6 class='blue text-uppercase bold mb-3'>Stock Report</h6>
    <?php //load_field('dropdown', array('field' => 'in_lot_purity','name'=>'in_lot_purity','class'=>'change_inlotpurity','option'=> (!empty($in_lot_purity) ? $in_lot_purity : ''))) ?>
    <div class="table-responsive m-t-10">
    <table class="table table-sm fixedthead table-default ">
  	  <thead>
  	  <tr>
        <th>Main Department Name</th>
        <th>Lot No</th>
        <th>Parent Lot Name</th>
        <th>design Code </th>
        <th>Product Name</th>
        <th>Process Name</th>
        <th>Department Name</th>
        <th>Out Purity</th>
        <th>Karigar Name</th>
  	    <th style="text-align:right;">Balance Gross</th>
        <th style="text-align:right;">Balance Fine</th>
        <th style="text-align:right;"></th>
  	  </tr>
  	</thead>
  	<tbody>
      <?php
        $total_gross = 0;
        $total_fine = 0;
        $count = 0;
        if(!empty($record['process_data'])){
          
          sort($record['process_data']);
          foreach ($record['process_data'] as $index => $process_data) {
            $odd_even = array("odd","even");
            $check_odd = $odd_even[$count % 2];
            $total_gross += !empty($process_data['balance_gross']) ? $process_data['balance_gross'] : 0;
            $total_fine += $process_data['balance_fine'];
            
            if($check_odd == 'odd') $colour =  "background-color:#eaeaea;";
            else $colour = "background:white;";
            ?>
            <?php if(!empty($process_data['balance_gross'])) { ?>
              <tr style="<?php echo $colour;?>" class="<?php echo str_replace(" ", "_", strtolower($process_data['department_name'])).'_list';?>">
                <td class><a href="javascript:void(1);" 
                      data-collapse="0" class ="show_more_department_details " 
                      data-chain="<?php echo $process_data['department_names']; ?>" 
                      data-list="<?php echo str_replace(" ", "_", strtolower($process_data['department_name']));?>" 
                      data-hide ="<?php echo str_replace(" ", "_", strtolower($process_data['department_name'])).'_list';?>"
                      data-request="0">
                      <span class="fa fa-plus "></a> 
                <?= isset($process_data['department_name'])?$process_data['department_name']:'-'; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?= isset($process_data['process_name'])?$process_data['process_name']:'-'; ?></td>
                <td></td>
                <td><?= isset($process_data['out_purity'])?$process_data['out_purity']:'-'; ?></td>
                <td><?= isset($process_data['karigar'])?$process_data['karigar']:'-'; ?></td>
                <td style="text-align:right;"><b><?= four_decimal($process_data['balance_gross']) ?></b></td>
                <td style="text-align:right;"><b><?= four_decimal($process_data['balance_fine']) ?></b></td>
                <td></td>
              </tr>
          <?php $count++;
              }
            }?>
          <tr class="bg_gray">
            <td class=" bold">Total</td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td style="text-align:right;" class=" bold"><?=four_decimal($total_gross);?></td>
            <td style="text-align:right;" class=" bold"><?=four_decimal($total_fine);?></td>
            <td></td>
          </tr> 
          
       <?php }else{ ?>
          <tr>
            <td>No Record Found.</td>
          </tr>
        <?php }
      ?>
    </tbody>
  	</table>
  </div>
  </div>
</div>