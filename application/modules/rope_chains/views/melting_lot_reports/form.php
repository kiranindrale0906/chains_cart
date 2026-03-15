<?php $this->load->view('search') ?>

<?php $total = array(); ?>
<table class="table table-sm table_blue table-striped table-bordered" id="tblAddRow">
  <?php $this->load->view('top_header'); ?>
  <?php $this->load->view('department_header'); ?>

  <?php 
    foreach ($process_departments as $process => $departments) {
      foreach ($departments as $department) {
        foreach ($fields[$department] as $field) {
          $total[$process][$department][$field] = 0;
        }
      }
    } 
  ?>

  <tbody>
    <?php foreach ($processes as $parent_lot_id => $process_parent_lot_ids) { ?>
      <?php foreach ($process_parent_lot_ids as $melting_lot_id => $process_melting_lot_ids) { ?>
        <?php foreach ($process_melting_lot_ids as $melting_lot_category_one => $process_melting_lot_category_ones) { ?>
          <?php foreach ($process_melting_lot_category_ones as $category_two => $process_category_twos) { ?>
            <?php foreach ($process_category_twos as $machine_size => $process_machine_sizes) { ?>
              <?php foreach ($process_machine_sizes as $design_code => $process_design_codes) { ?>
                <tr>
                  <td><?= (isset($parent_lots[$parent_lot_id])) ? $parent_lots[$parent_lot_id]['name'] : ''; ?></td>
                  <td><?= (isset($melting_lots[$melting_lot_id])) ? $melting_lots[$melting_lot_id]['lot_no'] : ''; ?></td>
                  <td><?= (isset($melting_lots[$melting_lot_id])) ? four_decimal($melting_lots[$melting_lot_id]['lot_purity']) : 0; ?></td>
                  <td><?= $melting_lot_category_one; ?></td>
                  <!-- <td><?= $category_two; ?></td> -->
                  <td><?= $machine_size; ?></td>
                  <td><?= $design_code; ?></td>

                  <?php foreach ($process_departments as $process => $departments) { ?>
                    <?php foreach ($departments as $department) { ?>
                      <?php foreach ($fields[$department] as $field) { ?>
                        <td class="text-right">
                          <?php 
                            $total[$process][$department][$field] += @$process_design_codes[$process][$department][$field];
                            echo four_decimal(@$process_design_codes[$process][$department][$field], '-'); 
                            if ($field != 'in_weight' && @$process_design_codes[$process][$department]['in_weight'] > 0 
                                && @$process_design_codes[$process][$department][$field] > 0) 
                              echo ' ('.four_decimal(@$process_design_codes[$process][$department][$field] / @$process_design_codes[$process][$department]['in_weight'] * 100, '-').'%)';
                          ?>
                        </td>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                </tr>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        <?php } ?>
      <?php } ?>
    <?php } ?>
  </tbody>
  
  <thead class="thead-light" id="myHeader">
    <tr>
      <th>Total</th>
      <th></th>
      <th></th> 
      <th></th>
      <th></th>
      <th></th>
      <?php foreach ($process_departments as $process => $departments) { ?>
        <?php foreach ($departments as $department) { ?>
          <?php foreach ($fields[$department] as $field) { ?>
            <th class="text-right">
              <?php 
                echo four_decimal($total[$process][$department][$field], '-'); 
                if (   $field != 'in_weight' 
                    && @$total[$process][$department]['in_weight'] > 0 
                    && @$total[$process][$department][$field] > 0) 
                  echo ' ('.four_decimal(@$total[$process][$department][$field] / @$total[$process][$department]['in_weight'] * 100, '-').'%)';          
              ?>
            </th>
          <?php } ?>
        <?php } ?>
      <?php } ?>
    </tr>
  </thead>

  <?php $this->load->view('department_header'); ?>
  <?php $this->load->view('top_header'); ?>

</table>
<hr class="mt0">
<?php $this->load->view('parent_lot_loss_view');?>