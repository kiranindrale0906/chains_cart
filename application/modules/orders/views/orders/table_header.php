<div class="btn-toolbar float-right">
  <?php load_buttons('anchor', 
                array('name'  => 'Add Order',
                      'href' => base_url()."masters/chains",
                      'class' =>'btn btn-sm btn-primary mb-2 ml-2'));
  ?>
  <?php 
  if(empty($_GET)) {
    load_buttons('anchor',
                array('name'=>'Show Hidden Orders',
                    'href'=>base_url()."orders/orders?show_all=yes",
                    'class'=>'btn btn-sm btn_green mb-2 ml-2'
                )); 
  }?>
</div>