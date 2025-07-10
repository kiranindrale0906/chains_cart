<div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>  
        <th>Sr.No.</th>
        <th>Title</th>
        <th class="text-right">A</th>
        <th class="text-right">B</th>
        <th class="text-right">C</th>
        <th class="text-right">D</th>
        <th class="text-right">E</th>
        <th class="text-right">Weight</th>
	  </tr>
	</thead>
	<tbody>
      <?php if(!empty($records)) {
        foreach ($records as $srno => $record) {
          $weight   = ($record['A'] + $record['B']) - ($record['C'] + $record['D'] + $record['E']);
      ?>
      <?php if(four_decimal($weight) != 0) {?>
      <tr>
        <td><?= $srno;?></td>
        <td><?= $record['title'];?></td>
        <td class="text-right"><?= four_decimal($record['A'], '-'); ?></td>
        <td class="text-right"><?= four_decimal($record['B'], '-'); ?></td>
        <td class="text-right"><?= four_decimal($record['C'], '-'); ?></td>
        <td class="text-right"><?= four_decimal($record['D'], '-'); ?></td>
        <td class="text-right"><?= four_decimal($record['E'], '-'); ?></td>
        <td class="text-right"><a href='<?= ADMIN_PATH?>settings/run_sql_query/index?query=<?= $record['query']?>'><?= four_decimal($weight, '-'); ?></a></td>
      </tr>
      <?php  } } ?>
      <tr class="bg_gray">
        <td colspan="8" class="bold">Total</td>
      </tr>
      <?php } else { ?>
        <tr>
          <td colspan="8">No data found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>