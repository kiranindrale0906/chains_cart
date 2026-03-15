<?php 
 $query_string = $_SERVER['QUERY_STRING'];
	parse_str($query_string,$_GET);
?>

<?php echo form_open(base_url('dashboards/karigar_out_dashboards/index'),'method=get');?>
<div class="row float-right">
<div class="col-sm-10">
  <div class="form-group">         
    <label class="">
      Date
    </label>         
    <div class="date input_icon hover_icon hover_blue">
		  <input type="text" name="date[completed_at]" class="form-control form-control datepicker_js daterange" value="<?= !empty($_GET['date']['completed_at'])?$_GET['date']['completed_at']:''?>" id="" placeholder="DD-MM-YY" url="">		   
		</div>
	</div>
</div>

<div class="col-sm-2 align-self-center">
	<button type="submit" class="btn btn-sm btn_blue mt-3"><i class="fa fa-search"></i></button>
</div>

</div>
<?php echo form_open();?>