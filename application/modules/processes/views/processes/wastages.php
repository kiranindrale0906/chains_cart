<h5 class="heading"><?php echo 'WASTAGES'; ?></h5>
<div class="row">
  <div class="col-md-12">
    <table class="table table-sm">
      <thead class="bg_gray">
        <tr>
          <th>NAME</th>
          <th>IN</th>
          <th>OUT</th>
          <th>BALANCE</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($wastages as $name => $value) { 
          $out_wastage_weight = 0;
          $in_wastage = current($value);
          $balance_wastage = end($value);
          $new_wastage_array = array_slice($value,1,-1);
          foreach ($new_wastage_array as $out_value) {
            if ($out_value=='in_melting_wastage') continue;
            $out_wastage_weight += @$record[$out_value];
          }
        ?>
        <?php if(($record[$in_wastage]!=0)||($out_wastage_weight!=0)||($record[$balance_wastage]!=0)) { ?>
          <tr>
            <td><strong><?= $name?></strong></td>
            <td><?= ($record[$in_wastage]!=0) ? four_decimal($record[$in_wastage]) : '-'?></td>
            <td><?= ($out_wastage_weight!=0) ? four_decimal($out_wastage_weight) : '-'?></td>
            <td><?= ($record[$balance_wastage]!=0) ? four_decimal($record[$balance_wastage]) : '-'?>
              <?php if($record['issue_tounch_loss_fine']>0 && $name=="Tounch Loss Fine"){
                echo  load_buttons('anchor', array('name'=>'Update tounch loss fine',
                                               'class'=>'btn-xs blue process_tounch_loss_fine ',
                                               'data-title'=>"View",
                                               'data-id'=>$record['id'],
                                               'layout' => 'application',
                                               'href'=>'javascript:void(0)'));
              }?>
            </td>
          </tr>
        <?php } } ?>
      </tbody>
    </table>
  </div>
</div>
<hr class="mt0">
