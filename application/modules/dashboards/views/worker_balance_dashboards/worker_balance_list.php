<?php 
if(!empty($worker_wise_balances)){
foreach ($worker_wise_balances as $worker_name_index => $lot_no_columns) {
?>
  <div class='col-sm-6'>
    <br><h6 class="bold"><?=$worker_name_index?></h6>
    <table class="table table-sm fixedthead table-default">
      <?php 
        $this->load->view('dashboards/worker_balance_dashboards/worker_balance_tbody',
                          array('lot_no_columns' => @$lot_no_columns,'worker'=>$worker_name_index));
      ?>
    </table>
  </div>
<?php }}?>
  