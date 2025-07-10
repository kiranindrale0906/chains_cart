<h5 class="heading"><?php echo 'PROCESS DETAILS'; ?></h5>
<?php if(!empty($out_process_details)) { ?>
<div class="row">
  <div class="col-md-6">
    <label class="medium mr-4">Out Process Details : </label>
  </div>
    <div class="col-md-12">
      <table class="table table-sm">
        <thead class="bg_gray">
          <tr>
            <?php foreach($out_process_details[0] as $column => $field) { 
              ${$column.'_total'}=0;
            ?>
              <th class="text-right"><?= ucfirst(str_replace('_', ' ', $column))?></th>
            <?php } ?>
              <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($out_process_details as $key => $value) { ?>
            <tr>
              <?php foreach ($out_process_details[0] as $column => $field) { 
                (is_numeric($value[$column])) ? ${$column.'_total'} += $value[$column] : '';
                if(is_numeric($value[$column]) && $value[$column]==0) { 
              ?>
                <td class="text-right">-</td>
              <?php } else { ?>
                <td class="text-right">
                  <?= ($column=='created_at') ? date("d-m-Y H:i:s",strtotime($value[$column])) : $value[$column] ?>
                </td>
              <?php } } ?>
                <td>
                  <?= (!empty($value['process_id'])) ? getHttpButton('next lot', base_url().'processes/processes/view/'.$value['process_id'], 'float-right btn-info ml-5') : ''; ?>
                  <?= getHttpButton('delete', base_url().'processes/process_details/delete/'.$value['id'], 'float-right btn-danger ml-5'); ?>
                </td>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot class="bg_light_gray bold">
          <tr>
            <th>Total</th>
            <?php array_shift($out_process_details[0]);
            foreach ($out_process_details[0] as $column => $field) { 
              if((isset(${$column.'_total'}) && (${$column.'_total'}!=0) && (fmod(${$column.'_total'}, 1) !== 0.00))){
                echo '<td class="text-right">'.four_decimal(${$column.'_total'}).'</td>';
              } else {
                echo '<td></td>';
              }
            } ?>
          </tr>
        </tfoot>
      </table>
    </div>
</div>
<hr class="mt0">
<?php } ?>
<?php /* ------------------------------------------ */ ?>
<?php if(!empty($hook_process_details)) { ?>
  <div class="row">
    <div class="col-md-6">
      <label class="medium mr-4">Hook Process Details : </label>
    </div>
    <div class="col-md-12">
      <table class="table table-sm">
        <thead class="bg_gray">
          <tr>
            <?php foreach($hook_process_details[0] as $column => $field) { 
              ${$column.'_total'}=0;
            ?>
              <th class="text-right"><?= ucfirst(str_replace('_', ' ', $column))?></th>
            <?php } ?>
              <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($hook_process_details as $key => $value) { ?>
            <tr>
              <?php foreach ($hook_process_details[0] as $column => $field) { 
                (is_numeric($value[$column])) ? ${$column.'_total'} += $value[$column] : '';
                if(is_numeric($value[$column]) && $value[$column]==0) { 
              ?>
                <td class="text-right">-</td>
              <?php } else { ?>
                <td class="text-right"><?= ($column=='created_at') ? date("d-m-Y H:i:s",strtotime($value[$column])) : $value[$column]?></td>
              <?php } } ?>
                <td><?= getHttpButton('DELETE', base_url().'processes/process_details/delete/'.$value['id'], 'float-right btn-danger ml-5'); ?></td>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot class="bg_light_gray bold">
          <tr>
            <th>Total</th>
            <?php array_shift($hook_process_details[0]);
            foreach ($hook_process_details[0] as $column => $field) { 
              if((isset(${$column.'_total'}) && (${$column.'_total'}!=0) && (fmod(${$column.'_total'}, 1) !== 0.00))){
                echo '<td class="text-right">'.four_decimal(${$column.'_total'}).'</td>';
              } else {
                echo '<td></td>';
              }
            } ?>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
<hr class="mt0">
<?php } ?>
<?php /* --------------------------------------------------------- */?>
<?php if(!empty($wastage_process_details)) { ?>
  <div class="row">
    <div class="col-md-6">
      <label class="medium mr-4">Wastage Process Details : </label>
    </div>
    <div class="col-md-12">
      <table class="table table-sm">
        <thead class="bg_gray">
          <tr>
            <?php foreach($wastage_process_details[0] as $column => $field) { 
              ${$column.'_total'}=0;
            ?>
              <th class="text-right"><?= ucfirst(str_replace('_', ' ', $column))?></th>
            <?php } ?>
              <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($wastage_process_details as $key => $value) { ?>
            <tr>
              <?php foreach ($wastage_process_details[0] as $column => $field) { 
                (is_numeric($value[$column])) ? ${$column.'_total'} += $value[$column] : '';
                if(is_numeric($value[$column]) && $value[$column]==0) { 
              ?>
                <td class="text-right">-</td>
              <?php } else { ?>
                <td class="text-right"><?= ($column=='created_at') ? date("d-m-Y H:i:s",strtotime($value[$column])) : $value[$column]?></td>
              <?php } } ?>
                <td><?= getHttpButton('DELETE', base_url().'processes/process_details/delete/'.$value['id'], 'float-right btn-danger ml-5'); ?></td>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot class="bg_light_gray bold">
          <tr>
            <th>Total</th>
            <?php array_shift($wastage_process_details[0]);
            foreach ($wastage_process_details[0] as $column => $field) { 
              if((isset(${$column.'_total'}) && (${$column.'_total'}!=0) && (fmod(${$column.'_total'}, 1) !== 0.00))){
                echo '<td class="text-right">'.four_decimal(${$column.'_total'}).'</td>';
              } else {
                echo '<td></td>';
              }
            } ?>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
<hr class="mt0">
<?php } ?>