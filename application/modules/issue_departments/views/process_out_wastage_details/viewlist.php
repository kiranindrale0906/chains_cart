<h5 class="heading">Wasteges</h5>
<div class="table-responsive">
  <table class="table table-sm table-default">
    <thead>
      <tr>
        <th></th>
        <th>Product Name</th>
        <th>Process Name</th>
        <th>Department Name</th>
        <th>Daily Drawer Wastage</th>
        <th>Out Lot Purity</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if(!empty($wastages)){
     foreach ($wastages as $index => $wastage) { ?>
      <tr>
        <td><?=$index+1?></td>
        <td><?=$wastage['product_name'] ?></td>
        <td><?=$wastage['process_name'] ?></td>
        <td><?=$wastage['department_name'] ?></td>
        <td><?=$wastage['daily_drawer_wastage'] ?></td>
        <td><?=$wastage['out_lot_purity'] ?></td>
      </tr>
    <?php }} ?>
    </tbody>
  </table>
</div>