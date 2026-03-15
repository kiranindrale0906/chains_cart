<?php

 load_buttons('anchor',array('name'=>'Print Barcode',
                                        'layout' => 'application',
                                        'class'=>'btn-xs bold blue bar_code_genrate ajax float-right',
                                        'icon'=>'fa fa-print',
                                        'href'=>base_url().'bar_codes'.'/'
                                              .'bar_codes?barcode_code='.@$process_data['id']
                                              .'&product_name='.@$process_data["product_name"]
                                              .'&process_name='.@$process_data["process_name"]
                                              .'&lot_no='.@$process_data['lot_no']
                                              .'&lot_purity='.@$process_data['in_lot_purity']
                                              .'&design_code='.@$process_data['design_code']));
                                              ?>

<div class="row">
  <div class="col-md-6 border-right">
    <div class="form-group container">
      <p><h6>Date : <?=date('d-m-Y',strtotime($record['created_at']))?></h6></p>
      <p><h6>Process : <?=$record['process_name']?></h6></p>
      <p><h6>Process : <?=$record['sub_process_name']?></h6></p>
      <p><h6>Parent Lots : <?=$record['parent_lot_name']?></h6></p>
      <p><h6>Description : <?=$record['description']?></h6></p>
      <p><h6>Name Of Staff : <?=$record['staff_name']?></h6></p>
      <p><h6>Lot No : <?=$record['lot_no']?><h6></p>
      <hr>
      <p><h6>Karigar : <?=$record['karigar']?></h6></p>
      <p><h6>Chain : <?=$record['chain']?><h6></p>
      <p><h6>Category One : <?=$record['category_one']?><h6></p>
      <p><h6>Category Two : <?=$record['category_two']?><h6></p>
      <p><h6>Size : <?=$record['category_three']?><h6></p>
      <p><h6>Category Four : <?=$record['category_four']?><h6></p> 
      <p><h6>Line : <?=@$record['line']?><h6></p> 
      <p><h6>Tone : <?=$record['tone']?><h6></p>
      <p><h6>Type Of Material : <?=@$record['type_of_material']?><h6></p>
      <p><h6>Type Of Langadi : <?=@$record['type_of_langadi']?><h6></p>
      <p><h6>Lopster No : <?=@$record['lopster_no']?><h6></p>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group container">
      <p><h6>Total Wastage Weight : <?=$record['wastage_weight']?></h6></p>
      <p><h6>Pure Gold Required : <?=$record['pure_gold_weight']?></h6></p>
      <p><h6>Additional Alloy Weight : <?=$record['additional_alloy_weight']?></h6></p>
      <p><h6>Alloy Required : <?= $record['alloy_weight'] + $record['additional_alloy_weight'] ?></h6></p>
      <p><h6>Alloy Vodatar : <?= $record['alloy_vodatar'] ?></h6></p>
      <hr>
      <p><h6>Gross Weight : <?=$record['gross_weight']?></h6></p>
      <p><h6>Purity : <?= four_decimal($record['lot_purity']).' %'?></h6></p>
      <p><h6>Hook KDM Purity : <?= four_decimal($record['hook_kdm_purity']).' %'?></h6></p>
    </div>
  </div>
</div>