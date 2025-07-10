<?php 
if(!empty($hook_department_karigar_wise_balances)){
foreach ($hook_department_karigar_wise_balances as $karigar_name_index => $product_name_columns) {
?>
  <div class='col-sm-6'>
    <br><h6 class="bold"><?=$karigar_name_index?></h6>
    <table class="table table-sm fixedthead table-default">
      <?php 
        $this->load->view('dashboards/karigar_balance_dashboards/hook_department_balance_tbody',
                          array('product_name_columns' => @$product_name_columns,'karigar'=>$karigar_name_index));
      ?>
    </table>
  </div>
<?php }}?>
  