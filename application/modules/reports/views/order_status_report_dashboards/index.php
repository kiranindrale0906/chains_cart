<div class="boxrow mb-2">
  <div class="float-left">
    <h6 class="heading blue bold text-uppercase mb-0">
      <?= @getTableSettings()['page_title']; ?>
    </h6>
  </div>
</div>
<div class="row">
  <?php
    foreach ($dashboard_counts as $index => $dashboard_count) {
      echo '<div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">'.$index.'</h5>
                  <p class="card-text">'.$dashboard_count.'</p>
                  <a href="'.base_url("reports/order_status_reports?status=".$index).'" class="btn btn-primary">View</a>
                </div>
              </div>
            </div>';
    }
  ?>
</div>
<div class="row" style="margin-top: 25px;">
  <div class="col-md-12">
    <?php 
      if($status != ""){
        $file_name = strtolower(str_replace(" ", "_", $status));
        $this->load->view('reports/order_status_report_dashboards/'.$file_name);
      }
    ?>
  </div>
</div>