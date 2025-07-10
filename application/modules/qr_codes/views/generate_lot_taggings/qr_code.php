<body style="margin: 0px 0px 0px 10px;">
	<?php 
		$host = (HOST == 'AR GOLD') ? 'ARG' : HOST;
		foreach ($generate_lot_qr_code_details as $index => $qr_code_detail) { ?>
			<div class="container" style="display: flex; height: 'auto'; align-items: center; justify-content: center;">
	      <div style="width: 'auto'">
	        <?php 
						$string=$qr_code_detail['id'].'|'.$qr_code_detail['design_code'].'|'.number_format($qr_code_detail['weight'],3).'|'.number_format($qr_code_detail['net_weight'],3).'|'.number_format($qr_code_detail['less'], 3).'|'.number_format($qr_code_detail['percentage'], 0).'|'.number_format($qr_code_detail['purity'],0).'|'.number_format($qr_code_detail['length'], 0).'|'.$host.'|JAN21';	  	
						$qr_code = generate_qrcode($string,'48');
						echo $qr_code;
					?>
	      </div>
	      <div style="font-size: 7px; font-weight: bold; font-family: Helvetica">
	    		<?php echo 'N.W - '.number_format($qr_code_detail['net_weight'], 2); ?><br>
	    		<?php echo 'S.C - '.number_format($qr_code_detail['stone_count'], 0); ?><br>
	      </div>
	      <div style="flex-grow: 1; margin-left: 48px; font-size: 8px; 
	      					  font-weight: bold; font-family: Helvetica">
	      	<?php echo $qr_code_detail['design_code'] ?><br>
	    		<?php echo 'G.W - '.number_format($qr_code_detail['weight'],3) ?><br>
	    		<?php echo 'LT - '.number_format($qr_code_detail['length'],0); ?><br>  
	    		<?php echo 'L - '.number_format($qr_code_detail['less'],3).'&nbsp &nbsp'.number_format($qr_code_detail['purity'], 0).'/'.number_format($qr_code_detail['percentage'],0); ?><br>
	    		<?php echo 'N.W - '.number_format($qr_code_detail['net_weight'], 2); ?><br>
	      </div>
	    </div>
		<?php }
	?>	
</body>


	

