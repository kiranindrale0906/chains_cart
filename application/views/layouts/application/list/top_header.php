<?php
    if($this->router->method == 'index')
      $page_details = @getTableSettings();
    else
      $page_details = array();
  ?>

<div class="boxrow mb-2">
  <div class="float-left">
    <?php  
          $create_title = get_form_title($this->router->class, $this->router->method);
          $page_heading = @$page_details['page_title'];
        ?>
        <h6 class="heading blue bold text-uppercase mb-0"><?= @$page_heading; ?></h6>
  </div>
  <div class="float-right">
  	<?php if ($master_name != '') :
  		$page_details = getTableSettings();

      $this->_module = $this->router->fetch_module();
      $create_url = base_url().$this->_module.'/'.$this->router->class."/create"; 
      if($this->router->class=='ka_chain_order_details'|| $this->router->class=='ball_chain_order_details'){
         $create_url= $create_url.'?order_id='.$_GET['order_id'];
      }
      if (!empty($page_details['create_id']))
        $create_url .= '/'.@$_GET[$page_details['create_id']];
      
      // if (!empty($_GET))
      //   $create_url .= '?'.@$page_details['where'];


      $query_string = $_SERVER['QUERY_STRING'];

      $export_url = base_url().$master_name."?export=1&".$query_string; 
   
	    if (!empty($page_details['export_title'])) { 
		    load_buttons('anchor', array(
                    'name'=> $page_details['export_title'],                    
                    'class'=>'btn btn-sm btn_blue ajax',              
                    'href'=>$export_url
		                ));
		  }
		  
		  if (!empty($page_details['import_title'])) { 
		  	load_buttons('anchor', array(
	                    'name'=> $page_details['import_title'],                    
	                    'class'=>'btn btn-sm btn-primary',         
	                    'href'=>base_url().$master_name."/create?import=1"
		                ));
      }			

      if (!empty($page_details['add_method']) AND !empty($page_details['add_title'])) {
    		load_buttons('anchor', array(
                    'name'=> $page_details['add_title'],                    
                    'class'=>'btn btn-sm btn-primary',
                    'data-toggle'=>"modal",
                    'data-target'=>"#myModal",
                    'onclick' => 'ajax_get_request(\'' 
        													. $create_url . '\',\'' . $page_details['add_title']. '\');',                  
                    'href'=>"javascript:void(0);"
	                ));
      } 
      if (empty($page_details['add_method']) AND !empty($page_details['add_title'])) {
        load_buttons('anchor', array(
                    'name'=> $page_details['add_title'],                    
                    'class'=>'btn btn-sm btn_blue',
                    'href'=>$create_url
                  ));

      }
      if (empty($page_details['add_method']) AND !empty($page_details['add_title_with_json'])) {
      	load_buttons('anchor', array(
                    'name'=> $page_details['add_title_with_json'] ,                   
                    'class'=>'btn btn-sm btn_blue',
                    'href'=>$create_url.'?json=1'
	                ));

      }
      endif; ?>
  </div>
</div>