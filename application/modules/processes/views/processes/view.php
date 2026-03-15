<?php 
  if(isset($_GET['old']) && !empty($_GET['old'])) 
    $this->load->view('processes/processes/view_old',$data);
  else 
    $this->load->view('processes/processes/view_new',$data);
?>