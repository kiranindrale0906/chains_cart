<?php 
	$missing_column2 = array_diff($db1_key,$db2_key);
	$implode_missing_columns2 = implode(',',$missing_column2);
	echo "Columns Added in Current Database Table: <b>".$implode_missing_columns2.'</b></br>'; 
	$missing_column1 = array_diff($db2_key,$db1_key);
	$implode_missing_columns1 = implode(',',$missing_column1);
	echo "Columns Removed From Current Database Table: <b>".$implode_missing_columns1.'</b>'; 
?>

<div class="row">
	<div class="table-responsive tablefixedheader col-sm-6">
	<h5>Current Database Data</h5>
	  <table class="table table-sm fixedthead table-default" >
		<?php $this->load->view('table_header',array('headings'=>$db1_key))?>
		<?php $this->load->view('tboady',array('db'=>$db1))?>
	  </table>
	</div>
	<div class="table-responsive tablefixedheader col-sm-6">
	<h5>Backup  Database Data</h5>
	  <table class="table table-sm fixedthead table-default" >
			<?php $this->load->view('table_header',array('headings'=>$db2_key))?>
			<?php $this->load->view('tboady',array('db'=>$db2))?>
	  </table>
	</div>
</div>
<div class="row">
	<div class="table-responsive tablefixedheader">
	<h5>Diffrence In Database Data</h5>
	  <table class="table table-sm fixedthead table-default" >
		<?php $this->load->view('table_header',array('headings'=>$db1_key))?>
		<?php $this->load->view('tboady_difrence',array('db'=>$db1,'db2'=>$db2,'columns'=>$implode_missing_columns2))?>
	  </table>
	</div>
</div>

<div class="row">
		<?php $this->load->view('pagination')?>
		
</div>
