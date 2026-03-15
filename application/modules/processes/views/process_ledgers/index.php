<h4 class="heading">Stock Difference Ledger Summary</h4>

<a style="float: right" href="/processes/process_ledgers?rebuild=1" class="btn btn-primary btn-sm" role="button" aria-disabled="true">
	Generate
</a>

<div class="row">
	<div class="col-md-3">  
		<?php $this->load->view('processes/process_ledgers/ledger_summary'); ?>
	</div>

	<div class="col-md-3">  
		<?php $this->load->view('processes/process_ledgers/lot_summary'); ?>	
	</div>

	<div class="col-md-4"> 
			<?php $this->load->view('processes/process_ledgers/lotwise_process'); ?>
			<?php $this->load->view('processes/process_ledgers/lot_field_summary'); ?>	
			<?php $this->load->view('processes/process_ledgers/field_breakup_for_lot'); ?>
			<?php $this->load->view('processes/process_ledgers/field_breakup_for_process'); ?>
	</div>
</div>
