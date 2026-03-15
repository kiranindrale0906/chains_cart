<div class="row">
  <div class="col-md-6 border-right">
    <div class="form-group container">
      <p><h6>Date : <?=date('d-m-Y',strtotime($record['created_at']))?></h6></p>
      <p><h6>Process : <?=$record['process_name']?></h6></p>
      <p><h6>Account : <?=$record['account']?></h6></p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group container">
      <p><h6>Lot No : <?=$record['lot_no']?><h6></p>
      <p><h6>Karigar : <?=$record['karigar']?></h6></p>
      <p><h6>Gross Weight : <?=$record['in_weight']?></h6></p>
    </div>
  </div>
</div>