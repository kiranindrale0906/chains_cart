<?php
class Dashboard_autherization {
  function check_dashboard() {
  	$ci =& get_instance();
  	/*if(HOST == 'ARC'){
  		if($ci->router->module == 'dashboards' && $ci->router->class == 'dashboards')
        
  			redirect('melting_lots/melting_lots');
  	}*/if(HOST == 'AR Gold Internal'){
      if($ci->router->module == 'dashboards' && $ci->router->class == 'dashboards')
        redirect('melting_lots/melting_lots');
    }
  	// if(HOST == 'ARF'){
  	// 	if($ci->router->module == 'dashboards' && $ci->router->class == 'dashboards')
  	// 		redirect('melting_lots/melting_lots');
  	// }
  }
}
?>