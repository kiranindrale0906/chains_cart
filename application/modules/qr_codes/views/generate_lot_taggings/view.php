
<div class="boxrow mb-2">
	<div class="float-left">
		<h6 class="heading blue bold text-uppercase mb-0">Generate Lot Tagging
		</h6>
	</div>
</div>
<div class="row">
  <div class="col-md-6 border-right">
      <div class="">
      	<p><h6>Date : <?=date('d-m-Y',strtotime($record['created_at']))?></h6></p>
        <p><h6>Lot No : <?= $record['lot_no']?></h6></p>
        <p><h6>Order Date : <?=date('d-m-Y',strtotime($record['created_at']))?></h6></p>
        <p><h6>Due Date : <?=date('d-m-Y',strtotime($record['due_date']))?></h6></p>
        <p><h6>Purity : <?= $record['purity']?></h6></p>
        <p><h6>Lot Weight : <?=$record['lot_weight']?></h6></p>
        <p><h6>Lot Quantity : <?=$record['lot_quantity']?></h6></p>
      </div>
    </div>
    <div class="col-md-6 border-right">
      <div class="">
        <p><h6>Colour : <?=$record['color']?><h6></p>
        <p><h6>Process Name : <?=$record['process_name']?><h6></p>
      </div>
    </div>
  
</div>
<hr>
<h6 class="heading blue bold text-uppercase mb-0">Qr Code Details
		</h6>
<table class="table table-sm table-default table-hover">
	<thead>
		<tr>
			<th class="text-left">Order No</th>
			<th class="text-left">Customer Name</th>
			<th class="text-left">Bom Factory Code</th>
			<th class="text-left">Design Code</th>
			<th class="text-left">Item Code</th>
			<th class="text-right">Gross Weight</th>
			<th class="text-right">Image</th>
			<th class="text-right">Action</th>
			<th class="text-right"></th>
		</tr>
	</thead>
	
	<tbody>
		<?php
			if(!empty($generate_lot_tagging_details)){
				$sum_weight= $sum_length=0;
				foreach ($generate_lot_tagging_details as $index => $generate_lot_tagging_record) {
					$sum_weight+=$generate_lot_tagging_record['weight'];
					?>
					<?php 
					$image_path="";
					if($generate_lot_tagging_record['type_of_order'] =='export_order'){

						$image_path ='https://export-orders.ar-gold.in/uploads/orders/original/';
					                  
						}elseif($generate_lot_tagging_record['type_of_order'] =='swarnshilp_order'){
						$image_path ='https://swarnshilp.ascra.in/uploads/';
					                  
						}else{

						$image_path ='https://argold-catalog.8848digital.com/';
						}
					?>
				 <tr>
				 		<td class="text-left"><?= $generate_lot_tagging_record['order_no']?></td>
				 		<td class="text-left"><?= $generate_lot_tagging_record['customer_name']?></td>
				 		<td class="text-left"><?= $generate_lot_tagging_record['bom_factory_code']?></td>
				 		<td class="text-left"><?= $generate_lot_tagging_record['design_code']?></td>
				 		<td class="text-left"><?= $generate_lot_tagging_record['item_code']?></td>
				 		<td class="text-right"><?= $generate_lot_tagging_record['weight']?></td>
				 		<td class="text-right">
							<?php if(!empty($generate_lot_tagging_record['order_detail_image'])){ ?>
							<img src="<?= $image_path.$generate_lot_tagging_record['order_detail_image'] ?>" width=70 height=70/>
							<?php } ?>
						</td>
						<td class="text-right">
							<span>
								<a href="<?= base_url()."qr_codes/generate_lot_tagging_details/delete/".$generate_lot_tagging_record['id']?>" 
									 target='_blank' class="red">Delete</a>
							</span>
						</td>
					</tr> 
				<?php }?>
				 <tr class="bg_gray">
				 		<td></td>
				 		<td></td>
				 		<td></td>
				 		<td></td>
				 		<td></td>
						<td class="text-right"><?= number_format($sum_weight, 4)  ?></td>
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
