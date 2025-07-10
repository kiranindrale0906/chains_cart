<div class="table-responsive">
  <table class="table table-sm table_blue" id="">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Process Name</th>
        <th>Department Name</th>
        <th>Weight</th>
        <th>Purity</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if(!empty($processes)){
      foreach ($processes as $index => $process) {?>
		    <tr>
		      <td><?=$process['product_name'] ?></td>
		      <td><?=$process['process_name'] ?></td>
		      <td><?=$process['department_name'] ?></td>
		      <td><?=$process['weight'] ?></td>
          <td><?=$process['out_lot_purity'] ?></td>
		    </tr>
    	<?php } 
    } ?>
    </tbody>
  </table>
</div>


