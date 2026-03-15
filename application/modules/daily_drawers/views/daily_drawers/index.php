<?php 

if($show_heading){ ?>
  <div class="boxrow mb-2">
    <div class="float-left">
     <h5 class="heading blue bold text-uppercase mb-0"><?= @getTableSettings()['page_title']; ?></h5>
    </div>
  </div>
<?php } ?>
<hr />
<div class="table-responsive m-t-20">
  <h6 class="heading blue m-0 bold text-uppercase">
    <?= (HOST == 'ARF') ? 'Factory Daily Drawer Wastages' : 'Hook Wastages' ?>
  </h6>
  <table class="table table-sm fixedthead table-default table-hover">
  <?php 
    $this->load->view('daily_drawers/daily_drawers/daily_drawer_wastage_table_header');
    $this->load->view('daily_drawers/daily_drawers/wastage_table_body', array('dd_wastages' => $wastages,'category'=>'1'));
  ?>
  </table>
</div>
<hr />

<?php if (HOST == 'ARF') { ?>
  <!-- <div class="table-responsive m-t-20">
    <h6 class="heading blue m-0 bold text-uppercase">
      Cutting Wastages
    </h6>
    <table class="table table-sm fixedthead table-default table-hover">
    <?php 
      $this->load->view('daily_drawers/daily_drawers/daily_drawer_wastage_table_header');
      $this->load->view('daily_drawers/daily_drawers/wastage_table_body', array('dd_wastages' => $cutting_daily_drawer_wastages,'category'=>'2'));
    ?>
    </table>
  </div>
  <hr /> -->
<?php } ?>

<?php if (HOST == 'ARF') { ?>
  <div class="table-responsive m-t-20">
    <h6 class="heading blue m-0 bold text-uppercase">
      Fancy Chain and Pipe / Para Wastages
    </h6>
    <table class="table table-sm fixedthead table-default table-hover">
    <?php 
      $this->load->view('daily_drawers/daily_drawers/daily_drawer_wastage_table_header');
      $this->load->view('daily_drawers/daily_drawers/wastage_table_body', array('dd_wastages' => $fancy_chain_daily_drawer_wastages,'category'=>'3'));
    ?>
    </table>
  </div>
  <hr />
<?php } ?>

<?php if (HOST != 'ARF') { ?>
  <div class="table-responsive m-t-20">
    <h6 class="heading blue m-0 bold text-uppercase">Other Daily Drawer Wastages</h6>
    <table class="table table-sm fixedthead table-default table-hover">
    <?php 
      $this->load->view('daily_drawers/daily_drawers/daily_drawer_wastage_table_header');
      $this->load->view('daily_drawers/daily_drawers/category_wastage_table_body');
    ?>
    </table>
  </div>
  <hr />
<?php } ?>


<div class="table-responsive m-t-20">
 <h6 class="heading blue m-0 bold text-uppercase">Tone Wise Wastage</h6>
  <table class="table table-sm fixedthead table-default table-hover">
  <?php 
    $this->load->view('daily_drawers/daily_drawers/daily_drawer_wastage_table_header');
    $this->load->view('daily_drawers/daily_drawers/tone_wastage_table_body');
  ?>
  </table>
</div>
<hr />

<div class="table-responsive m-t-20">
  <h6 class="heading blue m-0 bold text-uppercase">Office Outside</h6>
  <table class="table table-sm fixedthead table-default table-hover">
  <?php 
    $this->load->view('daily_drawers/daily_drawers/table_header');
    $this->load->view('daily_drawers/daily_drawers/table_body');
  ?>
  </table>
</div>
<hr />

<div class="table-responsive m-t-20">
  <h6 class="heading blue m-0 bold text-uppercase">Other Wastages</h6>
  <table class="table table-sm fixedthead table-default table-hover">
  <?php 
    $this->load->view('daily_drawers/daily_drawers/other_table_header');
    $this->load->view('daily_drawers/daily_drawers/other_wastage_table_body', array('wastage_type' => 'Ghiss', 
                                                                                    'records' => $ghiss_reports));
    $this->load->view('daily_drawers/daily_drawers/other_wastage_table_body', array('wastage_type' => 'GPC Powder', 
                                                                                    'records' => $gpc_powder_reports));
    $this->load->view('daily_drawers/daily_drawers/other_wastage_table_body', array('wastage_type' => 'Tounch Out', 
                                                                                    'records' => $tounch_out_reports));
    $this->load->view('daily_drawers/daily_drawers/other_wastage_table_body', array('wastage_type' => 'Solder Wastage', 
                                                                                    'records' => $solder_wastage_reports));
  ?>
  </table>
</div>