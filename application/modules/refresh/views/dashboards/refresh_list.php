<div class="row">
	<div class="col-sm-6">
	  <h6 class='blue text-uppercase bold mb-3'>Refresh Chain Purity Wise Balance
		</h6>
    <div class="table-responsive m-t-10">
      <table class="table table-sm fixedthead table-default">
        <thead>
        <tr>
           <th>Purity</th>
           <th>Balance</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $balance_refresh=0;
        if(!empty($refresh_purity_wise_list)){
          foreach ($refresh_purity_wise_list as $index => $process_data) {
            $balance_refresh+=$process_data['balance'];
              ?>
              <tr>
                <td><?= !empty($process_data['in_lot_purity'])?$process_data['in_lot_purity']:'-' ?></td>   
                <td><?= !empty($process_data['balance'])?$process_data['balance']:'-' ?></td>  
              </tr> 
        <?php }
        ?>  <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($balance_refresh);?></td>
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
  <div class="col-sm-6">
	  <h6 class='blue text-uppercase bold mb-3'>Refresh Chain Design Code Wise Balance
		</h6>
    <div class="table-responsive m-t-10">
      <table class="table table-sm fixedthead table-default">
        <thead>
        <tr>
           <th>Design Code</th>
           <th>Balance</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $balance_refresh=0;
        if(!empty($refresh_design_code_wise_list)){
          foreach ($refresh_design_code_wise_list as $index => $process_data) {
            $balance_refresh+=$process_data['balance'];
              ?>
              <tr>
                <td><?= !empty($process_data['design_code'])?$process_data['design_code']:'-' ?></td>   
                <td><?= !empty($process_data['balance'])?$process_data['balance']:'-' ?></td>  
              </tr> 
        <?php }
        ?>  <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($balance_refresh);?></td>
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

  <div class="col-sm-6">
	  <h6 class='blue text-uppercase bold mb-3'>GPC Design Code Wise Balance
		</h6>
    <div class="table-responsive m-t-10">
      <table class="table table-sm fixedthead table-default">
        <thead>
        <tr>
           <th>Design Code</th>
           <th>Balance</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $balance_refresh=0;
        if(!empty($refresh_gpc_design_code_wise_list)){
          foreach ($refresh_gpc_design_code_wise_list as $index => $process_data) {
            $balance_refresh+=$process_data['balance'];
              ?>
              <tr>
                <td><?= !empty($process_data['design_code'])?$process_data['design_code']:'-' ?></td>   
                <td><?= !empty($process_data['balance'])?$process_data['balance']:'-' ?></td>  
              </tr> 
        <?php }
        ?>  <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($balance_refresh);?></td>
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

  <div class="col-sm-6">
	  <h6 class='blue text-uppercase bold mb-3'>GPC Purity Wise Balance
		</h6>
    <div class="table-responsive m-t-10">
      <table class="table table-sm fixedthead table-default">
        <thead>
        <tr>
           <th>Purity</th>
           <th>Balance</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $balance_refresh=0;
        if(!empty($refresh_gpc_purity_wise_list)){
          foreach ($refresh_gpc_purity_wise_list as $index => $process_data) {
            $balance_refresh+=$process_data['balance'];
              ?>
              <tr>
                <td><?= !empty($process_data['in_lot_purity'])?$process_data['in_lot_purity']:'-' ?></td>   
                <td><?= !empty($process_data['balance'])?$process_data['balance']:'-' ?></td>  
              </tr> 
        <?php }
        ?>  <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($balance_refresh);?></td>
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

</div>