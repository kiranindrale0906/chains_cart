<?php $action = $this->router->method; 
  //pr($data['ajax']);
?>
  <?php $displayName = (isset($displayName) ? $displayName : 'SAVE');
?>
<?php if ($action != 'index'): ?>
  <hr>
<?php endif; ?>

<?php $is_ajax_request = (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) ? TRUE : FALSE; 
?>
<?php $enter_method = (isset($record['id'])) ? '/update/'.$record['id'] : '/store'; ?>



<div class="boxrow">

<?php 
  if($is_ajax_request AND !isset($data['ajax_class'])){ 
    $ajax_class = "ajax";
  }else if(!isset($data['ajax_class']) AND !$is_ajax_request){
    $ajax_class = '';
  }else{
    $ajax_class = $data['ajax_class'];
  } 
  $classname = 'btn btn-md text-uppercase '.@$ajax_class;  
?>

  <?php if($action=="edit"){?>
    <div class="float-left">
      <?php load_buttons('anchor', array(
        'name'=>'Delete',
        'href'=> $action,
        'class'=> $classname.' bdr_red red',
      )); ?>      
    </div>
  <?php } ?>

  <?php 
  $data['button_type'] = '';
   if($data['button_type'] != 'anchor'){?>
    <div class="float-right">
      <?php 
        $btnname = 'Save & Close';
        if (isset($data['name']) && !empty($data['name'])) {
          $btnname = $data['name'];
        }
      
       if(($action=="create" || $action=="store") && !isset($data['name'])){?>
        <?php load_buttons('submit', array(
          'name'=>'Save & Add More',
          'class'=>$classname.' btn_blue',
        )); 

        } ?>
      <?php load_buttons('submit', array(
          'name'=>$btnname,
          'class'=>$classname.' btn_blue',
        )); ?>
    </div> 
  <?php }?>
  <?php  if($data['button_type'] == 'anchor'){?>
    <a   
      <?php 
        if(!isset($data['href']))
          echo 'href'.'='.'"javascript:void(0);"';

        if(!isset($data['class']))
          echo 'class'.'='.'"btn btn-sm link"';

        foreach ($data as $key => $value) {
          if($key == 'class')
            echo $key.'='."'".'btn '.$value."'";

          if($key !='icon')
            echo $key.'='."'".$value."'";
        }   
      ?>
    >
      <i class="<?= @$data['icon'];?>"></i>  <?= @$data['name'];?>
    </a>
  <?php }?>



<?php if ($action == 'index'): ?>
<?php endif; ?>

<?php if($is_ajax_request): ?>
  <script>
   var get_reload = '<?php ['is_reload_form']?>';
    $('button.ajax').on('click', function() {
      for (instance in CKEDITOR.instances) {
          CKEDITOR.instances[instance].updateElement();
      }
      var formdata = $(this).closest('form');
      var formurl = formdata.attr('action');
      var formData = new FormData(formdata[0]);
      ajax_post_request(formurl,formData);
      return false;
    });
  </script>
<?php endif; ?>

