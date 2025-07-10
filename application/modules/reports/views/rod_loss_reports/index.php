<div class="boxrow mb-2">
  <div class="float-left">
    <?php 
      $page_details = @getTableSettings();
      $href = ADMIN_PATH.'parent_lot_loss/parent_lot_loss_view?';
    ?>
    <h6 class="heading blue bold text-uppercase mb-0">
      <?= @$page_details['page_title']; ?>
    </h6>
  </div>
</div>
<div class="row">
  <!-- <?php
    // load_field('dropdown', array('field' => 'process_name',
    //                              'option' =>/* @$process_name*/,
    //                              'col' => 'col-sm-4',
    //                              'name' => 'parent_lot_process_name',
    //                              'value' => /*!empty($product_name) ? $product_name : ''*/));
  ?>
  <div class="col-sm-4 align-self-center"> 
    <?php //load_buttons('button', array('name' =>'Clear','class'=>'btn-xs btn_blue clear_btn')) ?>      
   </div> -->
</div>

<table class="table table-sm table-default table-hover">
  <thead>
    <tr> 
      <th>Rod Name</th>
      <th class="text-right">In Weight</th>
      <th class="text-right">Rod In</th>
      <th class="text-right">Rod Out</th>
      <th class="text-right">Out Weight</th>
      <th class="text-right">Loss</th>
      
    </tr>
  </thead>
  
  <tbody class='text-right'>
  <?php
    $in_weight=$in_rod=$out_rod=$out_weight=$loss=0;
    if($rod_loss_reports){
    foreach ($rod_loss_reports as $index => $reports) {
      $in_weight+=$reports['in_weight'];
      $out_weight+=$reports['out_weight'];
      $in_rod+=$reports['in_rod'];
      $out_rod+=$reports['out_rod'];
      $loss+=$reports['loss'];
   ?>
      <tr>
        <td class="text-left bold"><?=$reports['name']?></td>
        <td class="text-right"><?=four_decimal($reports['in_weight'])?></td>
        <td class="text-right"><?=four_decimal($reports['in_rod']);?></td>
        <td class="text-right"><?=four_decimal($reports['out_rod']);?></td>
        <td class="text-right"><?=four_decimal($reports['out_weight']);?></td>
        <td class="text-right"><?=four_decimal($reports['loss']);?></td>
      </tr>
      <?php }?>
      <tr class="bold">
        <td></td>
        <td><?=$in_weight?></td>
        <td><?=$in_rod?></td>
        <td><?=$out_rod?></td>
        <td><?=$out_weight?></td>
        <td><?=$loss?></td>
      </tr>
      <?php }else{ 
    ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      
    <?php }
    ?>
  </tbody>
</table>