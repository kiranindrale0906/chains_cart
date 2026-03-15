  <div class="boxrow mb-2">
    <div class="float-left">
      <h6 class="heading blue bold text-uppercase mb-0">
        <?= @getTableSettings()['page_title']; ?>
      </h6>
    </div>
  </div>
  <form class="fields-group-sm">
  <div class="row">
    <?php load_field('date', array('field' => 'from_date', 'name' => 'from_date', 'class' => 'monthpicker_js', 'col'=>'col-sm-3', 'value'=>!empty($from_date)?date('d M Y',strtotime($from_date)):''));?>
    <?php load_field('dropdown', array('field' => 'product_name','option'=>$product_names));?>
    <div class="col-sm-3 align-self-center">
      <?php load_buttons('submit', array('name' =>'Search','class'=>'btn-xs btn_blue mr-2')) ?>
      <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs clear_btn btn_blue')) ?>
    </div>
  </div>
  </form>
 <?php  if(!empty($records)){
  foreach ($records['productions'] as $index => $account_names) {
     ?>
  <table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th><?=$index?></th>
      <th>Type</th>
      <th class='text-right'>Weight</th>
      <th class='text-right'>Vadotar</th>
      <th class='text-right'>Wastage %</th>

    </tr>
  </thead>
  <tbody >
    <?php 
      $total_weight=$total_vadotar=$total_wastage=$total_refresh_weight=$total_refresh_vadotar=$total_refresh_wastage=$total_internal_weight=$total_internal_vadotar=$total_ka_ball_chain_fancy_92_chain_weight=$total_ka_ball_chain_fancy_92_chain_vodator=$total_ka_ball_chain_fancy_75_chain_weight=$total_ka_ball_chain_fancy_75_chain_vodator=$total_ka_chain_fancy_92_chain_weight=$total_ka_chain_fancy_92_chain_vodator=$total_ka_chain_fancy_75_chain_weight=$total_ka_chain_fancy_75_chain_vodator=
        $total_ball_chain_fancy_92_chain_weight=$total_ball_chain_fancy_92_chain_vodator=$total_ball_chain_fancy_75_chain_weight=$total_ball_chain_fancy_75_chain_vodator=$total_fancy_pipe_and_para_chain_weight=$$total_fancy_pipe_and_para_chain_vodator=0;
      $i=$vodator=0;
      foreach ($account_names as $account_name_index => $acount_name_value) {
        if(four_decimal($acount_name_value['vadotar'])==0 && $acount_name_value['type']=="Export"){
          if($index=="Indo tally Chain"||
             $index=="Hollow Choco Chain"||
             $index=="Choco Chain"){
            $vodator=($acount_name_value['weight']*1.4*75)/5000;
          }
          if($index=="Imp Italy Chain"){
            $vodator=($account_name_value['weight']*1.6*75)/5000;
          }
          if($index=="Machine Chain"){
            $vodator=($acount_name_value['weight']*1.1*75)/5000;
          }
          if($index=="Round Box Chain"){
            $vodator=($acount_name_value['weight']*0.8*75)/5000;
          }if($index=="Sisma Chain"){
            $vodator=($acount_name_value['weight']*2.1*75)/5000;
          }
        }else{
          $vodator=$acount_name_value['vadotar'];
        }

        if(in_array($account_name_index,array("Tanishq","TANISHQ"))){
          $vodator=($acount_name_value['weight']*4.5)/100;
        }
        $total_weight+=$acount_name_value['weight'];
        $total_vadotar+=$vodator;
        $total_wastage+=((!empty($acount_name_value['weight'])&&!empty($vodator))?(($vodator/$acount_name_value['weight'])*100):0);
        
        ?>
    <tr>
      <td class=''><?=$account_name_index;?></td>
      <td class=''><?=$acount_name_value['type'];?></td>
      <td class='text-right'><?=four_decimal($acount_name_value['weight'])?></td>
      <td class='text-right'><?=four_decimal($vodator)?></td>
      <td class='text-right'><?=((!empty($acount_name_value['weight'])&&!empty($vodator))?four_decimal(($vodator/$acount_name_value['weight'])*100):0)?></td>
    </tr>
  <?php $i++;}
  if($records['refreshs'][$index]['weight']!=0){
  ?>
    <tr>
      <td class=''>Refresh</td>
      <td class=''></td>
      <td class='text-right'><?=$total_refresh_weight=four_decimal(-1*$records['refreshs'][$index]['weight'])?></td>
      <td class='text-right'><?=$total_refresh_vadotar=four_decimal(-1*$records['refreshs'][$index]['vadotar'])?></td>
      <td class='text-right'><?=$total_refresh_wastage=((!empty($records['refreshs'][$index]['weight'])&&!empty($records['refreshs'][$index]['vadotar']))?four_decimal(-1*(($records['refreshs'][$index]['vadotar']/$records['refreshs'][$index]['weight'])*100)):0)?></td>
    </tr>
    <?php }if($index=="KA Chain" || $index=="Ball Chain"){?>
      <tr>
      <td class=''>Fancy - 92</td>
      <td class=''></td>
      <td class='text-right'><?=$total_ka_ball_chain_fancy_92_chain_weight=four_decimal(abs($records['ka_ball_chain_fancy_92_chain'][$index]['weight']))?></td>
      <td class='text-right'><?=$total_ka_ball_chain_fancy_92_chain_vodator=four_decimal(abs($records['ka_ball_chain_fancy_92_chain'][$index]['vodator']))?></td>
      <td class='text-right'><?=((!empty($total_ka_ball_chain_fancy_92_chain_weight)&&!empty($total_ka_ball_chain_fancy_92_chain_vodator))?four_decimal(($total_ka_ball_chain_fancy_92_chain_vodator/$total_ka_ball_chain_fancy_92_chain_weight)*100):0)?></td>
    </tr>
    <tr>
      <td class=''>Fancy - 75</td>
      <td class=''></td>
      <td class='text-right'><?=$total_ka_ball_chain_fancy_75_chain_weight=four_decimal(abs($records['ka_ball_chain_fancy_75_chain'][$index]['weight']))?></td>
      <td class='text-right'><?=$total_ka_ball_chain_fancy_75_chain_vodator=four_decimal(abs($records['ka_ball_chain_fancy_75_chain'][$index]['vodator']))?></td>
      <td class='text-right'><?=((!empty($total_ka_ball_chain_fancy_75_chain_weight)&&!empty($total_ka_ball_chain_fancy_75_chain_vodator))?four_decimal(($total_ka_ball_chain_fancy_75_chain_vodator/$total_ka_ball_chain_fancy_75_chain_weight)*100):0)?></td>
    </tr>
    <?php }?>
    <tr>
      <td class=''>Internal</td>
      <td class=''></td>
      <td class='text-right'><?=$total_internal_weight=four_decimal(-1*$records['internals'][$index]['weight'])?></td>
      <td class='text-right'><?=$total_internal_vadotar=four_decimal($records['internals'][$index]['vodator'])?></td>
      <td class='text-right'><?=((!empty($total_internal_weight)&&!empty($total_internal_vadotar))?four_decimal(($total_internal_vadotar/$total_internal_weight)*100):0)?></td>
    </tr>
    <tr class="bg_gray">
      <td class=" bold">Total</td>
      <td class=" bold"></td>
      <td class=" bold text-right"><?=$sub_total_weight=four_decimal($total_weight+$total_refresh_weight+$total_internal_weight+$total_ka_ball_chain_fancy_92_chain_weight+$total_ka_ball_chain_fancy_75_chain_weight)?></td>
      <td class=" bold text-right"><?=$sub_total_vodator=four_decimal($total_vadotar+$total_refresh_vadotar+$total_internal_vadotar+$total_ka_ball_chain_fancy_92_chain_vodator+$total_ka_ball_chain_fancy_75_chain_vodator)?></td>
      <td class=" bold text-right"><?=((!empty($sub_total_weight)&&!empty($sub_total_vodator))?four_decimal(($sub_total_vodator/$sub_total_weight)*100):0)?></td>
    </tr>
    <tr>
      <td class=''>Lobster</td>
      <td class=''></td>
      <td class='text-right'><?=four_decimal($records['hook_kdms'][$index]['weight'])?></td>
      <td class='text-right'><?=four_decimal(($records['hook_kdms'][$index]['weight']*1.50)/100)?></td>
      <td class=" bold text-right"><?=((!empty($records['hook_kdms'][$index]['weight'])&&!empty((($records['hook_kdms'][$index]['weight']*1.50)/100)))?four_decimal(((($records['hook_kdms'][$index]['weight']*1.50)/100)/$records['hook_kdms'][$index]['weight'])*100):0)?></td>
    </tr>
    <tr>
      <td class=''>Interest</td>
      <td class=''></td>
      <td class='text-right'></td>
      <td class='text-right'><?=$interest_data=four_decimal(((abs($records['rolling_data'][$index]['weight']))*8/100)/12)?></td>
      <td class=" bold text-right"></td>
    </tr>
    <?php 
    $total_sisma_3_mm_para_weight=$total_sisma_3_mm_para_vodator=$total_sisma_3_mm_anc_clipping_weight=$total_sisma_3_mm_anc_clipping_vodator=$total_sisma_2_mm_vodator=$total_sisma_2_mm_weight=0;
    if($index=="Sisma Chain"){?>
      <tr>
      <td class=''>3 MM Para</td>
      <td class=''></td>
      <td class='text-right'><?=$total_sisma_3_mm_para_weight=four_decimal(abs($records['sisma_3_mm_para'][$index]['weight']))?></td>
      <td class='text-right'><?=$total_sisma_3_mm_para_vodator=four_decimal(abs($records['sisma_3_mm_para'][$index]['vodator']))?></td>
      <td class=" bold text-right"><?=((!empty($total_sisma_3_mm_para_weight)&&!empty($total_sisma_3_mm_para_vodator))?four_decimal(($total_sisma_3_mm_para_vodator/$total_sisma_3_mm_para_weight)*100):0)?></td>
    </tr>
    <tr>
      <td class=''>3 MM Anchor Clipping</td>
      <td class=''></td>
      <td class='text-right'><?=$total_sisma_3_mm_anc_clipping_weight=four_decimal(abs($records['sisma_3_mm_anc_clipping'][$index]['weight']))?></td>
      <td class='text-right'><?=$total_sisma_3_mm_anc_clipping_vodator=four_decimal(abs($records['sisma_3_mm_anc_clipping'][$index]['vodator']))?></td>
      <td class=" bold text-right"><?=((!empty($total_sisma_3_mm_anc_clipping_weight)&&!empty($total_sisma_3_mm_anc_clipping_vodator))?four_decimal(($total_sisma_3_mm_anc_clipping_vodator/$total_sisma_3_mm_anc_clipping_weight)*100):0)?></td>
    
    </tr>
    <tr>
      <td class=''>2 MM Para</td>
      <td class=''></td>
      <td class='text-right'><?=$total_sisma_2_mm_weight=four_decimal(abs($records['sisma_2_mm_para'][$index]['weight']))?></td>
      <td class='text-right'><?=$total_sisma_2_mm_vodator=four_decimal(abs($records['sisma_2_mm_para'][$index]['vodator']))?></td>
      <td class=" bold text-right"><?=((!empty($total_sisma_2_mm_weight)&&!empty($total_sisma_2_mm_vodator))?four_decimal(($total_sisma_2_mm_vodator/$total_sisma_2_mm_weight)*100):0)?></td>
    </tr>
    <tr>
      <td class=''>Omega</td>
      <td class=''></td>
      <td class='text-right'><?=$total_omega_weight=four_decimal(abs($records['sisma_omega'][$index]['weight']))?></td>
      <td class='text-right'><?=$total_omega_vodator=four_decimal(abs($records['sisma_omega'][$index]['vodator']))?></td>
      <td class=" bold text-right"><?=((!empty($total_omega_weight)&&!empty($total_omega_vodator))?four_decimal(($total_omega_vodator/$total_omega_weight)*100):0)?></td>
    
    </tr>
    <?php }?>
    <?php if($index=="Fancy Chain" || $index=="Fancy 75 Chain"){?>
      <tr>
      <td class=''>Pipe and Para</td>
      <td class=''></td>
      <td class='text-right'><?=$total_fancy_pipe_and_para_chain_weight=four_decimal(abs($records['fancy_pipe_and_para'][$index]['weight']))?></td>
      <td class='text-right'><?=$total_fancy_pipe_and_para_chain_vodator=four_decimal(($total_fancy_pipe_and_para_chain_weight*1.5)/100) ?></td>
      <td class=" bold text-right"><?=((!empty($total_fancy_pipe_and_para_chain_weight)&&!empty($total_fancy_pipe_and_para_chain_vodator))?four_decimal(($total_fancy_pipe_and_para_chain_vodator/$total_fancy_pipe_and_para_chain_weight)*100):0)?></td>
    </tr>
    <?php if($index=="Fancy Chain"){?>
    <tr>
      <td class=''>KA Chain Fancy -92</td>
      <td class=''></td>
      <td class='text-right'><?=$total_ka_chain_fancy_92_weight=four_decimal(abs($records['ka_chain_fancy_92_chain'][$index]['weight']))?></td>
      <td class='text-right'><?=$total_ka_chain_fancy_92_chain_vodator=four_decimal(abs($records['ka_chain_fancy_92_chain'][$index]['vodator']))?></td>
      <td class=" bold text-right"><?=((!empty($total_ka_chain_fancy_92_weight)&&!empty($total_ka_chain_fancy_92_chain_vodator))?four_decimal(($total_ka_chain_fancy_92_chain_vodator/$total_ka_chain_fancy_92_weight)*100):0)?></td>
    </tr>
    <tr>
      <td class=''>Ball Chain Fancy -92</td>
      <td class=''></td>
      <td class='text-right'><?=$total_ball_chain_fancy_92_weight=four_decimal(abs($records['ball_chain_fancy_92_chain'][$index]['weight']))?></td>
      <td class='text-right'><?=$total_ball_chain_fancy_92_chain_vodator=four_decimal(abs($records['ball_chain_fancy_92_chain'][$index]['vodator']))?></td>
      <td class=" bold text-right"><?=((!empty($total_ball_chain_fancy_92_weight)&&!empty($total_ball_chain_fancy_92_chain_vodator))?four_decimal(($total_ball_chain_fancy_92_chain_vodator/$total_ball_chain_fancy_92_weight)*100):0)?></td>
    </tr>
    <?php }else{?>
    <tr>
      <td class=''>KA Chain Fancy -75</td>
      <td class=''></td>
      <td class='text-right'><?=$total_ka_chain_fancy_75_weight=four_decimal(abs($records['ka_chain_fancy_75_chain'][$index]['weight']))?></td>
      <td class='text-right'><?=$total_ka_chain_fancy_75_chain_vodator=four_decimal(abs($records['ka_chain_fancy_75_chain'][$index]['vodator']))?></td>
      <td class=" bold text-right"><?=((!empty($total_ka_chain_fancy_75_weight)&&!empty($total_ka_chain_fancy_75_chain_vodator))?four_decimal(($total_ka_chain_fancy_75_chain_vodator/$total_ka_chain_fancy_75_weight)*100):0)?></td>
    </tr>
    <tr>
      <td class=''>Ball Chain Fancy -75</td>
      <td class=''></td>
      <td class='text-right'><?=$total_ball_chain_fancy_75_weight=four_decimal(abs($records['ball_chain_fancy_75_chain'][$index]['weight']))?></td>
      <td class='text-right'><?=$total_ball_chain_fancy_75_chain_vodator=four_decimal(abs($records['ball_chain_fancy_75_chain'][$index]['vodator']))?></td>
      <td class=" bold text-right"><?=((!empty($total_ball_chain_fancy_75_weight)&&!empty($total_ball_chain_fancy_75_chain_vodator))?four_decimal(($total_ball_chain_fancy_75_chain_vodator/$total_ball_chain_fancy_75_weight)*100):0)?></td>
    </tr>
    <?php } 
	$total_fancy_internal_wastage_weight=$total_fancy_internal_wastage_vodator=0;
    if($fancy_chain_internal_wastages){
	$fancy_chain_internal_wastage_chine_wise_detail=$fancy_chain_internal_wastages[$index];
      foreach ($fancy_chain_internal_wastage_chine_wise_detail as $fancy_chain_internal_wastage_name => $fancy_chain_internal_wastage_value) { 
	if(!empty($fancy_chain_internal_wastage_value['weight'])&&($fancy_chain_internal_wastage_value['weight']!=0)){
		$total_fancy_internal_wastage_weight+=abs($fancy_chain_internal_wastage_value['weight']);
		$total_fancy_internal_wastage_vodator+=abs($fancy_chain_internal_wastage_value['vodator']);

	?> 
    <tr>
      <td class=''><?=$fancy_chain_internal_wastage_name?></td>
      <td class=''></td>
      <td class='text-right'><?=four_decimal(abs($fancy_chain_internal_wastage_value['weight']))?></td>
      <td class='text-right'><?=four_decimal(abs($fancy_chain_internal_wastage_value['vodator']))?></td>
      <td class=" bold text-right"><?=((!empty(abs($fancy_chain_internal_wastage_value['weight']))&&!empty(abs($fancy_chain_internal_wastage_value['vodator'])))?four_decimal((abs($fancy_chain_internal_wastage_value['vodator'])/abs($fancy_chain_internal_wastage_value['weight']))*100):0)?></td>
    </tr> 
    <?php }}
  }}

  $sub_total_out_weight=$sub_total_out_vodator=$rolling_data=0;

  ?>
    
    <tr class="bg_gray">
      <td class=" bold">Total</td>
      <td class=" bold text-right"></td>
      <td class=" bold text-right"><?=$sub_total_out_weight=four_decimal(($records['hook_kdms'][$index]['weight'])+$total_sisma_3_mm_para_weight+$total_sisma_3_mm_anc_clipping_weight+$total_sisma_2_mm_weight+$total_omega_weight+$total_ka_chain_fancy_75_chain_weight+$total_ka_chain_fancy_92_weight+$total_ball_chain_fancy_75_chain_weight+$total_ball_chain_fancy_92_chain_weight+$total_fancy_internal_wastage_weight+$total_ka_chain_fancy_75_weight+$total_ball_chain_fancy_75_weight+$total_fancy_pipe_and_para_chain_weight)?></td>
      <td class=" bold text-right"><?=$sub_total_out_vodator=four_decimal((($records['hook_kdms'][$index]['weight']*1.50)/100)+$total_sisma_3_mm_para_vodator+$total_sisma_3_mm_anc_clipping_vodator+$total_sisma_2_mm_vodator+$total_omega_vodator+$total_ka_chain_fancy_75_chain_vodator+$total_ka_chain_fancy_92_vodator+$total_ball_chain_fancy_75_chain_vodator+$total_ball_chain_fancy_92_chain_vodator+$total_fancy_internal_wastage_vodator+$total_ka_chain_fancy_92_chain_vodator+$total_fancy_pipe_and_para_chain_vodator+$interest_data)?></td>
      <td class=" bold text-right"><?=(!empty($sub_total_out_weight)&&!empty($sub_total_out_vodator))?four_decimal(($sub_total_out_vodator/$sub_total_out_weight*100)):0?></td>
    </tr>
    
    <tr class="bg_blue">
      <td class=" bold">Grand Total</td>
      <td class=" bold text-right"></td>
      <td class=" bold text-right"><?=$grand_total_weight=four_decimal(($total_weight+$total_refresh_weight+$total_internal_weight+$total_ka_ball_chain_fancy_92_chain_weight+$total_ka_ball_chain_fancy_75_chain_weight)-($sub_total_out_weight))?></td>
      <td class=" bold text-right"><?=$grand_total_vodator=four_decimal(($total_vadotar+$total_refresh_vadotar+$total_internal_vadotar+$total_ka_ball_chain_fancy_92_chain_vodator+$total_ka_ball_chain_fancy_75_chain_vodator)-($sub_total_out_vodator))?></td>
      <td class=" bold text-right"><?=(!empty($grand_total_weight)&&!empty($grand_total_vodator))?four_decimal(($grand_total_vodator/$grand_total_weight*100)):0?></td>
    </tr>
    <tr>
      <td class=''>Rolling Avg Total</td>
      <td class=''></td>
      <td class='text-right'><?=$rolling_data=four_decimal(abs($records['rolling_data'][$index]['weight']))?></td>
      <td class='text-right'></td>
      <td class=" bold text-right"></td>
    </tr> 
    <tr class="bg_gray">
      <td class=" bold">Total</td>
      <td class=" bold text-right"></td>
      <td class=" bold text-right"><?=$rolling_data?></td>
      <td class=" bold text-right"></td>
      <td class=" bold text-right"></td>
    </tr>
  </tbody>
</table>
<?php }}?>
