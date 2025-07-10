<div class="row">
  <div class="col-sm-6">
    <h6 class='blue text-uppercase bold mb-3'>Hook Department(Category wise) </h6>
      <div class="table-responsive m-t-10">
      <table class="table table-sm fixedthead table-default">
    	  <thead>
    	  <tr>
    	    <th>Category</th>
    	    <th>Balance</th>
    	  </tr>
    	</thead>
    	<tbody>
        <?php 
        $in_weight=0;
        if(!empty($design_code_wise_hook_in_weights)){
        	foreach ($design_code_wise_hook_in_weights as $index => $design_code_wise_hook) {
        		$in_weight+=$design_code_wise_hook['balance'];
              ?>
             <tr>
                </td><td><?= !empty($design_code_wise_hook['design_code'])?$design_code_wise_hook['design_code']:'-' ?></td>
                <td><?= four_decimal($design_code_wise_hook['balance']) ?></td>
              </tr> 
        <?php }
        ?>
    		<tr class="bg_gray">
    			<td class=" bold">Total</td>
    			<td class=" bold"><?=four_decimal($in_weight);?></td>
    		</tr>
        <?php }else{ ?>
            <tr>
              <td>No Record Found.</td>
            </tr>
          <?php }?>
         
      </tbody>
    	</table>
    </div>
  </div>

  <div class="col-sm-6">
    <h6 class='blue text-uppercase bold mb-3'>Machine Process(Category wise) </h6>
      <div class="table-responsive m-t-10">
      <table class="table table-sm fixedthead table-default">
        <thead>
        <tr>
          <th>Category</th>
          <th>Balance</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $in_weight=0;
        if(!empty($rope_chain_machine_process_category)){
          foreach ($rope_chain_machine_process_category as $index => $machine_process_wise) {
            $in_weight+=$machine_process_wise['balance'];
              ?>
             <tr>
                </td><td><?= !empty($machine_process_wise['design_code'])?$machine_process_wise['design_code']:'-' ?></td>
                <td><?= four_decimal($machine_process_wise['balance']) ?></td>
              </tr> 
        <?php }
        ?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($in_weight);?></td>
        </tr>
        <?php }else{ ?>
            <tr>
              <td>No Record Found.</td>
            </tr>
          <?php }?>
         
      </tbody>
      </table>
    </div>
  </div>
</div>



