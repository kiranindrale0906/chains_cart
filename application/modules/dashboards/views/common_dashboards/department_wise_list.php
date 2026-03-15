
<?php if(isset($deparment_process_balance_custom)){?>
<?php
 foreach($deparment_process_balance_custom[$process] as $process_key => $process_value){
  ?>
    <div class="col-sm-6">
  <h6 class='blue text-uppercase bold mb-3'><?=$process_value['title']?></h6>
    <div class="table-responsive m-t-10">
      <table class="table table-sm fixedthead table-default">
        <thead>
        <tr>
           <th>Department Name</th>
           <th>Balance</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $balance_machine=0;
        if(!empty($process_value['data'])){
          foreach ($process_value['data'] as $index => $process_data) {
            $balance_machine+=$process_data['balance'];
              ?>
              <tr>
                <td><?= !empty($process_data['department_name'])?$process_data['department_name']:'-' ?></td>  
                <td><?= !empty($process_data['balance'])?$process_data['balance']:'-' ?></td>  
              </tr> 
        <?php }
        ?>  <tr class="bg_gray">
          <td class=" bold">Total</td>
          <?php if(isset($process_data['design_code'])){?><td class=" bold"></td><?php }?>
          <td class=" bold"><?=four_decimal($balance_machine);?></td>
        </tr>
            <tr>
        <?php }else{ ?>
              <td>No Record Found.</td>
            </tr>
          <?php }?>
         
      </tbody>
      </table>
    </div>
  </div>
<?php }?>
<?php } ?>