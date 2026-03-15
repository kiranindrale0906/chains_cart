<?php 
//if($show_form) { ?>
  <div class="boxrow mb-2">
    <div class="float-left">
      <h6 class="heading blue bold text-uppercase mb-0">
        <?= @getTableSettings()['page_title']; ?>
      </h6>
    </div>
  </div>
  <form class="fields-group-sm">
    <div class="row">
      <?php load_field('date',array('field' => 'from_date', 'col'=>'col-sm-3', 
                                  'id' => 'gpc_out_city_reports_from_date', 'class' => 'gpc_out_city_reports_filter datepicker_js'));?>
      <?php load_field('date',array('field' => 'to_date', 'col'=>'col-sm-3', 
                                  'id' => 'gpc_out_city_reports_to_date', 'class' => 'gpc_out_city_reports_filter datepicker_js'));?>
      <?php load_field('dropdown',array('field' => 'product_name', 'col'=>'col-sm-4','option'=>$product_name))?> 
      <?php load_field('dropdown',array('field' => 'city', 'col'=>'col-sm-4','option'=>$city))?> 
      <?php load_field('dropdown',array('field' => 'in_lot_purity', 'col'=>'col-sm-4','option'=>$in_lot_purity))?> 
      
    </div>
  </form>
<?php //} ?>
<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th>Date</th>      
      <th>Product Name</th>
      <th class="text-right ">Category</th>
      <th class="text-right ">City</th>
      <th class="text-right ">Gpc Out</th>
      <th class="text-right ">Melting</th>
      <th class="text-right ">Fine</th>
    </tr>
  </thead>
  
  <tbody>
    <?php

      if(!empty($gpc_out_city_records)){
        $gpc_out_total=0;
        $gpc_out_fine=0;
        foreach ($gpc_out_city_records as $index => $gpc_out_city_record) {
          $gpc_out_fine+=($gpc_out_city_record['gpc_out']*$gpc_out_city_record['in_lot_purity']/100);
          $gpc_out_total+=$gpc_out_city_record['gpc_out'];
          ?>
         <tr>
            <td><?= date('d-m-y',strtotime($gpc_out_city_record['created_at']))?></td>
            <td ><?= $gpc_out_city_record['product_name']?></td>
            <td class="text-right "><?= $gpc_out_city_record['melting_lot_category_one'] ?></td>
            <td class="text-right "><?= $gpc_out_city_record['city'] ?></td>
            <td class="text-right "><?= four_decimal($gpc_out_city_record['gpc_out']) ?></td>
            <td class="text-right "><?= four_decimal($gpc_out_city_record['in_lot_purity']) ?></td>
             <td class="text-right "><?= four_decimal(($gpc_out_city_record['gpc_out'])*$gpc_out_city_record['in_lot_purity']/100) ?></td>
          </tr> 
        <?php }?>
         <tr class="bg_gray">
            <td></td>
            <td></td>
            <td class="text-right bold"></td>
            <td class="text-right bold"></td>
            <td class="text-right bold"><?= four_decimal($gpc_out_total) ?></td>
            <td class="text-right bold"></td>
            <td class="text-right bold"><b><span><?= four_decimal($gpc_out_fine) ?></span></b></td>
         </tr>

     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
</table>