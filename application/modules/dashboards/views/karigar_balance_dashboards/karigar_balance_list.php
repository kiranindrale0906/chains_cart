<?php 
if(!empty($karigar_wise_balances)){
foreach ($karigar_wise_balances as $karigar_name_index => $lot_no_columns) {
?>
  <div class='col-sm-6'>
    <br><h6 class="bold"><?=$karigar_name_index?></h6>
    <table class="table table-sm fixedthead table-default">
      <?php 
        $this->load->view('dashboards/karigar_balance_dashboards/karigar_balance_tbody',
                          array('lot_no_columns' => @$lot_no_columns,'karigar'=>$karigar_name_index));
      ?>
    </table>
  </div>
<?php }}?>
  