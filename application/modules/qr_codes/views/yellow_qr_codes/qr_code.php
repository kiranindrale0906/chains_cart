<body style="margin: 0px 0px 0px 10px;">
	<?php 
		$host = (HOST == 'AR GOLD') ? 'ARG' : HOST;
		ini_set('max_execution_time',0);
		foreach ($yellow_qr_code_details as $index => $yellow_qr_code_detail) {

 ?>
			<div class="container" style="display: flex; height: 'auto'; align-items: center; justify-content: center;">
	      <div style="width: 'auto'">
	        <?php 
						$string=$yellow_qr_code_detail['id'].'|'.$yellow_qr_code_detail['design_code'].'|'.$yellow_qr_code_detail['item_code'].'|'.number_format($yellow_qr_code_detail['weight'],3).'|'.number_format($yellow_qr_code_detail['net_weight'],3).'|'.number_format($yellow_qr_code_detail['less'], 3).'|'.number_format($yellow_qr_code_detail['percentage'], 0).'|'.number_format($yellow_qr_code_detail['purity'],0).'|'.number_format($yellow_qr_code_detail['length'], 0).'|'.$host.'|JAN21';	  	
						$qr_code = generate_qrcode($string,'48');
						echo $qr_code;
					?>
	      </div>
	      <div style="font-size: 7px; font-weight: bold; font-family: Helvetica">
	      		<?php //echo 'G.W - '.number_format($yellow_qr_code_detail['weight'],3) ?><br>
	      		<?php //echo 'D.W - '.number_format($yellow_qr_code_detail['dispatch_weight'], 2); ?><br>
	    		<?php echo 'N.W - '.number_format($yellow_qr_code_detail['net_weight'], 2); ?><br>
	    		<?php //echo 'S.C - '.number_format($yellow_qr_code_detail['stone_count'], 0); ?><br>
	      </div>
	      <div style="flex-grow: 1; margin-left: 48px; font-size: 8px; 
	      					  font-weight: bold; font-family: Helvetica">
	      	<?php echo $yellow_qr_code_detail['design_code'] ?><br>
	    		<?php if($yellow_qr_code_detail['item_code']!=""){ echo $yellow_qr_code_detail['item_code'] ?><br>
	    		<?php }if($yellow_qr_code_detail['weight']!=0){ echo 'G.W - '.number_format($yellow_qr_code_detail['weight'],3); ?><br>
	    		<?php }if($yellow_qr_code_detail['stone_weight']!=0){echo 'ST - '.number_format($yellow_qr_code_detail['stone_weight'],3) ?><br>
	    		<?php }if($yellow_qr_code_detail['km']!=0){echo 'KM - '.number_format($yellow_qr_code_detail['km'],3) ?><br>
	    		<?php } if($yellow_qr_code_detail['dispatch_weight']!=0){ echo 'D.W - '.number_format($yellow_qr_code_detail['dispatch_weight'], 2); ?><br>
	    		<?php } echo number_format($yellow_qr_code_detail['purity'], 0).'/'.number_format($yellow_qr_code_detail['percentage']); ?><br>
	    		<?php //echo 'N.W - '.number_format($yellow_qr_code_detail['net_weight'], 2); ?>
	      </div>
	    </div>
		<?php }
	?>	
</body>


	

