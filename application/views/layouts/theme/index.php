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
    <link rel="icon" type="image/png" sizes="16x16" href="<?= CORE_PATH ?>images/common/favicon.ico">
    <?php 
      $this->load->view('layouts/theme/css');
    ?>   
</head>
<?php if(HOST == 'BACKUP ARF' || HOST == 'BACKUP ARG')
      $class="thm_white";
      else $class ='thm_soft_teal';?>
<body class="<?=$class;?> expand_sidemenu <?= @$_SESSION['mini_sidebar'] ?>" data-url = <?php echo base_url();?>>
  <input type="hidden" id="base_url" value="<?php echo base_url() ?>"> 
  <main>
    <?php $this->load->view('navigation/theme/header'); ?>
    <?php $this->load->view('navigation/theme/sidebar'); ?>
    <div class="main_wrapper">     
      <div class="wrapper_container">
        <div class="card card-default">
          <div class="card-body full_height">
            <?php
              if($this->router->method == 'view'){
                $page_details = @getTableSettings();
                $page_heading = @$page_details['view_title'];
              }else{
                $page_details = array();
              }
            ?>
            <div class="boxrow mb-2">
              <div class="float-left">
                <?php  
                      $create_title = get_form_title($this->router->class, $this->router->method);
                     
                    ?>
                    <h6 class="heading blue bold text-uppercase mb-0"><?= @$page_heading; ?></h6>
              </div>
            </div>
            <?php
              if (isset($view)):
                  $this->load->view($view);
              endif;
            ?>    
          </div>
        </div>      
      </div>
      <!-- <footer class="footer"> © 2019</footer> -->
    </div>
  </main>
  <input type="hidden" name="<?php echo get_csrf_token()['name']?>" value="<?php echo get_csrf_token()['hash'];?>" id="csrf_token">
  
  <?php $this->load->view('layouts/application/modals/index'); ?>
  <?php $this->load->view('layouts/theme/js'); ?>  
  <script >
    var url = '<?php echo base_url().$this->router->fetch_module().'/'.$this->router->fetch_class().'/';?>';
    var tooltips = <?=(isset($tooltips) && ($tooltips !='NULL' || $tooltips !=NULL))?get_tooltips_json($tooltips):2; ?>;
    var module_name = "<?php echo $this->router->fetch_module();?>";
  </script>
  <div class="overlaybg ajaxloader onclick_ajaxloader_js"></div>
  <div class="overlaybg overlaybg_js"></div>
</body>
</html>