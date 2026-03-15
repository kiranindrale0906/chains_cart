<?php 
  $previous_date = '';
  foreach ($created_dates as $index => $created_date) { ?>
    <div class="row">
      <div class="col-md-4 border-right">
        <div class="form-group container">
          <div class="table-responsive m-t-20">
            <h5 class="heading blue m-0">Receipt: <?= $created_date ?></h5>
            <table class="table table-sm fixedthead table-default">
              <?php 
                $this->load->view('issue_and_receipts/internal_ledgers/thead'); 
                $this->load->view('issue_and_receipts/internal_ledgers/tbody', 
                                                      array('created_date_records' => isset($receipts[$created_date]) ? $receipts[$created_date] : array(),
                                                            'previous_date' => $previous_date,
                                                            'created_date' => $created_date,
                                                            'type' => 'receipt')); 
              ?>
            </table>
          </div> 
        </div>
      </div> 

      <div class="col-md-4 border-right">
        <div class="form-group container">
          <div class="table-responsive m-t-20">
            <h5 class="heading blue m-0">Stock</h5>
            <table class="table table-sm fixedthead table-default">
              <?php 
                $this->load->view('issue_and_receipts/internal_ledgers/thead');
                $this->load->view('issue_and_receipts/internal_ledgers/tbody', 
                                                    array('created_date_records' => isset($stocks[$created_date]) ? $stocks[$created_date] : array(),
                                                          'previous_date' => $previous_date,
                                                          'created_date' => $created_date,
                                                          'type' => 'stock')); 
              ?>
              
            </table>
          </div> 
        </div>
      </div>

      <div class="col-md-4 border-right">
        <div class="form-group container">
          <div class="table-responsive m-t-20">
            <h5 class="heading blue m-0">Issue</h5>
            <table class="table table-sm fixedthead table-default">
              <?php 
                $this->load->view('issue_and_receipts/internal_ledgers/thead');
                $this->load->view('issue_and_receipts/internal_ledgers/tbody', 
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
  