
<div class="boxrow mb-2">
  <div class="float-left">
   <h6 class="heading blue bold text-uppercase mb-0"><?= @getTableSettings()['page_title']; ?></h6>
  </div>
</div>

<form class="fields-group-sm">
  <div class="row">
    <?php 
      load_field('dropdown', array('field' => 'chain_name',
                                   'name' => 'chain_name',
                                   'option' => $chain_names,
                                   'class' => 'chain_wise_dd_summery_chain_name'));
    ?>            
  </div>
</form>
<?php 
  if (!empty($record['chain_name'])) { ?>
    <div class="table-responsive m-t-20">
     <h5 class="heading blue m-0">Wastage</h5>
      <table class="table table-sm fixedthead table-default">
      <?php 
        // $this->load->view('daily_drawers/chain_wise_daily_drawer_summeries/table_header');
        $this->load->view('daily_drawers/chain_wise_daily_drawer_summeries/wastage_table_body');
      ?>
      </table>
    </div>
    <!-- <div class="table-responsive m-t-20">
      <h5 class="heading blue m-0">Office Outside</h5>
      <table class="table table-sm fixedthead table-default">
      <?php 
        $this->load->view('daily_drawers/chain_wise_daily_drawer_summeries/table_header');
        $this->load->view('daily_drawers/chain_wise_daily_drawer_summeries/table_body');
      ?>
      </table>
    </div> -->

    <div class="table-responsive m-t-20">
      <h5 class="heading blue m-0">Ghiss</h5>
      <table class="table table-sm fixedthead table-default">
      <?php 
        $this->load->view('daily_drawers/chain_wise_daily_drawer_summeries/other_table_header');
        $this->load->view('daily_drawers/chain_wise_daily_drawer_summeries/ghiss_table_body');
      ?>
      </table>
    </div>
    <div class="table-responsive m-t-20">
      <h5 class="heading blue m-0">Tounch Out</h5>
      <table class="table table-sm fixedthead table-default">
      <?php 
        $this->load->view('daily_drawers/chain_wise_daily_drawer_summeries/other_table_header');
        $this->load->view('daily_drawers/chain_wise_daily_drawer_summeries/tounch_out_table_body');
      ?>
      </table>
    </div>
  <?php }
?> 


              
          
     
              
            