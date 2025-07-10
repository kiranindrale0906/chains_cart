<?php
  $namespace = $this->router->module;
  $controller = $this->router->class;
  $action = $this->router->method;
  $ci = &get_instance();
  $id = $ci->uri->segment(3);
  
  $create_title = get_form_title($controller, $action);
?>
  <?php  
    $create_title = !empty($form_title)?$form_title:get_form_title($this->router->class, $this->router->method);

    $page_heading = ucwords(str_replace("_", " ", $create_title));
    
    if($page_heading=='Category Fours Create'|| $page_heading=='Category Fours Edit'|| $page_heading=='Category Fours Store'|| $page_heading=='Category Fours Update'){
      $page_heading = ucwords(str_replace("Category Fours", "Design Name", $page_heading));
    }
  ?>
  <h6 class="heading blue bold text-uppercase mb-0"><?= @$page_heading; ?></h6>
  <hr>

<?php 
  
  if($this->form_path)$form = $this->form_path;
  else $form = $namespace."/".$controller;
  //pr($form);

  if (@$import == 1)
    $this->load->view($form.'/import',
                            array('controller' => $namespace."/".$controller,
                                  'action' => $action));
  else
    $this->load->view($form. '/form',
                            array('controller' => $namespace."/".$controller,
                                  'action' => $action))
  
?>    

