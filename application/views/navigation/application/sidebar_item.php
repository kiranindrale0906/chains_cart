<?php

 if(in_array(str_replace(base_url(), '', $url), $_SESSION['controller_list'])): ?>

  <li class="<?= @$class ?>">
    <a class="nav-link <?= $active ?>"
       href="<?= $url ?>">
       <?php if(!empty($menu_icon) && $menu_icon!=''){?>   
		    <span class="icon"><i class="<?= $menu_icon ?> "></i></span>
		   <?php }?>

     	<span class="menuname"><?= $title ?></span>
    </a>
  </li>
<?php endif; ?>