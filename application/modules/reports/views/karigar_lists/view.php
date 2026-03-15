<div class="row">
  <div class="col-sm-12">
  <h6 class='blue text-uppercase bold mb-3'>Stock Sub Report</h6>
    <div class="table-responsive m-t-10">
    <table class="table table-sm fixedthead table-default ">
      <thead>
      <tr>
        <th>Product Name</th>
        <th>Karigar</th>
        <th>Lot</th>
        <th>Purity</th>
        <th>Balance</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sum = 0;
        if(!empty($record)){
          foreach ($record as $index => $process_data) {
            $sum += $process_data['balance'];
            ?>
            <tr>
              <td ><?= isset($process_data['product_name'])?$process_data['product_name']:'-'; ?></td>
              <td ><?= isset($process_data['karigar'])?$process_data['karigar']:'-'; ?></td>
              <td ><?= isset($process_data['lot_name'])?$process_data['lot_name']:'-'; ?></td>
              <td ><?= isset($process_data['in_lot_purity'])?$process_data['in_lot_purity']:'-'; ?></td>
              <td style="text-align: right;"><?php if(isset($process_data['id'])){?><a href="<?php echo base_url('processes/processes/view/').$process_data['id'];?>"><?php }?><?= four_decimal($process_data['balance']) ?><?php if(isset($process_data['id'])){ ?></a><?php }?></td>
            </tr>
          <?php }?>
          <tr class="bg_gray">
            <td class=" bold">Total</td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold" style="text-align: right;"><?=four_decimal($sum);?></td>
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


<div class="row">
  <div class="col-sm-12">
  <h6 class='blue text-uppercase bold mb-3'>karigar Report</h6>
    <div class="table-responsive m-t-10">
    <table class="table table-sm fixedthead table-default ">
      <thead>
      <tr>
        <th>Product Name</th>
        <th>Karigar</th>
        <th>Purity</th>
        <th style="text-align: right;">Balance</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sum = 0;
        if(!empty($record)){
          foreach ($karigar_list as $index => $process_data) {
            $sum += $process_data['balance'];
            ?>
            <tr>
              <td ><?= isset($process_data['product_name'])?$process_data['product_name']:'-'; ?></td>
              <td ><?= isset($process_data['karigar'])?$process_data['karigar']:'-'; ?></td>
              <td ><?= isset($process_data['in_lot_purity'])?$process_data['in_lot_purity']:'-'; ?></td>
              <td style="text-align: right;"><?= four_decimal($process_data['balance']) ?></td>
            </tr>
          <?php }?>
          <tr class="bg_gray">
            <td class=" bold">Total</td>
            <td class=" bold"></td>
            <td class=" bold"></td>
    
            <td class=" bold" style="text-align: right;"><?=four_decimal($sum);?></td>
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