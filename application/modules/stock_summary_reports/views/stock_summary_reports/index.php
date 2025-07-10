<div class="boxrow mb-2">
  <div class="float-left">
    <h6 class="heading blue bold text-uppercase mb-0"><?= @getTableSettings()['page_title']; ?></h6>
  </div>
</div>

<table class="table table-sm table-default table-hover">
  <?php $this->load->view('table_header'); ?>
  <tbody>
    <th class="blue medium bg-light" colspan="7"><h6 class="heading blue m-0">RECEIVED SUMMARY</h6></th>
  </tbody>

  <tbody class="toggle_div">
    <?php //if(HOST=='Export'){?>
    <?php //$this->load->view('stock_summary_reports/stock_summary_reports/receipt_summary');?>
    <?php //}?>
    <?php $this->load->view('stock_summary_reports/stock_summary_reports/stock_summary');?>

    <?php if(HOST=='Hallmark' || HOST=='Export'|| HOST=='Domestic'){
      $this->load->view('stock_summary_reports/stock_summary_reports/issue_summary');
    }?>
    <?php $this->load->view('stock_summary_reports/stock_summary_reports/total');?>
