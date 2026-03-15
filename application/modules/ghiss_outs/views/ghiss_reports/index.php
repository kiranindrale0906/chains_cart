<?php 
if($show_heading) { ?>
  <div class="boxrow mb-2">
    <div class="float-left">
      <h6 class="heading blue bold text-uppercase mb-0">
        <?= @getTableSettings()['page_title']; ?>
      </h6>
    </div>
  </div>
<?php } ?>


<h5> Type: 
  <a class="ml-5 <?= ($type=='all ghiss') ? 'bold black underline' : '' ?>" href='<?= base_url() ?>ghiss_outs/ghiss_reports?type=all ghiss'>All</a>
  <a class="ml-5 <?= ($type=='ghiss') ? 'bold black underline' : '' ?>" href='<?= base_url() ?>ghiss_outs/ghiss_reports?type=ghiss'>Ghiss</a>
  <a class="ml-5 <?= ($type=='hcl ghiss') ? 'bold black underline' : '' ?>" href='<?= base_url() ?>ghiss_outs/ghiss_reports?type=hcl ghiss'>Rope Ghiss</a>
  <a class="ml-5 <?= ($type=='pending ghiss') ? 'bold black underline' : '' ?>" href='<?= base_url() ?>ghiss_outs/ghiss_reports?type=pending ghiss'>Pending Ghiss</a>
</h5>

<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th>Product Name</th>
      <th>Department Name</th>      
      <th class="text-right">Ghiss</th>
      <th class="text-right">Ghiss Gross</th>
      <th class="text-right">Ghiss Fine</th>
    </tr>
  </thead>
  
  <tbody>
    <?php
      if(!empty($ghiss_records)){
        $ghiss_total= $ghiss_gross_total=$ghiss_fine_total=0;
        foreach ($ghiss_records as $index => $ghiss_record) {
          $ghiss_total+=$ghiss_record['ghiss'];
          $ghiss_gross_total+=$ghiss_record['ghiss_gross'];
          $ghiss_fine_total+=$ghiss_record['ghiss_fine'];
          ?>
         <tr>
            <td><?= $ghiss_record['product_name'] ?></td>
            <td><?= $ghiss_record['department_name']?></td>
            <td class="text-right"><?= four_decimal($ghiss_record['ghiss']) ?></td>
            <td class="text-right"><?= four_decimal($ghiss_record['ghiss_gross']) ?></td>
            <td class="text-right"><?= four_decimal($ghiss_record['ghiss_fine']) ?></td>
          </tr> 
        <?php }?>
         <tr class="bg_gray">
            <td></td>
            <td></td>
            <td class="text-right bold"><span><?= four_decimal($ghiss_total) ?></span></td>
            <td class="text-right bold"><span><?= four_decimal($ghiss_gross_total) ?></span></td>
            <td class="text-right bold"><span><?= four_decimal($ghiss_fine_total) ?></span></td>
         </tr>

     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
</table>