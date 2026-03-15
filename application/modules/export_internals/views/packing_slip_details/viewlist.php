<?php 
  if(!empty($packing_slip_details)) {
    //foreach ($packet_nos as $packet_index => $packet_no) { 
    ?>
      <!-- <h6>Packet No :<?=$packet_no ?> </h6>     -->
      <div class="" style="font-weight:500">
      <table class="table table-sm table-default">
        <thead>
          <tr>
            <th class="text-right">Tag No</th>
            <th class="text-right">Qauntity</th>
            <th class="text-right">Gross weight</th>
            <th class="text-right">Net weight</th>
            <th class="text-right">Stone</th>
            <th class="text-right">Melting</th>
            <th class="text-right">Pure</th>
            <th class="text-right">Categories</th>
            <th class="text-right">Categories-1</th>
            <th class="text-right">Description</th>
            <th class="text-right">Colour</th>
            <th class="text-right">Making Charge</th>
            <th class="text-right">Code</th>
            <th class="text-right">Total</th>
            <th class="text-right">Site Name</th>
            <th class="text-right no-print">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $sum_weight=$sum_quantity=$sum_balance=$sum_total=$sum_net_weight=$sum_pure=$sum_stone=$sum_making_charge=0;
            $sr_no=0;
            foreach ($packing_slip_details as $index => $process) {
                $sum_quantity += $process['quantity'];
                $sum_weight += $process['gross_weight'];
                $sum_net_weight += $process['net_weight'];
                $sum_pure += $process['pure'];
                $sum_stone += $process['stone'];
                $sum_making_charge += $process['making_charge'];
                $sum_total += $process['total'];
               ?>

                <tr>
                  <td><?= ($process['sr_no'])?></td>
                  <td class="text-right"><?= ($process['quantity']) ?></td>
                  <td class="text-right"><?= four_decimal($process['gross_weight']); ?></td>
                  <td class="text-right"><?= four_decimal($process['net_weight']) ?></td>
                  <td class="text-right"><?= four_decimal($process['stone']) ?></td>
                  <td class="text-right"><?= four_decimal($process['purity']) ?></td>
                  <td class="text-right"><?= four_decimal($process['pure']) ?></td>
                  <td class="text-right"><?= ($process['category_name']) ?></td>
                  <td class="text-right"><?= !empty(($process['category_2']))?($process['category_2']):'' ?></td>
                  <td class="text-right"><?= ($process['description']) ?></td>
                  <td class="text-right"><?= ($process['colour']) ?></td>
                  <td class="text-right"><?= four_decimal($process['making_charge']) ?></td>
                  <td class="text-right"><?= ($process['code']) ?></td>
                  <td class="text-right"><?= four_decimal($process['total']) ?></td>
                  <td class="text-right"><?= ($process['site_name']) ?></td>
                  <td class="text-right no-print">
                  <?php if(empty($issue_department_detail)){ ?>

                    <a class='blue' href="<?=base_url().'export_internals/packing_slip_details/edit/'.$process['id']?>">edit</a>

                    <a class='red' href="<?=base_url().'export_internals/packing_slip_details/delete/'.$process['id'].'?process_id='.$process['process_id'].'&packing_slip_id='.$record['id'].'&date='.date('Y-m-d',strtotime($record['date']))?>">remove</a></td>
		<?php }?>
                  </tr>
                <?php  $sr_no++; 
              //}
            }
          ?>
          <tr class="bg_gray bold">
            <td>Total</td>
            <td class="text-right"><?=$sum_quantity?></td> 
            <td class="text-right"><?=four_decimal($sum_weight);?></td>
            <td class="text-right"><?=four_decimal($sum_net_weight);?></td>
            <td class="text-right"><?=four_decimal($sum_stone);?></td> 
            <td class="text-right"></td> 
            <td class="text-right"><?=four_decimal($sum_pure);?></td> 
            <td class="text-right"></td> 
            <td class="text-right"></td>
            <td class="text-right"></td>
            <td class="text-right"></td>
            <td class="text-right"></td>
            <td class="text-right"></td>
            <td class="text-right"><?=four_decimal($sum_total);?></td>
            <td class="text-right"></td>
            <td class="text-right no-print"></td>
          </tr>
        </tbody>
      </table>
    </div>
  <?php //} 
} ?>
