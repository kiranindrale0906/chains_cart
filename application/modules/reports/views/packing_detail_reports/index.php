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
                                  'id' => 'arc_stock_reports_from_date', 'class' => 'arc_stock_reports_filter datepicker_js'));?>
      <?php load_field('date',array('field' => 'to_date', 'col'=>'col-sm-3', 
                                  'id' => 'arc_stock_reports_to_date', 'class' => 'arc_stock_reports_filter datepicker_js'));?>

    </div>
      <?php load_buttons('button', array('name' =>'Search','class'=>'btn-xs btn_blue gpc_out_city_report_date mr-2')) ?>
  </form>
<?php //} ?>
<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th class="">Process</th>      
      <th class="text-right">Production</th>
      <th class="text-right">WIP</th>
      <th class="text-right">Casting</th>
      <th class="text-right">Daily Drawer</th>
      <th class="text-right">Total WIP</th>
      <th class="text-right">Rolling</th>
    </tr>
  </thead>
  <tbody>
    <tr >
      <td>LOCK</td>
      <td class="text-right"><?=$lock_production = (!empty($lock_productions['weight'])?four_decimal($lock_productions['weight']):0); ?></td>
      <td class="text-right"><?=$lock_wip=(!empty($lock_wips['weight'])?four_decimal($lock_wips['weight']):0); ?></td>
      <td class="text-right"><?=$lock_casting=(!empty($lock_castings['weight'])?four_decimal($lock_castings['weight']):0); ?></td>
      <td class="text-right"><?=$lock_daily_drawer=(!empty($lock_daily_drawers['weight'])?four_decimal($lock_daily_drawers['weight']):0); ?></td>
      <td class="text-right"><?=$total_lock_wip=four_decimal($lock_wip+$lock_casting+$lock_daily_drawer)?></td>
      <td class="text-right"><?=$lock_rolling=(!empty($lock_production)?four_decimal($total_lock_wip/$lock_production):0);?></td>
    </tr>
    <tr>
      <td>CHAIN ARG</td>
      <td class="text-right"><?=$chain_arg_production=(!empty($chain_arg_productions['weight'])?four_decimal($chain_arg_productions['weight']):0) ?></td>
      <td class="text-right"><?=$chain_arg_wip=(!empty($chain_arg_wips['weight'])?four_decimal($chain_arg_wips['weight']):0) ?></td>
      <td class="text-right"><?=$chain_arg_casting=(!empty($chain_arg_castings['weight'])?four_decimal($chain_arg_castings['weight']):0) ?></td>
      <td class="text-right"><?=$chain_daily_drawer=(!empty($chain_daily_drawers['weight'])?four_decimal($chain_daily_drawers['weight']):0) ?></td>
      <td class="text-right"><?=$total_chain_arg_wip=four_decimal($chain_arg_wip+$chain_arg_casting+$chain_daily_drawer)?></td>
      <td class="text-right"><?=$chain_arg_rolling=(!empty($chain_arg_production)?four_decimal($total_chain_arg_wip/$chain_arg_production):0)?></td>
    </tr>
    <tr>
      <td>CHAIN A/M</td>
      <td class="text-right"><?=$chain_am_production=!empty($chain_am_productions['weight'])?four_decimal($chain_am_productions['weight']):0 ?></td>
      <td class="text-right"><?=$chain_am_wip=!empty($chain_am_wips['weight'])?four_decimal($chain_am_wips['weight']):0 ?></td>
      <td class="text-right"><?=$chain_am_casting=!empty($chain_am_castings['weight'])?four_decimal($chain_am_castings['weight']):0 ?></td>
      <td class="text-right"><?=$chain_am_daily_drawer=(!empty($chain_daily_drawers['weight'])?four_decimal($chain_daily_drawers['weight']):0) ?></td>
      
      <td class="text-right"><?=$total_chain_am_wip=four_decimal($chain_am_wip+$chain_arg_casting+$chain_am_daily_drawer)?></td>
      <td class="text-right"><?=$chain_am_rolling=(!empty($total_chain_am_wip)?four_decimal($total_chain_am_wip/$chain_am_production):0)?></td>
    </tr>
    <tr>
      <td>ORNAMENTS 75P</td>
      <td class="text-right"><?=$ornament_75_pink_production=!empty($ornament_75_pink_productions['weight'])?four_decimal($ornament_75_pink_productions['weight']):0 ?></td>
      <td class="text-right"><?=$ornament_75_pink_wip=!empty($ornament_75_pink_wips['weight'])?four_decimal($ornament_75_pink_wips['weight']):0 ?></td>
      <td class="text-right"><?=$ornament_75_pink_casting=!empty($ornament_75_pink_castings['weight'])?four_decimal($ornament_75_pink_castings['weight']):0 ?></td>
      <td class="text-right"><?=$chain_ornament_daily_drawer=(!empty($chain_ornament_daily_drawers['weight'])?four_decimal($chain_ornament_daily_drawers['weight']):0) ?></td>
      
      <td class="text-right"><?=$total_ornament_75_pink_wip=four_decimal($ornament_75_pink_wip+$ornament_75_pink_casting+$chain_ornament_daily_drawer)?></td>
      <td class="text-right"><?=$ornament_75_pink_rolling=(!empty($ornament_75_pink_production)?four_decimal($total_ornament_75_pink_wip/$ornament_75_pink_production):0)?></td>
    </tr>
    <tr>
      <td>ORNAMENTS 92/75Y</td>
      <td class="text-right"><?=$ornament_yellow_production=!empty($ornament_yellow_productions['weight'])?four_decimal($ornament_yellow_productions['weight']):0 ?></td>
      <td class="text-right"><?=$ornament_yellow_wip=!empty($ornament_yellow_wips['weight'])?four_decimal($ornament_yellow_wips['weight']):0 ?></td>
      <td class="text-right"><?=$ornament_yellow_casting=!empty($ornament_yellow_castings['weight'])?four_decimal($ornament_yellow_castings['weight']):0 ?></td>
      <td class="text-right"><?=$chain_ornament_92_daily_drawer=(!empty($chain_ornament_92_daily_drawers['weight'])?four_decimal($chain_ornament_92_daily_drawers['weight']):0) ?></td>
      
      <td class="text-right"><?=$total_ornament_yellow_wip=four_decimal($ornament_yellow_wip+$ornament_yellow_casting+$chain_ornament_92_daily_drawer)?></td>
      <td class="text-right"><?=$ornament_yellow_rolling=(!empty($ornament_yellow_production)?four_decimal($total_ornament_yellow_wip/$ornament_yellow_production):0)?></td>
    </tr>
    <tr>
      <td>KUWAITI 75/92</td>
      <td class="text-right"><?=$kuwaiti_production=!empty($kuwaiti_productions['weight'])?four_decimal($kuwaiti_productions['weight']):0 ?></td>
      <td class="text-right"><?=$kuwaiti_wip=!empty($kuwaiti_wips['weight'])?four_decimal($kuwaiti_wips['weight']):0 ?></td>
      <td class="text-right"><?=$kuwaiti_casting=!empty($kuwaiti_castings['weight'])?four_decimal($kuwaiti_castings['weight']):0 ?></td>
      <td class="text-right"></td>
      <td class="text-right"><?=$total_kuwaiti_wip=four_decimal($kuwaiti_wip+$kuwaiti_casting)?></td>
      <td class="text-right"><?=$kuwaiti_roling=(!empty($kuwaiti_production)?four_decimal($total_kuwaiti_wip/$kuwaiti_production):0)?></td>
    </tr>
    <tr>
      <td>PARA</td>
      <td class="text-right"><?=$para_production=!empty($para_productions['weight'])?four_decimal($para_productions['weight']):0 ?></td>
      <td class="text-right"><?=$para_wip=!empty($para_wips['weight'])?four_decimal($para_wips['weight']):0 ?></td>
      <td class="text-right"><?=$para_casting=!empty($para_castings['weight'])?four_decimal($para_castings['weight']):0 ?></td>
      <td class="text-right"></td>
      <td class="text-right"><?=$total_para_wip=four_decimal($para_wip+$para_casting)?></td>
      <td class="text-right"><?=$para_rolling=(!empty($para_production)?four_decimal($total_para_wip/$para_production):0)?></td>
    </tr>
    <tr class="bold">
      <td>Total</td>
      <td class="text-right"><?=$total_of_production=($lock_production+$chain_arg_production+$ornament_yellow_production+$chain_am_production+$kuwaiti_production+$ornament_75_pink_production+$para_production)?></td>
      <td class="text-right"><?=($lock_wip+$chain_arg_wip+$ornament_yellow_wip+$chain_am_wip+$kuwaiti_wip+$ornament_75_pink_wip+$para_wip)?></td>
      <td class="text-right"><?=($lock_casting+$chain_arg_casting+$ornament_yellow_casting+$chain_am_casting+$kuwaiti_casting+$ornament_75_pink_casting+$para_casting)?></td>

      <td class="text-right"><?=($lock_daily_drawer+$chain_daily_drawer+$chain_ornament_daily_drawer+$chain_am_daily_drawer+$chain_ornament_92_daily_drawer+$chain_ornament_daily_drawer)?></td>
      <td class="text-right"><?=$total_of_wip=($total_lock_wip+$total_chain_arg_wip+$total_chain_am_wip+$total_kuwaiti_wip+$total_ornament_yellow_wip+$total_ornament_75_pink_wip+$total_para_wip)?></td>
      <td class="text-right"><?=($lock_rolling+$chain_arg_rolling+$chain_am_rolling+$ornament_75_pink_rolling+$ornament_yellow_rolling+$kuwaiti_roling+$para_rolling)?></td>
    </tr>
  </tbody>
</table>

<table class="table table-sm table-default table-hover">
  <tbody class="bold">
    <tr >
      <td>Net Rolling</td>
      <td class="text-right"><?=(!empty($total_of_production)?four_decimal($total_of_wip/$total_of_production):0); ?></td>
      </tr>
    <tr class="">
      <td>Finish Goods</td>
      <td class="text-right"><?=!empty($finish_goods['weight'])?four_decimal($finish_goods['weight']):0 ?></td>
    </tr>
  </tbody>
</table>