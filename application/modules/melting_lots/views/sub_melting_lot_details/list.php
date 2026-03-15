<div class="table-responsive">
  <table class="table table-sm table-default">
    <thead>
      <tr>
        <th>#</th>
       
        <th>Date</th>
        <th>Process</th>
        <th>Department Name</th>
        <th>Description</th>
        <th>Design Name</th>
        <th class="text-right">Actual Weight</th>
        <th class="text-right">Purity(%)</th>
        <th class="text-right">Required Weight</th>
        <th class="text-right">Required Alloy Weight</th>
        <th class="text-right"></th>
      </tr>
    </thead>
    <tbody>
    <?php 
     foreach ($melting_lot_details as $index => $melting_lot_detail) { ?>
      <tr>
        <td><?=$index+1?></td>
     
        <td><?=date('d-m-Y',strtotime($melting_lot_detail['created_at']))?></td>
        <td><?= $melting_lot_detail['process_name']?></td>
        <td><?= $melting_lot_detail['department_name']?></td>
        <td><?= $melting_lot_detail['description']?></td>
        <td><?= $melting_lot_detail['design_code']?></td>
        <td class="text-right"><?=$melting_lot_detail['in_weight']?></td>
        <td class="text-right"><?=$melting_lot_detail['in_purity']?></td>
        <td class="text-right"><?=$melting_lot_detail['required_weight']?></td>
        <td class="text-right"><?=@$melting_lot_detail['required_alloy_weight']?></td> 
        <td class="text-right"><?= getHttpButton('DELETE', base_url().'melting_lots/melting_lot_details/delete/'.$melting_lot_detail['id'], 'float-right btn-danger ml-5'); ?></td> 
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

