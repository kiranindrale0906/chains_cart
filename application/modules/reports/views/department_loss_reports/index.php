  <h6 class='blue text-uppercase bold mb-3'><?php echo @getTableSettings()['page_title']; ?></h6>

  <form class="fields-group-sm">
    <div class="row">
      <?php load_field('date',array('field' => 'date', 'class' => 'datepicker_js', 'col'=>'col-sm-4','value'=>$date))?> 
      <div class="col-sm-4 align-self-center">
        <?php load_buttons('button', array('name' =>'Search','class'=>'btn-xs btn_blue loss_search_date mr-2')) ?> 
        <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs btn_blue clear_btn')) ?>      
      </div>
    </div>
  </form>
   <table class="table table-sm fixedthead table-default">
    <thead>
      <tr>
        <th>Department Name</th>
        <th class="text-right">Loss</th>
       
      </tr>
    </thead>
    <tbody>
      <?php
        $sum_balance=$sum_balance_gross=$sum_balance_fine=0;
      if(!empty($loss_details)){
        foreach ($loss_details as $department => $balance) {
          if($balance['loss']!=0) {
         $sum_balance+=$balance['loss'];?>
        <tr>
          <td><?php echo $department ?></td>
          <td class="text-right"><?php echo four_decimal($balance['loss']); ?></td>
        </tr>
       
        <?php } } ?>
       <tr class="bg_gray bold">
          <td></td>
          <td class="text-right"><?=four_decimal($sum_balance);?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
