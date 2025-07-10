<h4 class="heading">Results</h4>
<div class="row">
  <?php if(!empty($results)) { ?>
    <div class="col-md-12">
      <table class="table table-sm">
        <thead class="bg_gray">
          <tr>
            <?php foreach ($results[0] as $column => $field) { 
              ${$column.'_total'}=0;
            ?>
              <th class="text-right"><?= ucfirst(str_replace('_', ' ', $column))?></th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($results as $key => $value) { ?>
            <tr>
              <?php foreach ($results[0] as $column => $field) { 
                ((strpos($column, 'weight') !== false)||(strpos($column, 'balance') !== false)) ? ${$column.'_total'} += $value[$column] : '';
//                (is_numeric($value[$column])) ? ${$column.'_total'} += $value[$column] : '';
              ?>
                <?php if(is_numeric($value[$column]) && $value[$column]==0) { ?>
                  <td>-</td>
                <?php } elseif($column=='url') { ?>
                  <td class="text-right"><a href="<?= ADMIN_PATH.'processes/processes/view/'.$value[$column]?>">VIEW</a></td>
                <?php } elseif ($column=='melting_url') { ?>
                  <td class="text-right"><a href="<?= ADMIN_PATH.'melting_lots/melting_lots/view/'.$value[$column]?>">VIEW</a></td>
                <?php } else { ?>
                  <td class="text-right"><?= $value[$column]?></td>
                <?php } ?>
              <?php } ?>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot class="bg_light_gray bold">
          <tr>
<!--            <th>Total</th>-->
            <?php //array_shift($process_details[0]);
            foreach ($results[0] as $column => $field) {
              if((isset(${$column.'_total'})) && (${$column.'_total'}!=0)){
                echo '<td class="text-right">'.four_decimal(${$column.'_total'}).'</td>';
              } else {
                echo '<td></td>';
              }
            } ?>
          </tr>
        </tfoot>  
      </table>
    </div>
  <?php } else { ?>
    <div class="col-md-12">
      No Records
    </div>
  <?php } ?>
</div>