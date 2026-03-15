<h5 class="heading"><?php echo 'WASTAGE DETAILS'; ?></h5>
<div class="row">
  <?php if(!empty($wastage_detail_names)) { 
    foreach ($wastage_detail_names as $key => $wastage_detail_name) {
      $total_out = 0;
  ?>
    <div class="col-md-6">
      <div class="col-md-6">
        <label class="medium mr-4"><?= $wastage_detail_name['wastage_name'];?>: </label>
      </div>
      <div class="col-md-12">
        <table class="table table-sm">
          <thead class="bg_gray">
            <tr>
              <th class="text-right">Lot-No</th>
              <th class="text-right">Parent Lot Name</th>
              <th class="text-right">Out</th>
              <th class="text-right">Created At</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($wastage_details as $key => $value) { ?>
              <tr>
                <?php if($wastage_detail_name['wastage_name'] == $value['field_name']) { 
                  $total_out += $value['out_weight'];
                ?>
                  <td class="text-right"><?= $value['lot_no']?></td>
                  <td class="text-right"><?= $value['parent_lot_name']?></td>
                  <td class="text-right"><?= $value['out_weight']?></td>
                  <td class="text-right"><?= date("d-m-Y H:i:s",strtotime($value['created_at']))?></td>
                  <td class="text-right"><?= '<a href="'.base_url().'processes/processes/view/'.$value['parent_id'].'">VIEW</a>'?></td>
                <?php } ?>
              </tr>
            <?php } ?>
          </tbody>
          <tfoot class="bg_light_gray bold">
            <tr>
              <td colspan="2">Total</td>
              <td class="text-right"><?= four_decimal($total_out)?></td>
              <td colspan="2"></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  <?php } } else { ?>
    <div class="col-md-12">
      No Records
    </div>
  <?php } ?>
</div>
<hr class="mt0">