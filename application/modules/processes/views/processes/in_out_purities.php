<h5 class="heading"><?php echo 'IN-OUT PURITIES'; ?></h5>
<div class="row">
  <div class="col-md-4">
    <div class="col-md-12">
      <label class="medium mr-4">In Purity: </label>
      <span><?= ($record['in_purity']!=0) ? $record['in_purity'] : '-'?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">In Lot Purity: </label>
      <span><?= ($record['in_lot_purity']!=0) ? $record['in_lot_purity'] : '-'?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Hook KDM Purity: </label>
      <span><?= ($record['hook_kdm_purity']!=0) ? $record['hook_kdm_purity'] : '-'?></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="col-md-12">
      <label class="medium mr-4">Out Purity: </label>
      <span><?= ($record['out_purity']!=0) ? $record['out_purity'] : '-'?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Out Lot Purity: </label>
      <span><?= ($record['out_lot_purity']!=0) ? $record['out_lot_purity'] : '-'?></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="col-md-12">
      <label class="medium mr-4">Wastage Purity: </label>
      <span><?= ($record['wastage_purity']!=0) ? $record['wastage_purity'] : '-'?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Wastage Lot Purity: </label>
      <span><?= ($record['wastage_lot_purity']!=0) ? $record['wastage_lot_purity'] : '-'?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Tounch Purity: </label>
      <span><?= ($record['tounch_purity']!=0) ? $record['tounch_purity'] : '-';echo' <a href="'.base_url().'processes/process_tounch_purities/edit/'.$record['id'].'">Edit</a>';?></span>
    </div>
  </div>
</div>
<hr class="mt0">