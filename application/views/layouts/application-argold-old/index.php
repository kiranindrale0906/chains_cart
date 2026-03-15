<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= ADMIN_LAYOUTS_PATH ?>images/common/favicon.png">
    <title>AR Gold</title>
    <?php $this->load->view('layouts/application/css'); ?>
    <script>
        var chart = [];
    </script>  
</head>

<body class="thm_black <?= @$_SESSION['mini_sidebar'] ?>">  
  <input type="hidden" id="base_url" value="<?php echo base_url() ?>">

  <?php 
    $page_details = getTableSettings();
    $create_title = get_form_title( $this->router->class, $this->router->method);
    $class = ucwords(str_replace('_', ' ', $create_title));
    $title =$class;
  ?>

  <main>
    <?php $this->load->view('layouts/application/navigation/headnav'); ?>
    <?php $this->load->view('layouts/application/navigation/sidenav'); ?>
    <div class="main_wrapper">
    <div class="col-12">
      <?php if($this->router->method == 'index' ): ?>
        <h6 class="heading blue bold text-uppercase pt-3 mb-0"><?= @$page_details['page_title']; ?></h6>
      <?php endif;
      if($this->router->method == 'create' || $this->router->method == 'edit') : ?>
        <h6 class="heading blue bold text-uppercase pt-3 mb-0"><?= @$title; ?></h6>
      <?php endif;?>
    </div>   
     
      <div class="wrapper_container">
        <div class="card card-default">
          <div class="card-body">
            <?php
    
              if (isset($view)):
                  $this->load->view($view);
                  
              endif;
            ?>    
          </div>
        </div>      
      </div>
      <footer class="footer"> © 2019 AR Gold</footer>
    </div>
  </main>
  <?php $this->load->view('layouts/application/modals/index'); ?>
  <?php
    if($this->router->fetch_method() == 'index'){
        if(isset($page_details['select_column']) && $page_details['select_column'] == true){
          $this->load->view('layouts/application/list/select_columns_modal');
        }
        if(isset($page_details['arrange_column']) && $page_details['arrange_column'] == true){
          $this->load->view('layouts/application/list/arrange_columns_modal');
        }
      }
  ?>
 <script >

    var url = '<?php echo base_url().$this->router->fetch_module().'/'.$this->router->fetch_class().'/';?>';
  </script>
  <?php $this->load->view('layouts/application/js'); ?>
  
</html>