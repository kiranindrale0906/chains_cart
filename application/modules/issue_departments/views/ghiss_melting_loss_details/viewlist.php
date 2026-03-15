<div class="table-responsive">
  <table class="table table-sm table-default">
    <thead>
      <tr>
        <th></th>
        <th>Product Name</th>
        <th>Department Name</th>
        <th>Ghiss Melting Loss</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if(!empty($processes)){
     foreach ($processes as $index => $process) { ?>
      <tr>
        <td><?=$index+1?></td>
        <td><?= $process['product_name'] ?></td>
        <td><?= $process['department_name'] ?></td>
        <td><?= $process['balance_loss'] ?></td>
        <td><a href=<?= base_url().'processes/processes/view/'.$process['id'] ?>>View</a></td>
      </tr>
    <?php }} ?>
    </tbody>
  </table>
</div>

