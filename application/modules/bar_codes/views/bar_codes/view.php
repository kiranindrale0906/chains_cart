


<div>
	<p style="font-size: 10px;margin:0;width: 100px;text-align: right;margin-left: 0px;"><?php echo $bottom_text;?></p>
	<div style="float: left;margin-left: 6px;">
		<?php
				$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
				$string = $generator->getBarcode($bar_code_data[0], $generator::TYPE_CODE_39);

					echo '<img style="width:100px; height:30px;" class="barcode_image devided_div" src="data:image/png;base64,' . base64_encode($string) . '">';
			?>
	</div>
	<div style="font-size: 8px;float: left;margin-left: 30px;margin-top: -8px;">
		<?php echo $product_name;?><br/>		
			<?php echo $process_name;?><br/>			
			<?php echo $lot_no;?><br/>	
			<?php echo $design_code;?>
	</div>
</div>
					




