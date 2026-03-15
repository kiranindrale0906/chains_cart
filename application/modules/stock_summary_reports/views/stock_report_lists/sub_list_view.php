<div class="row">
  <div class="col-sm-12">
  <h6 class='blue text-uppercase bold mb-3'>Stock Sub Report</h6>
    <div class="table-responsive m-t-10">
    <table class="table table-sm fixedthead table-default ">
      <thead>
      <tr>
        <th>Lot No</th>
        <th>Parent Lot Name</th>
        <th>Design Code</th>
        <th>Product Name</th>
        <th>Process Name</th>
        <th>Department Name</th>
        <th>Out Purity</th>
        <th>Karigar Name</th>
        <th>Balance Gross</th>
        <th>Balance Fine</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $total_gross = 0;
        $total_fine = 0;
        $count = 0;
        if(!empty($process_data)){
          foreach ($process_data as $index => $process_data) {
            $total_gross += $process_data['balance_gross'];
            $total_fine += $process_data['balance_fine'];
             $lot_no = isset($process_data['lot_no'])?$process_data['lot_no']:'-';
            $parent_lot_name = isset($process_data['parent_lot_name'])?$process_data['parent_lot_name']:'-';
            $design_code = isset($process_data['melting_lot_category_four'])?$process_data['melting_lot_category_four']:'-';
            
            $process_name = isset($process_data['process_name'])?$process_data['process_name']:'-';
            $department_name = isset($process_data['department_name'])?$process_data['department_name']:'-';
            $out_lot_purity = isset($process_data['out_lot_purity'])?$process_data['out_lot_purity']:'-';
            $karigar = isset($process_data['karigar'])?$process_data['karigar']:'-';
            

            ?>
           <?if(isset($process_data['id'])){?><a href="<?php echo base_url().'processes/processes/view/'.$process_data['id']?>"><?php }?>
           <tr style="background-color:#F0F0F0" 
                class="
                <?php echo isset($class)?$class.'_hide':'';?> table-row get_third_layer_data 
                "
                >
              <b><td ><?php if(isset($icon_hide) && $icon_hide == 0){?><i class="fas fa-angle-double-right" style="color: #216cea;">&nbsp; </i><?php }?><?= isset($process_data['product_name'])?$process_data['product_name']:'-'; ?></td></b>
              <td ><?= $lot_no ?></td>
              <td ><?= $parent_lot_name ?></td>
              <td ><?= $design_code ?></td>
              <td ><?= $process_name ?></td>
              <td ><?= $department_name;?></td>
              <td ><?= $out_lot_purity; ?></td>
              <td ><?= $karigar; ?></td>
              <td style="text-align: right;"><?= four_decimal($process_data['balance_gross']) ?></td>
              <td style="text-align: right;"><?= four_decimal($process_data['balance_fine']) ?></td>
              <td ></td>
            </tr>
          <?if(isset($process_data['id'])){?></a><?php }?>
          <?php $count++;}
          if(isset($hide_class)){
            $color = 'background-color:#28a745';
          }else{
            $color = 'background-color:yellow';
          }

          ?>
          <tr style="<?=$color?>" class="bg_gray <?php echo str_replace(" ","_",strtolower($process_data['product_name'])).'_list_hide';?>">
            <td class=" bold">Total</td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold" style="text-align: right;"><?=four_decimal($total_gross);?></td>
            <td class=" bold" style="text-align: right;"><?=four_decimal($total_fine);?></td>
            <td class=" bold"></td>
          </tr> 

       <?php }else{ ?>
          <tr>
            <td>No Record Found.</td>
          </tr>
        <?php }
      ?>
  </span>    
     </tbody>
    </table>
  </div>
  </div>
</div>