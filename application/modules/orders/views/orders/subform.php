<?php if(!empty($selected_labels['category_6_label'])){ ?>
	<hr><h5><?php echo 'Enter '.ucfirst($selected_labels['category_6_label']); ?></h5><hr>
	<div class="row">
	  <?php $this->load->view('orders/order_details/subform') ?>      
	</div>
<?php } ?>