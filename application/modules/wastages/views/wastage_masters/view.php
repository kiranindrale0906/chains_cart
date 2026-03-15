 <h6>Wastage Master</h6>
 <div class="row">
  <div class="col-md-6 border-right">
    <div class="form-group container">
      <p><h6>Date : <?=date('d-m-Y',strtotime($record['created_at']))?></h6></p>
      <p><h6>Customer Name : <?= $record['customer_name']?></h6></p>
    </div>
  </div>
  
</div>
<hr>
<?php $this->load->view('wastage_masters/viewlist');?>


