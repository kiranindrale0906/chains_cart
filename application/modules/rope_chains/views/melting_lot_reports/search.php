<div class="row"> 
  <div class="col-md-12">
    <h6>
      Purities: 
      <a class="ml-5 <?= ($purity == '') ? 'bold black underline' : '' ?>" 
         href='<?= base_url() ?>rope_chains/melting_lot_reports/create?purity=&category_one=<?= $category_one ?>balance_status=<?= $balance_status ?>'>All</a>
        <?php foreach ($purities as $lot_purity) { ?>
            <a class="ml-5 <?= ($purity == $lot_purity) ? 'bold black underline' : '' ?>"
             href='<?= base_url() ?>rope_chains/melting_lot_reports/create?purity=<?= $lot_purity?>&category_one=<?= $category_one ?>&balance_status=<?= $balance_status ?>'><?= four_decimal($lot_purity) ?></a>
        <?php } ?>
    </h6>
  </div>
</div>

<div class="row"> 
  <div class="col-md-12">
    <h6>
      Category One: 
      <a class="ml-5 <?= ($category_one == '') ? 'bold black underline' : '' ?>" 
         href='<?= base_url() ?>rope_chains/melting_lot_reports/create?purity=<?= $purity ?>&category_one=&balance_staus=<?= $balance_status ?>'>All</a>
        <?php foreach ($category_ones as $cat_one) { ?>
            <a class="ml-5 <?= ($category_one == $cat_one) ? 'bold black underline' : '' ?>"
             href='<?= base_url() ?>rope_chains/melting_lot_reports/create?purity=<?= $purity ?>&category_one=<?= $cat_one ?>&balance_staus=<?= $balance_status ?>'><?= $cat_one ?></a>    
        <?php } ?>
    </h6>
  </div>
</div>

<div class="row"> 
  <div class="col-md-12">
    <h6>
      Parent Lot: 
      <a class="ml-5 <?= ($category_two == '') ? 'bold black underline' : '' ?>" 
         href='<?= base_url() ?>rope_chains/melting_lot_reports/create?purity=<?= $purity ?>&category_one=<?= $category_one ?>&category_two=&balance_staus=<?= $balance_status ?>'>All</a>
        <?php foreach ($category_twos as $cat_two) { ?>
            <a class="ml-5 <?= ($category_two == $cat_two) ? 'bold black underline' : '' ?>"
             href='<?= base_url() ?>rope_chains/melting_lot_reports/create?purity=<?= $purity ?>&category_one=<?= $category_one ?>&category_two=<?= $cat_two ?>&balance_staus=<?= $balance_status ?>'><?= $cat_two ?></a>    
        <?php } ?>
    </h6>
  </div>
</div>
<!-- 
<div class="row mb-2"> 
  <div class="col-md-12">
    <h6>
      Machine Size: 
      <a class="ml-5 <?= ($category_three == '') ? 'bold black underline' : '' ?>" 
         href='<?= base_url() ?>rope_chains/melting_lot_reports/create?purity=<?= $purity ?>&category_one==<?= $category_one ?>&category_two=<?= $category_two ?>&category_three=&design_code=<?= $design_code ?>&balance_staus=<?= $balance_status ?>'>All</a>
      <div class="row">
        <?php foreach ($category_threes as $cat_three) { ?>
          <div class="col-md-1 float-left">  
            <a class="<?= ($category_three == $cat_three) ? 'bold black underline' : '' ?>"
             href='<?= base_url() ?>rope_chains/melting_lot_reports/create?purity=<?= $purity ?>&category_one=<?= $category_one ?>&category_two=<?= $category_two ?>&category_three=<?= $cat_three ?>&design_code=<?= $design_code ?>&balance_staus=<?= $balance_status ?>'><?= $cat_three ?></a>    
          </div>
        <?php } ?>
      </div>
    </h6>
  </div>
</div>

<div class="row"> 
  <div class="col-md-12">
    <h6>
      Design Code: 
      <a class="ml-5 <?= ($design_code == '') ? 'bold black underline' : '' ?>" 
         href='<?= base_url() ?>rope_chains/melting_lot_reports/create?purity=<?= $purity ?>&category_one==<?= $category_one ?>&category_two=<?= $category_two ?>&category_three=<?= $category_three ?>&design_code=&balance_staus=<?= $balance_status ?>'>All</a>
      <div class="row">
        <?php foreach ($category_fours as $design) { ?>
          <div class="col-md-2 float-right">  
            <a class="<?= ($design_code == $design) ? 'bold black underline' : '' ?>"
             href='<?= base_url() ?>rope_chains/melting_lot_reports/create?purity=<?= $purity ?>&category_one=<?= $category_one ?>&category_two=<?= $category_two ?>&category_three=<?= $category_three ?>&design_code=<?= $design ?>&balance_staus=<?= $balance_status ?>'><?= $design ?></a>    
          </div>
        <?php } ?>
      </div>
    </h6>
  </div>
</div>
 -->
<div class="row"> 
  <div class="col-md-12">
    <h6>
      Balance Status:
      <a class="ml-5 <?= ($balance_status == '') ? 'bold black underline' : '' ?>" 
         href='<?= base_url() ?>rope_chains/melting_lot_reports/create?purity=<?= $purity ?>&category_one=<?= $category_one ?>&balance_status='>All</a>
        <?php foreach ($balance_statuses as $status) { ?>
            <a class="ml-5 <?= ($balance_status == $status) ? 'bold black underline' : '' ?>"
             href='<?= base_url() ?>rope_chains/melting_lot_reports/create?purity=<?= $purity ?>&category_one=<?= $category_one ?>&balance_status=<?= $status ?>'><?= $status ?></a>
        <?php } ?>
    </h6>
  </div>
</div>
