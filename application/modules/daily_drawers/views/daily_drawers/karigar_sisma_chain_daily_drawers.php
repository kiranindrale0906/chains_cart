<?php 
if(!empty($show_heading)&&$show_heading) { ?>
  <div class="boxrow mb-2">
    <div class="float-left">
     <h6 class="heading blue bold text-uppercase mb-0"><?= @getTableSettings()['page_title']; ?></h6>
    </div>
  </div>
<?php } ?>

<div class="table-responsive m-t-20">
  <h5> Group by Purity: 
    <a class="ml-5 <?= ($group_by_purity==0) ? 'bold black underline' : '' ?>" href='<?= base_url() ?>daily_drawers/karigar_wise_sisma_chain_daily_drawers?group_by_purity=0'>No</a>
    <a class="ml-5 <?= ($group_by_purity==1) ? 'bold black underline' : '' ?>" href='<?= base_url() ?>daily_drawers/karigar_wise_sisma_chain_daily_drawers?group_by_purity=1'>Yes</a>
  </h5>
  <?php 
    if(!empty($karigar_daily_drawers)){
      foreach ($karigar_daily_drawers as $karigar_name_index => $purity_columns) { ?>
        <br><h6 class="bold"><?=$karigar_name_index?></h6>
        <table class="table table-sm fixedthead table-default">
          <?php 
            $this->load->view('daily_drawers/daily_drawers/karigar_sisma_chain_daily_drawer_tbody',
                              array('purity_columns' => @$purity_columns,'karigar'=>$karigar_name_index));
          ?>
        </table>
     <?php }
    } else{ ?>
      <table class="table table-sm fixedthead table-default">
        <thead>
          <tr>
            <th>Purity</th>
            <th>Type</th>
            <th>In</th>
            <th>Out</th>
            <th>Balance</th>
            <th>Balance Fine</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              No Record Found.
            </td>
          </tr>
          </tbody>
      </table>
    <?php } 
  ?> 
</div>