<h3 class="float-left">In-app Notifications </h3>
 	<?php 
    foreach($count as $value){ 
     $url = base_url()."communications/inapp_users/update/".$value['user_id'];
    } 
    if(empty($count)){
       load_buttons('anchor', array('name'=>'count-'.count($count),
    	                             'class'=>'btn btn-lg circulbtn float-right',
    	                             'data-toggle'=>'dropdown',
                                    'href'=> $url ));
    } else{
       load_buttons('anchor', array('name'=>'count-'.count($inapp_data),
                                   'class'=>'btn btn-lg circulbtn ajax float-right',
                                   'data-toggle'=>'dropdown',
                                    'href'=> $url ));
    } ?>
  <div class="dropdown-menu">
    <ul class="list-group list-group-flush">
      <?php foreach($inapp_data as $value){ 
        $url = base_url()."communications/inapp_notifications/update/".$value['id'];
         load_buttons('anchor', array('name'=> $value['message'],
                                      'href'=> $url));
          } 
      ?>
    </ul>
  </div>

  

 