<h5 class="heading"><?php echo 'MELTING LOT DETAILS';
?></h5>
<div class="row">
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
            <?php
             if(!empty($melting_lot_process_details)) { 
                $total_out = 0;
              foreach ($melting_lot_process_details as $key => $melting_lot_process_detail) {
                $total_out += $melting_lot_process_detail['out_weight'];
            ?>
              <tr>
                  <td class="text-right"><?= $melting_lot_process_detail['lot_no']?></td>
                  <td class="text-right"><?= $melting_lot_process_detail['parent_lot_name']?></td>
                  <td class="text-right"><?= $melting_lot_process_detail['out_weight']?></td>
                  <td class="text-right"><?= date("d-m-Y H:i:s",strtotime($melting_lot_process_detail['created_at']))?></td>
                  <td class="text-right"><?= '<a class="btn btn-xs btn_red close_btn" href="'.base_url().'melting_lots/melting_lots/delete/'.$melting_lot_process_detail['melting_lot_id'].'?process_id='.$record['id'].'">delete</a>'?></td>
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
  <?php }  else { ?>
    <div class="col-md-12">
      No Records
    </div>
  <?php } ?>
</div>
<hr class="mt0">