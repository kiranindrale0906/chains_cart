<div class="boxrow mb-2">
	<div class="float-left">
		<h6 class="heading blue bold text-uppercase mb-0">Yellow Qr Code
		</h6>
	</div>
</div>
<div class="row">
<div class="col-md-6 border-right">
    <div class="form-group container">
      <p><h6>Date : <?=date('d-m-Y',strtotime($record['created_at']))?></h6></p>
      <p><h6>Purity : <?= $record['purity']?></h6></p>
      
    </div>
  </div>
  
</div>
<hr>
<h6 class="heading blue bold text-uppercase mb-0">Yellow Qr Code Details
		</h6>
<table class="table table-sm table-default table-hover">
	<thead>
		<tr>
			<th class="text-left">Design Code</th>
			<th class="text-right">Gross Weight</th>
			<th class="text-right">Dispatch Weight</th>
			<th class="text-right">Net Weight</th>
			<th class="text-right">Less</th>
			<th class="text-right">Percentage</th>
			<th class="text-right">Purity</th>
			<th class="text-right">Total Loss</th>
			<th class="text-right">Stone Weight</th>
			<th class="text-right">Other Stone</th>
			<th class="text-right">Image</th>
			<th class="text-right">Action</th>
			<th class="text-right"></th>
		</tr>
	</thead>
	
	<tbody>
		<?php
			if(!empty($yellow_qr_code_details)){
				$sum_weight= $sum_length=0;
				foreach ($yellow_qr_code_details as $index => $yellow_qr_code_record) {
					$sum_weight+=$yellow_qr_code_record['weight'];
					?>
				 <tr>
				 		<td class="text-left"><?= $yellow_qr_code_record['design_code']?></td>
				 		<td class="text-right"><?= $yellow_qr_code_record['weight']?></td>
				 		<td class="text-right"><?= $yellow_qr_code_record['dispatch_weight']?></td>
				 		<!-- <td class="text-right"><?//= $yellow_qr_code_record['hu_id']?></td> -->
				 		<td class="text-right"><?= $yellow_qr_code_record['net_weight']?></td>
				 		<td class="text-right"><?= three_decimal($yellow_qr_code_record['less'])?></td>
				 		<td class="text-right"><?= three_decimal($yellow_qr_code_record['percentage'])?>
				 		</td>
						<td class="text-right"><?= $yellow_qr_code_record['purity']?></td>
						<td class="text-right"><?= $yellow_qr_code_record['total_stone']?></td>
						<td class="text-right"><?= $yellow_qr_code_record['stone_weight']?></td>
						<td class="text-right"><?= $yellow_qr_code_record['other_stone']?></td>
						<td class="text-right">
							<?php if(!empty($yellow_qr_code_record['image'])){ ?>
							<img src="<?= ADMIN_PATH.'uploads/original/original/'.$yellow_qr_code_record['image'] ?>" width=70 height=70/>
							<?php } ?>
						</td>
						<td class="text-right">
							<span>
								<a href="<?= base_url()."qr_codes/yellow_qr_code_details/view/".$yellow_qr_code_record['id']?>" 
									 target='_blank' class="green"> Print Yellow QR Code</a>
							</span>
						</td>
						<td class="text-right">
							<span>
								<a href="<?= base_url()."qr_codes/yellow_qr_code_details/delete/".$yellow_qr_code_record['id']?>" 
									 target='_blank' class="red">Delete</a>
							</span>
						</td>
					</tr> 
				<?php }?>
				 <tr class="bg_gray">
				 		<td></td>
						<td class="text-right"><?= number_format($sum_weight, 4)  ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
				 </tr>

		 <?php }else{ ?>
				<tr>
					<td>No Record Found.</td>
				</tr>
			<?php }
		?>
	</tbody>
</table>
