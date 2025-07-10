<?php if(!empty($melting_lot_details_without_tounch_purities)) {?>
<h6 class='blue'>Melting Lot detail without Tounch Purity </h6>
<div class="table-responsive">
  <table class="table table-sm table-default fixedTable_js table-bordered table-striped">
    <thead> 
        <tr> 
          <th>Product</th>
          <th>Process</th>
          <th>Department Name</th>
          <th>Lot No</th>
          <th>Description</th>
          <th class="text-right">Purity (%)</th>
          <th class="text-right">Required Weight</th>
          <th class="text-right">Total Alloy Weight</th>
        </tr>
    </thead>
    <tbody class="sub_melting_lot_details">
      <?php 
        foreach ($melting_lot_details_without_tounch_purities as $index => $melting_lot_details_without_tounch_purity) { 
         
         ?>
          <tr>
          <td><?=$melting_lot_details_without_tounch_purity['product_name']?></td>
          <td><?=$melting_lot_details_without_tounch_purity['process_name']?></td>
          <td><?=$melting_lot_details_without_tounch_purity['department_name']?></td>
          <td><?=$melting_lot_details_without_tounch_purity['lot_no']?></td>
          <td><?=$melting_lot_details_without_tounch_purity['description']?></td>
          <td class="text-right in_purity"><?=$melting_lot_details_without_tounch_purity['in_purity']?></td>
          <td class="text-right in_weight"><?=$melting_lot_details_without_tounch_purity['in_weight']?></td>
          <td class="text-right total_alloy_weight"></td>
          </tr> 
        <?php  }  ?>  
    </tbody>
  </table>
</div>
<?php  }  ?>  

    