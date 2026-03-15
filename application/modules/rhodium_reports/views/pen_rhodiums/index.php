<div class="boxrow mb-2">
  <div class="float-left">
    <h6 class="heading blue bold text-uppercase mb-0"><?= @getTableSettings()['page_title']; ?></h6>
  </div>
</div>
<hr>
<form class="fields-group-sm">
  <div class="row"> 
  <div class="col-md-12">
    <h6>
      Type: <a class="ml-5 <?= ($this->router->class == "pen_rhodiums") ? 'bold black underline' : '' ?>"
             href='<?= base_url() ?>rhodium_reports/pen_rhodiums'> Pen Rhodium</a> 
            <a class="ml-5 <?= ($this->router->class == "dip_rhodiums") ? 'bold black underline' : '' ?>"
             href='<?= base_url() ?>rhodium_reports/dip_rhodiums'> Dip Rhodium</a> 
            <a class="ml-5 <?= ($this->router->class == "two_tone_rhodiums") ? 'bold black underline' : '' ?>"
             href='<?= base_url() ?>rhodium_reports/two_tone_rhodiums'> Two Tone Rhodium</a> 
    </h6>
  </div>
</div>
  <div class="row">
    <?php load_field('date', array('field' => 'from_date', 'name' => 'from_date', 'class' => 'datepicker_js', 'col'=>'col-sm-2', 'value' => date('d M Y',strtotime($from_date))));?>
    <?php load_field('date', array('field' => 'to_date', 'name' => 'to_date','class' => 'datepicker_js', 'col'=>'col-sm-2', 'value' => date('d M Y',strtotime($to_date))));?>  
    <div class="col-sm-3 align-self-center">
      <?php load_buttons('submit', array('name' =>'Search','class'=>'btn-xs btn_blue mr-2')) ?> 
      <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs clear_btn btn_blue')) ?>
    </div>
  </div>
</form>

<?php if(isset($report_datas) && !empty($report_datas)) {
  ?>
  <table class="table table-bordered table-sm">
    <thead class="bg_gray">
      <tr>
        <th>Date</th>
        <th>Product Name</th>
        <th>Design Name</th>
        <th class="text-right">Production</th>
        <th class="text-right">Vodator</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $sum_out_weight=$sum_vodator=0;
      foreach ($report_datas as $record) { 
        $sum_out_weight+=$record['out_weight'];
        $sum_vodator+=$record['rhodium_in'];

        ?>
        <tr>
          <td><?=date("d-m-Y",strtotime($record['date']))?></td>
          <td><?=$record['product_name']?></td>
          <td><?=$record['design_name']?></td>
          <td class="text-right"><?=four_decimal($record['out_weight'])?></td>
          <td class="text-right"><?=four_decimal($record['rhodium_in'])?></td>
          <td><a href="<?=base_url()?>processes/processes/view/<?=$record['id']?>">View</a></td>
        </tr>
      <?php } ?>
       <tr class="bg_gray Bold">
            <td>Total</td>
            <td></td>
            <td></td>
            <td class="text-right"><?= four_decimal($sum_out_weight)  ?></td>
            <td class="text-right"><?= four_decimal($sum_vodator)  ?></td>
            <td></td>
         </tr>
    </tbody>

  </table>  
<?php } else {
  echo '<h5 class="text-center mt-3">No records found for selected filters.</h5>';
} ?>