<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
}
</style>

<div id="container" class="container" >
    <div class="row"> 
    <h3>Factory Orders</h3>
    <p>Customer name:<?=$factory_orders['customer_name']?></p>
    <p>Melting:<?=$factory_orders['melting']?></p>
    <p>Date:<?=date('d-m-Y',strtotime($factory_orders['date']))?></p>
    </div>
    <h4>Factory Order Details</h4>
    <table class="table table-sm">
      <thead class="bg_gray">
        <tr>
          <th>Category Name</th>
          <th>Design Name</th>
          <th class='text-right'>Line</th>
          <th class='text-right'>Gauge</th>
          <th>Market Design Name</th>  
          <th class='text-right'>Wt In 18 Inch</th>
          <th class='text-right'>Wt In 24 Inch</th>
          <th class='text-right'>14 Inch Qty</th>
          <th class='text-right'>15 Inch Qty</th>
          <th class='text-right'>16 Inch Qty</th>
          <th class='text-right'>17 Inch Qty</th>
          <th class='text-right'>18 Inch Qty</th>
          <th class='text-right'>19 Inch Qty</th>
          <th class='text-right'>20 Inch Qty</th>
          <th class='text-right'>21 Inch Qty</th>
          <th class='text-right'>22 Inch Qty</th>
          <th class='text-right'>23 Inch Qty</th>
          <th class='text-right'>24 Inch Qty</th>
          <th class='text-right'>25 Inch Qty</th>
          <th class='text-right'>26 Inch Qty</th>
          <th class='text-right'>27 Inch Qty</th>
          <th class='text-right'>28 Inch Qty</th>
          <th class='text-right'>29 Inch Qty</th>
          <th class='text-right'>30 Inch Qty</th>
          <th class='text-right'>31 Inch Qty</th>
          <th class='text-right'>32 Inch Qty</th>
          <th class='text-right'>33 Inch Qty</th>
          <th class='text-right'>34 Inch Qty</th>
          <th class='text-right'>35 Inch Qty</th>
          <th class='text-right'>36 Inch Qty</th>
        </tr>
      </thead>
      <tbody>
        <?php

        if(!empty($factory_order_details)) {
          $inch_qty_14=$inch_qty_14_ready=$inch_qty_15=$inch_qty_15_ready=$inch_qty_16=$inch_qty_16_ready=$inch_qty_17=$inch_qty_17_ready=$inch_qty_18=$inch_qty_18_ready=$inch_qty_19=$inch_qty_19_ready=$inch_qty_20=$inch_qty_20_ready=$inch_qty_21=$inch_qty_21_ready=$inch_qty_22=$inch_qty_22_ready=$inch_qty_23=$inch_qty_23_ready=$inch_qty_24=$inch_qty_24_ready=$inch_qty_25=$inch_qty_25_ready=$inch_qty_26=$inch_qty_26_ready=$inch_qty_27=$inch_qty_27_ready=$inch_qty_28=$inch_qty_28_ready=$inch_qty_29=$inch_qty_29_ready=$inch_qty_30=$inch_qty_30_ready=$inch_qty_31=$inch_qty_31_ready=$inch_qty_32=$inch_qty_32_ready=$inch_qty_33=$inch_qty_33_ready=$inch_qty_34=$inch_qty_34_ready=$inch_qty_35=$inch_qty_35_ready=$inch_qty_36=$inch_qty_36_ready=0;
          foreach ($factory_order_details as $index => $order_detail) {

            $inch_qty_14+=$order_detail['14_inch_qty'];
            $inch_qty_14_ready+=$order_detail['14_inch_qty_ready'];
            
            $inch_qty_15+=$order_detail['15_inch_qty'];
            $inch_qty_15_ready+=$order_detail['15_inch_qty_ready'];
            
            $inch_qty_16+=$order_detail['16_inch_qty'];
            $inch_qty_16_ready+=$order_detail['16_inch_qty_ready'];
            
            $inch_qty_17+=$order_detail['17_inch_qty'];
            $inch_qty_17_ready+=$order_detail['17_inch_qty_ready'];
            
            $inch_qty_18+=$order_detail['18_inch_qty'];
            $inch_qty_18_ready+=$order_detail['18_inch_qty_ready'];
            
            $inch_qty_20+=$order_detail['20_inch_qty'];
            $inch_qty_20_ready+=$order_detail['20_inch_qty_ready'];
            
            $inch_qty_21+=$order_detail['21_inch_qty'];
            $inch_qty_21_ready+=$order_detail['21_inch_qty_ready'];
            
            $inch_qty_22+=$order_detail['22_inch_qty'];
            $inch_qty_22_ready+=$order_detail['22_inch_qty_ready'];

            $inch_qty_23+=$order_detail['23_inch_qty'];
            $inch_qty_23_ready+=$order_detail['23_inch_qty_ready'];

            $inch_qty_24+=$order_detail['24_inch_qty'];
            $inch_qty_24_ready+=$order_detail['24_inch_qty_ready'];

            $inch_qty_25+=$order_detail['25_inch_qty'];
            $inch_qty_25_ready+=$order_detail['25_inch_qty_ready'];

            $inch_qty_26+=$order_detail['26_inch_qty'];
            $inch_qty_26_ready+=$order_detail['26_inch_qty_ready'];

            $inch_qty_27+=$order_detail['27_inch_qty'];
            $inch_qty_27_ready+=$order_detail['27_inch_qty_ready'];

            $inch_qty_28+=$order_detail['28_inch_qty'];
            $inch_qty_28_ready+=$order_detail['28_inch_qty_ready'];

            $inch_qty_29+=$order_detail['29_inch_qty'];
            $inch_qty_29_ready+=$order_detail['29_inch_qty_ready'];

            $inch_qty_30+=$order_detail['30_inch_qty'];
            $inch_qty_30_ready+=$order_detail['30_inch_qty_ready'];

            $inch_qty_31+=$order_detail['31_inch_qty'];
            $inch_qty_31_ready+=$order_detail['31_inch_qty_ready'];

            $inch_qty_32+=$order_detail['32_inch_qty'];
            $inch_qty_32_ready+=$order_detail['32_inch_qty_ready'];

            $inch_qty_33+=$order_detail['33_inch_qty'];
            $inch_qty_33_ready+=$order_detail['33_inch_qty_ready'];

            $inch_qty_34+=$order_detail['34_inch_qty'];
            $inch_qty_34_ready+=$order_detail['34_inch_qty_ready'];

            $inch_qty_35+=$order_detail['35_inch_qty'];
            $inch_qty_35_ready+=$order_detail['35_inch_qty_ready'];

            $inch_qty_36+=$order_detail['36_inch_qty'];
            $inch_qty_36_ready+=$order_detail['36_inch_qty_ready'];

           ?>
            <tr>
              <td><?php echo $order_detail['category_name'];?></td>
              <td><?php echo $order_detail['design_name'];?></td>
              <td class='text-right'><?php echo $order_detail['line'];?></td>
              <td class='text-right'><?php echo $order_detail['gauge'];?></td>
              <td><?php echo $order_detail['market_design_name'];?></td>
              <td class='text-right'><?php echo $order_detail['wt_in_18_inch'];?></td>
              <td class='text-right'><?php echo $order_detail['wt_in_24_inch'];?></td>
              <td class='text-right'><?php echo !empty($order_detail['14_inch_qty'])?$order_detail['14_inch_qty_ready'].' / '.$order_detail['14_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['15_inch_qty'])?$order_detail['15_inch_qty_ready'].' / '.$order_detail['15_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['16_inch_qty'])?$order_detail['16_inch_qty_ready'].' / '.$order_detail['16_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['17_inch_qty'])?$order_detail['17_inch_qty_ready'].' / '.$order_detail['17_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['18_inch_qty'])?$order_detail['18_inch_qty_ready'].' / '.$order_detail['18_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['19_inch_qty'])?$order_detail['19_inch_qty_ready'].' / '.$order_detail['19_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['20_inch_qty'])?$order_detail['20_inch_qty_ready'].' / '.$order_detail['20_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['21_inch_qty'])?$order_detail['21_inch_qty_ready'].' / '.$order_detail['21_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['22_inch_qty'])?$order_detail['22_inch_qty_ready'].' / '.$order_detail['22_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['23_inch_qty'])?$order_detail['23_inch_qty_ready'].' / '.$order_detail['23_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['24_inch_qty'])?$order_detail['24_inch_qty_ready'].' / '.$order_detail['24_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['25_inch_qty'])?$order_detail['25_inch_qty_ready'].' / '.$order_detail['25_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['26_inch_qty'])?$order_detail['26_inch_qty_ready'].' / '.$order_detail['26_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['27_inch_qty'])?$order_detail['27_inch_qty_ready'].' / '.$order_detail['27_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['28_inch_qty'])?$order_detail['28_inch_qty_ready'].' / '.$order_detail['28_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['29_inch_qty'])?$order_detail['29_inch_qty_ready'].' / '.$order_detail['29_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['30_inch_qty'])?$order_detail['30_inch_qty_ready'].' / '.$order_detail['30_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['31_inch_qty'])?$order_detail['31_inch_qty_ready'].' / '.$order_detail['31_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['32_inch_qty'])?$order_detail['32_inch_qty_ready'].' / '.$order_detail['32_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['33_inch_qty'])?$order_detail['33_inch_qty_ready'].' / '.$order_detail['33_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['34_inch_qty'])?$order_detail['34_inch_qty_ready'].' / '.$order_detail['34_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['35_inch_qty'])?$order_detail['35_inch_qty_ready'].' / '.$order_detail['35_inch_qty']:'-';?></td>
              <td class='text-right'><?php echo !empty($order_detail['36_inch_qty'])?$order_detail['36_inch_qty_ready'].' / '.$order_detail['36_inch_qty']:'-';?></td>
            </tr>
            
      <?php  }?>
       <tr class="bg_gray bold">
               <td>Total</td>
              <td class='text-right'></td>
              <td class='text-right'></td>
              <td></td>
              <td class='text-right'></td>
              <td class='text-right'></td>
              <td class='text-right'></td>
              <td class='text-right'><?php echo !empty($inch_qty_14)?$inch_qty_14_ready.' / '.$inch_qty_14:'-';?></td>
               <td class='text-right'><?php echo !empty($inch_qty_15)?$inch_qty_15_ready.' / '.$inch_qty_15:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_16)?$inch_qty_16_ready.' / '.$inch_qty_16:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_17)?$inch_qty_17_ready.' / '.$inch_qty_17:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_18)?$inch_qty_18_ready.' / '.$inch_qty_18:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_19)?$inch_qty_19_ready.' / '.$inch_qty_19:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_20)?$inch_qty_20_ready.' / '.$inch_qty_20:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_21)?$inch_qty_21_ready.' / '.$inch_qty_21:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_22)?$inch_qty_22_ready.' / '.$inch_qty_22:'-';?></td>
               <td class='text-right'><?php echo !empty($inch_qty_23)?$inch_qty_23_ready.' / '.$inch_qty_23:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_24)?$inch_qty_24_ready.' / '.$inch_qty_24:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_25)?$inch_qty_25_ready.' / '.$inch_qty_25:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_26)?$inch_qty_26_ready.' / '.$inch_qty_26:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_27)?$inch_qty_27_ready.' / '.$inch_qty_27:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_28)?$inch_qty_28_ready.' / '.$inch_qty_28:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_29)?$inch_qty_29_ready.' / '.$inch_qty_29:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_30)?$inch_qty_30_ready.' / '.$inch_qty_30:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_31)?$inch_qty_31_ready.' / '.$inch_qty_31:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_32)?$inch_qty_32_ready.' / '.$inch_qty_32:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_33)?$inch_qty_33_ready.' / '.$inch_qty_33:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_34)?$inch_qty_34_ready.' / '.$inch_qty_34:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_35)?$inch_qty_35_ready.' / '.$inch_qty_35:'-';?></td>
              <td class='text-right'><?php echo !empty($inch_qty_36)?$inch_qty_36_ready.' / '.$inch_qty_36:'-';?></td>
              
              

            </tr>
      <tr><td class="bold" colspan="10">Ready Qty / Order Qty</td>
      </tr>
        <?php }else{ ?>
          <tr>
            <td class="text-center" colspan="10">Not Found Payment History</td>
          </tr>
      <?php }?>
      
      </tbody>
    </table>
</div>
<div align="left"> 
  <a href="<?php echo site_url('Factory_orders'); ?>">BACK</a>
</div>