<?php 
  if (isset($created_dates)) {
    $previous_date = '';
    foreach ($created_dates as $index => $created_date) { ?>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group container">
            <div class="table-responsive m-t-20">
              <h5 class="heading blue m-0">Receipt: <?= $created_date ?></h5>
              <table class="table table-sm fixedthead table-default">
                <?php 
                  $this->load->view('reports/gpc_out_reports/thead'); 
                  $this->load->view('reports/gpc_out_reports/tbody', 
                                                        array('created_date_records' => isset($receipts[$created_date]) ? $receipts[$created_date] : array(),
                                                              'previous_date' => $previous_date,
                                                              'created_date' => $created_date,
                                                              'type' => 'receipt')); 
                ?>
              </table>
            </div> 
          </div>
        </div> 
      </div>
      <?php 
      $previous_date = $created_date;
    }
  }
?>
  