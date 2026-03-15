<h6 class='blue text-uppercase bold mb-3'>Worker Balance Dashboard</h6>
<div class='row'>
<?php load_field('dropdown', array('field' => 'worker','option'=>$worker  ));  ?>
</div>
<div class='row'>
  <?php 
    if(isset($worker_balances)){
      foreach($worker_balances as $prosess_key => $process_value){ 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_orange bdr_orange white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> $process_value['worker'],
                        'card_count'=>isset($process_value['balance']) ? $process_value['balance'] : 0,
                        'url'=>'',
                        'col'=>'col-lg-3 col-md-6',
                        ));
      
      }
    } 
  ?>  
</div>
<h6 class='blue text-uppercase bold mb-3'>Worker Balance Details</h6>
<div class="row">
<?php $this->load->view('worker_balance_list');?>

</div>
<div class="row">
<div class='col-sm-12'>
<h6 class='blue text-uppercase bold mb-3'>Daily Drawer Worker Balance </h6>
  <?php 
    if(!empty($worker_daily_drawers)){
      foreach ($worker_daily_drawers as $worker_name_index => $purity_columns) { 
        if($worker_name_index==$record['worker']){
        ?>
        <br><h6 class="bold"><?=$worker_name_index?></h6>
        <table class="table table-sm fixedthead table-default">
          <?php 
            $this->load->view('dashboards/worker_balance_dashboards/worker_wise_daily_drawer_balance',
                              array('purity_columns' => @$purity_columns,'worker'=>$worker_name_index));
          ?>
        </table>
     <?php }}
    }?>

</div>
</div><br>
<h6 class='blue text-uppercase bold mb-3'>Group by Purity wise total Balance </h6>
<div class="row">
<?php $this->load->view('total_of_worker_balance');?>

</div> 
<h6 class='blue text-uppercase bold mb-3'>Worker Total Process Balance </h6>
<div class="row">
<?php $this->load->view('worker_chain_wise_balance_list');?>

</div>
<h6 class='blue text-uppercase bold mb-3'>Worker Lot Wise Total Process Balance </h6>
<div class="row">
<?php $this->load->view('worker_chain_lot_wise_balance_list');?>

</div>
<h6 class='blue text-uppercase bold mb-3'>Worker Hook Department Balance </h6>
<div class="row">
<?php $this->load->view('hook_department_of_chain_balance_list');?>

</div> 
</div>
