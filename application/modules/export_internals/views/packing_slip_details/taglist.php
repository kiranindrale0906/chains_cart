<?php 
  if(!empty($packing_slip_details)) {
    //foreach ($packet_nos as $packet_index => $packet_no) { 
    ?>
      <!-- <h6>Packet No :<?=$packet_no ?> </h6>     -->
      <div class="center" style="font-weight:500">
      <table class="center" width="50%"  style="font-size: 11px">
            <?php foreach ($packing_slip_details as $index => $packing_slip_detail) {
              
                   ?>
          <tr class='bold'>
            <td style="padding: 1px" class="text-center">Tag No.</td>
            <td style="padding: 1px" class="text-center">Net Wt</td>
            <td style="padding: 1px" class="text-center">Gross Wt</td>
            <td style="padding: 1px" class="text-center">Karat</td>
            <td style="padding: 1px" class="text-center">Qty</td>
            <td style="padding: 1px">Desc</td>
          </tr>
          <tr>
            <td style="padding: 1px" class="text-center"><?= ($packing_slip_detail['sr_no']); ?></td>
            <td style="padding: 1px" class="text-center"><?= four_decimal($packing_slip_detail['gross_weight']); ?></td>
            <td style="padding: 1px" class="text-center"><?= four_decimal($packing_slip_detail['net_weight']) ?></td>
            <td style="padding: 1px" class="text-center"><?= ($packing_slip_detail['quantity']) ?></td>
            <td style="padding: 1px" class="text-center"><?php
              if($packing_slip_detail['purity']>=91.50 && $packing_slip_detail['purity']<= 92){
                    echo "22 Kt";
              }elseif($packing_slip_detail['purity']>=87.50 && $packing_slip_detail['purity']<= 88){
                    echo "21 Kt";
              }elseif($packing_slip_detail['purity']>=75 && $packing_slip_detail['purity']<= 75.50){
                    echo "18 Kt";
              }elseif($packing_slip_detail['purity']>=58 && $packing_slip_detail['purity']<= 58.50){
                    echo "14 Kt";
              }elseif($packing_slip_detail['purity']>=41 && $packing_slip_detail['purity']<= 42){
                    echo "10 Kt";
              }

            ?></td>
            <td style="padding: 1px" ><?= ($packing_slip_detail['description']) ?></td>
          </tr>
         <?php 
            }
          ?>
      </table>
    </div>
  <?php //} 
} ?>
<style>
table, th, td {
  border: 1px solid #b0b0b0;
  border-collapse: collapse;

}
table {page-break-before: always;}
</style>