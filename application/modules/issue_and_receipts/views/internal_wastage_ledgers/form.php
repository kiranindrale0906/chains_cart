<h5> Select Period: 
  <a class="ml-5 <?= ($period=='date') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'issue_and_receipts/internal_wastage_ledgers/create' ?>?period=date'>Date</a>
  <a class="ml-5 <?= ($period=='week') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'issue_and_receipts/internal_wastage_ledgers/create' ?>?period=week'>Week</a>
  <a class="ml-5 <?= ($period=='month') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'issue_and_receipts/internal_wastage_ledgers/create' ?>?period=month'>Month</a>
  <a class="ml-5 <?= ($period=='year') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'issue_and_receipts/internal_wastage_ledgers/create' ?>?period=year'>Year</a>
</h5>
<h5> Select Wastage Name: 
<?php 
  foreach ($internal_wastages as $index => $value) {
?>
  <a class="ml-5 <?= ($wastage==$value['name']) ? 'bold black underline' : '' ?>" href='<?= base_url().'issue_and_receipts/internal_wastage_ledgers/create' ?>?period=<?=$period ?>&wastage=<?=$value['name']?>'><?=$value['name']?></a>
<?php }
?>
</h5>
<?php 
  $previous_date = '';
  foreach ($created_dates as $index => $created_date) { ?>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group container">
          <div class="table-responsive m-t-20">
            <h5 class="heading blue m-0">Receipt: <?= $created_date ?></h5>
            <table class="table table-sm fixedthead table-default">
              <?php 
                $this->load->view('issue_and_receipts/internal_wastage_ledgers/thead'); 
                $this->load->view('issue_and_receipts/internal_wastage_ledgers/tbody', 
                                                      array('created_date_records' => isset($receipts[$created_date]) ? $receipts[$created_date] : array(),
                                                            'previous_date' => $previous_date,
                                                            'created_date' => $created_date,
                                                            'type' => 'receipt')); 
              ?>
            </table>
          </div> 
        </div>
      </div> 

      <div class="col-md-6 border-right">
        <div class="form-group container">
          <div class="table-responsive m-t-20">
            <h5 class="heading blue m-0">Issue</h5>
            <table class="table table-sm fixedthead table-default">
              <?php 
                $this->load->view('issue_and_receipts/internal_wastage_ledgers/thead');
                $this->load->view('issue_and_receipts/internal_wastage_ledgers/tbody', 
                                                    array('created_date_records' => isset($issues[$created_date]) ? $issues[$created_date] : array(),
                                                          'previous_date' => $previous_date,
                                                          'created_date' => $created_date,
                                                          'type' => 'issue')); 
              ?>
              
            </table>
          </div> 
        </div>
      </div>
    </div>
    <?php 
    $previous_date = $created_date;
  }
?>
  