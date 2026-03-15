<h6 class='blue text-uppercase bold mb-3'>Karigar Balance Dashboard</h6>
<div class='row'>
<?php load_field('dropdown', array('field' => 'karigar','option'=>$karigar));  ?>
</div>
<div class='row'>
  <?php 
    if(isset($karigar_balances)){
      foreach($karigar_balances as $prosess_key => $process_value){ 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_orange bdr_orange white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> $process_value['karigar'],
                        'card_count'=>isset($process_value['balance']) ? $process_value['balance'] : 0,
                        'url'=>'',
                        'col'=>'col-lg-3 col-md-6',
                        ));
      
      }
    } 
  ?>  
</div>
<h6 class='blue text-uppercase bold mb-3'>Karigar Balance Details</h6>
<div class="row">
<?php $this->load->view('karigar_balance_list');?>

</div>
<div class="row">
<div class='col-sm-12'>
<h6 class='blue text-uppercase bold mb-3'>Daily Drawer Karigar Balance </h6>
  <?php 
    if(!empty($karigar_daily_drawers)){
      foreach ($karigar_daily_drawers as $karigar_name_index => $purity_columns) { 
        if($karigar_name_index==$record['karigar']){
        ?>
        <br><h6 class="bold"><?=$karigar_name_index?></h6>
        <table class="table table-sm fixedthead table-default">
          <?php 
            $this->load->view('dashboards/karigar_balance_dashboards/karigar_wise_daily_drawer_balance',
                              array('purity_columns' => @$purity_columns,'karigar'=>$karigar_name_index));
          ?>
        </table>
     <?php }}
    }?>

</div>
</div><br>
<h6 class='blue text-uppercase bold mb-3'>Group by Purity wise total Balance </h6>
<div class="row">
<?php $this->load->view('total_of_karigar_balance');?>

</div> 
<h6 class='blue text-uppercase bold mb-3'>Karigar Total Process Balance </h6>
<div class="row">
<?php $this->load->view('karigar_chain_wise_balance_list');?>

</div>
<h6 class='blue text-uppercase bold mb-3'>Karigar Lot Wise Total Process Balance </h6>
<div class="row">
<?php $this->load->view('karigar_chain_lot_wise_balance_list');?>

</div>
<h6 class='blue text-uppercase bold mb-3'>Karigar Hook Department Balance </h6>
<div class="row">
<?php $this->load->view('hook_department_of_chain_balance_list');?>

</div> 
</div>
