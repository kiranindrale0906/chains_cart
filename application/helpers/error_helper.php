<?php 
function show_404_data_not_found(){
	$ci =& get_instance();
	$ci->load->view('errors/html/404/index.php');
}