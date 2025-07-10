<div class="table-row table-header">
  <div class="table-row">
      <div class="table-header-cell"><?=$department_name?></div>
  </div>
</div>
<div class="table-row table-header">
  <div class="table-row">
	  <?php foreach ($department_columns as $index => $department_column) { 
	  	$column_name = $department_column[0]; ?> 

      <div class="table-cell"><?= $column_name ?></div>
	  <?php } ?>
  </div>
</div>