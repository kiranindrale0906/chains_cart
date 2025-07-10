<h5 class="heading"><?php echo 'Packing Slip'; ?></h5>
<div class="row">
  <div class="col-md-6">
  <?php if(!empty($record['accept_packing_list'])) { ?>
      <div class="col-md-12">
        <table class="table table-sm">
          <thead class="bg_gray">
            <tr>
              <th class="text-right">In</th>
              <th class="text-right">Out</th>
              <th class="text-right">Balance</th>
              <th class="text-right">Created At</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           <tr>
                  <td class="text-right"><?= $record['accept_packing_list']?></td>
                  <td class="text-right"><?= $record['out_packing_slip']?></td>
                  <td class="text-right"><?= $record['packing_slip_balance']?></td>
                  <td class="text-right"><?= date("d-m-Y H:i:s",strtotime($record['created_at']))?></td>
              </tr>
            </tbody>
          </table>
      </div>
    <?php } else { ?>
    <div class="col-md-12">
      No Records
    </div>
  <?php } ?>

</div>
</div>