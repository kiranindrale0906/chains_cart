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
      <title>Casting</title>
      <?php $this->load->view('layouts/table/css'); ?>
      <script>
          var chart = [];
      </script>  
  </head>

  <body class="thm_soft_teal">
  <input type="hidden" id="base_url" value="<?php echo base_url() ?>"> 
    <?php $this->load->view('navigation/theme/header'); ?>
    <?php $this->load->view('navigation/theme/sidebar'); 
    
    ?>
    <main>
      <div class="main_wrapper">
        <div class="row">
          <div class="col-12">
            <div class="boxRow p-3">
              <h6 class="mb-0 text-uppercase bold"><?=@$page_title?></h6>
              <?php 
                  load_buttons('anchor',array('name'=>'View All Records',
                                              'class'=>'btn-xs p-0 blue',
                                              'layout' => 'application',
                                              'href' => base_url().$this->router->fetch_module().'/'.$this->router->fetch_class().'?archive=0'));
                  load_buttons('anchor',array('name'=>'Hide Archive Records',
                                              'class'=>'btn-xs p-0 red',
                                              'layout' => 'application',
                                              'href' => base_url().$this->router->fetch_module().'/'.$this->router->fetch_class()));
              ?>
            </div>
          </div>
        </div>

        <div id="parent" class="clearfix">
          <!-- <div class="column-two table-responsive"> -->
            <?php $this->load->view('processes/processes/index') ?>
          <!-- </div> -->
        </div>
      </div>
    </main>
    <?php $this->load->view('layouts/application/modals/index'); ?>
    <?php $this->load->view('layouts/table/js'); ?>
    <script >
    var url =  '<?php echo base_url().$this->router->fetch_module().'/'.$this->router->fetch_class().'/';?>';
    var base_url ='<?php echo base_url()?>';
    var tooltips = <?=(isset($tooltips) && ($tooltips !='NULL' || $tooltips !=NULL))?get_tooltips_json($tooltips):2; ?>;
    var module_name = "<?php echo $this->router->fetch_module();?>";
  </script>
    <div class="overlaybg ajaxloader onclick_ajaxloader_js"></div>
    <div class="overlaybg overlaybg_js"></div>
    <div class="print"></div>
  </body>
</html>


