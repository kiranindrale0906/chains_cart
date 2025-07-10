<div class="row">
<?php   
   load_field('text', array('field' => 'gpc_out'));
   $this->load->view('processes/process_factory_order_details/order_category_details');
?>
</div>
<!-- <h6 class="bold float-left mb-0">Pending Order Details</h6>
<br>
<div class="table-responsive">
  <table class="table table-bordered table-sm border-bottom-color">
    <thead class="bg_gray ">
      <tr>
        <th></th>
        <th>Customer Name</th>
        <th class="text-center">14 Inch Qty</th>
        <th class="text-center">15 Inch Qty</th>
        <th class="text-center">16 Inch Qty</th>
        <th class="text-center">17 Inch Qty</th>
        <th class="text-center">18 Inch Qty</th>
        <th class="text-center">19 Inch Qty</th>
        <th class="text-center">20 Inch Qty</th>
        <th class="text-center">21 Inch Qty</th>
        <th class="text-center">22 Inch Qty</th>
        <th class="text-center">23 Inch Qty</th>
        <th class="text-center">24 Inch Qty</th>
        <th class="text-center">25 Inch Qty</th>   
        <th class="text-center">26 Inch Qty</th>
        <th class="text-center">27 Inch Qty</th>
        <th class="text-center">28 Inch Qty</th>
        <th class="text-center">29 Inch Qty</th>
        <th class="text-center">30 Inch Qty</th>
        <th class="text-center">31 Inch Qty</th>
        <th class="text-center">32 Inch Qty</th>
        <th class="text-center">33 Inch Qty</th>
        <th class="text-center">34 Inch Qty</th>
        <th class="text-center">35 Inch Qty</th>
        <th class="text-center">36 Inch Qty</th>
        <th >Total WT</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        // if(!empty($process_factory_order_details)){
        //   foreach($process_factory_order_details as $index => $process_factory_order_detail) { ?>
            <tr>
              <td>
                <?php //load_field('checkbox', array('field' => 'factory_order_detail_id',
                                                   // 'class' => 'factory_order_detail_id',
                                                   // 'index' => $index,
                                                   // 'value' => 0,
                                                   // 'option' => array(
                                                   //              array('chk_id' => $index,
                                                   //                    'value' => $process_factory_order_detail['factory_order_detail_id'],
                                                   //                    'label' => '',
                                                   //                    'checked' => '')),
                                                   // 'controller' => 'process_factory_order_details'));?>
              </td>

              <td><?php //echo $process_factory_order_detail['customer_name'];?></td>
                <?php 
                  // $wt_per_inch=0;
                  // if ($process_factory_order_detail['wt_in_18_inch'] != 0)
                  //   $wt_per_inch = $process_factory_order_detail['wt_in_18_inch'] / 18;
                  // elseif ($process_factory_order_detail['wt_in_24_inch'] != 0)
                  //   $wt_per_inch = $process_factory_order_detail['wt_in_24_inch'] / 24;
                  
                  // echo four_decimal($wt_per_inch);
                ?>

              <?php 
                // $inch_names = array('14','15', '16','17', '18','19', '20','21', '22','23', '24', '26','27' ,'28','29' ,'30','31', '32','33', '34','35','36') ;
                // foreach ($inch_names as $inch_name)   
                //   $this->load->view('processes/process_factory_order_hook_details/qty_in_field', array('index' => $index,
                //                                                                             'field_name' => $inch_name.'_inch_qty',
                //                                                                             'field_value' => $process_factory_order_detail[$inch_name.'_inch_qty'])); 
              ?>
              
              <td class="text-right">
                <?php //echo $total=four_decimal(($process_factory_order_detail['14_inch_qty']*14*$wt_per_inch)+
                //                                ($process_factory_order_detail['15_inch_qty']*15*$wt_per_inch)+
                //                                ($process_factory_order_detail['16_inch_qty']*16*$wt_per_inch)+
                //                                ($process_factory_order_detail['17_inch_qty']*17*$wt_per_inch)+
                //                                ($process_factory_order_detail['18_inch_qty']*18*$wt_per_inch)+
                //                                ($process_factory_order_detail['19_inch_qty']*19*$wt_per_inch)+
                //                                ($process_factory_order_detail['20_inch_qty']*20*$wt_per_inch)+
                //                                ($process_factory_order_detail['21_inch_qty']*21*$wt_per_inch)+
                //                                ($process_factory_order_detail['22_inch_qty']*22*$wt_per_inch)+
                //                                ($process_factory_order_detail['23_inch_qty']*23*$wt_per_inch)+
                //                                ($process_factory_order_detail['24_inch_qty']*24*$wt_per_inch)+
                //                                ($process_factory_order_detail['25_inch_qty']*25*$wt_per_inch)+
                //                                ($process_factory_order_detail['26_inch_qty']*26*$wt_per_inch)+
                //                                ($process_factory_order_detail['27_inch_qty']*27*$wt_per_inch)+
                //                                ($process_factory_order_detail['28_inch_qty']*28*$wt_per_inch)+
                //                                ($process_factory_order_detail['29_inch_qty']*29*$wt_per_inch)+
                //                                ($process_factory_order_detail['30_inch_qty']*30*$wt_per_inch)+
                //                                ($process_factory_order_detail['31_inch_qty']*31*$wt_per_inch)+
                                              
                //                                ($process_factory_order_detail['32_inch_qty']*32*$wt_per_inch)+
                //                                ($process_factory_order_detail['33_inch_qty']*33*$wt_per_inch)+
                //                                ($process_factory_order_detail['34_inch_qty']*34*$wt_per_inch)+
                //                                ($process_factory_order_detail['35_inch_qty']*35*$wt_per_inch)+
                //                                ($process_factory_order_detail['36_inch_qty']*36*$wt_per_inch)) ?></td>
                             
            </tr>
            <?php 
         // }
        //}
      ?>
    </tbody>
  </table>
</div>  -->
<br>
<br>