<?php 
  if(!PAGES_MINIFY){
  	foreach (APPLICATION_JS() as $js) {?>
      <script src="<?=$js?>"></script>
  	<?php } 
  	if($this->router->fetch_class() == 'home'){
  		foreach (HOME_JS() as $js) {?>
      <script src="<?=$js?>"></script>
  	<?php }
  	}
  	if($this->router->fetch_class() == 'storefronts'){
  		foreach (SEARCH_PAGE_JS() as $js) {?>
      <script src="<?=$js?>"></script>
  	<?php }
  	}

  }
  else{  ?>
    <script src="<?=LAYOUT_PATH();?>minified/application-<?=JS_CSS_TIMESTAMP?>.js"></script>
  <?php }?>

