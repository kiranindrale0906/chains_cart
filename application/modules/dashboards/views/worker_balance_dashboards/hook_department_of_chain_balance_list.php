<?php 
if(!empty($hook_department_worker_wise_balances)){
foreach ($hook_department_worker_wise_balances as $worker_name_index => $product_name_columns) {
?>
  <div class='col-sm-6'>
    <br><h6 class="bold"><?=$worker_name_index?></h6>
    <table class="table table-sm fixedthead table-default">
      <?php 
        $this->load->view('dashboards/worker_balance_dashboards/hook_department_balance_tbody',
                          array('product_name_columns' => @$product_name_columns,'worker'=>$worker_name_index));
      ?>
    </table>
  </div>
<?php }}?>
  