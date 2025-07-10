<h5>Karigar Out Dashboard</h5>
<hr>
<div class="row">
  <div class="col-sm-3">
    <?php $this->load->view('table_header');?>
  </div>
</div>
<div class="row">
<?php foreach(list_array() as $chain_list_key){?>
    <div class="col-sm-6">
    <h6 class='blue text-uppercase bold mb-3'><?php echo ucwords(str_replace("_"," ",$chain_list_key));?></h6>
      <div class="table-responsive m-t-10">
      <table class="table table-sm fixedthead table-default ">
        <thead>
        <tr>
          <th>Karigar</th>
          <th style="float:right">Out Weight</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $sum = 0;
          $variable = ${$chain_list_key};
          if(!empty($variable)){
            foreach ($variable as $index => $process_data) {
              $sum += $process_data['balance'];
              ?>
              <tr>
                <td ><?= isset($process_data['karigar'])?$process_data['karigar']:'-'; ?></td>
        
                <td style="text-align: right;"><?= four_decimal($process_data['balance']) ?></td>
              </tr>
            <?php }?>
            <tr class="bg_gray">
              <td class=" bold">Total</td>
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
<?php }?>
</div>
