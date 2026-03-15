<div class="boxrow mb-2">
  <div class="float-left">
    <?php $page_details = @getTableSettings();
    ?>
    <h6 class="heading blue bold text-uppercase mb-0">
      <?= @$page_details['page_title']; ?>
    </h6>
  </div>
</div>
<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th>Category Name</th>
      <th class='text-right'>Daily Drawer Wastage </th>
      <th class='text-right'>Daily Drawer Wastage Gross</th>
      <th class='text-right'>Daily Drawer Wastage Fine</th>
    </tr>
  </thead>
  
  <tbody >
  <?php
  if(!empty($records)){
      $daily_drawer_wastage=$daily_drawer_wastage_gross=$daily_drawer_wastage_fine=0;
      foreach ($records as $index => $record) {
        $daily_drawer_wastage+=$record['daily_drawer_wastage'];
        $daily_drawer_wastage_gross+=$record['daily_drawer_wastage_gross'];
        $daily_drawer_wastage_fine+=$record['daily_drawer_wastage_fine'];
       ?>
      <tr>
      <td><?=$index?></td>
      <td class='text-right'><?=four_decimal($record['daily_drawer_wastage'])?></td>
      <td class='text-right'><?=four_decimal($record['daily_drawer_wastage_gross'])?></td>
      <td class='text-right'><?=four_decimal($record['daily_drawer_wastage_fine'])?></td>
      </tr>
   <?php }?>
   <tr class="bg_gray">
            <td class=" bold">Total</td>
            <td class=" bold text-right"><?=four_decimal($daily_drawer_wastage)?></td>
            <td class=" bold text-right"><?=four_decimal($daily_drawer_wastage_gross)?></td>
            <td class=" bold text-right"><?=four_decimal($daily_drawer_wastage_fine)?></td>
          </tr> 
  <?php }else{?>
    <tr><td>No Record Found.</td></tr>
    <?php }?>
  </tbody>
</table>