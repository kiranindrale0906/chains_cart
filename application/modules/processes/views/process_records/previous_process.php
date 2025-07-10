<div class="row">
	<div class="col-sm-12">
	  <h6 class='blue text-uppercase bold mb-3'>Previous Process</h6>
	  <a class="pull-right" target="_blank" href="<?php echo base_url().'processes/processes/view/'.$data['id']?>">View</a>
	</div>
	<?php $this->load->view('in_balance');?>
	<?php $this->load->view('out_balance');?>
	<?php $this->load->view('total');?>
	</hr>
</div>