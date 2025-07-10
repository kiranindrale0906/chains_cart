<header class="d-flex justify-content-between align-items-center fixed-top">
  <div>
    <a href="<?php echo base_url() ?>">
       <img src="<?= THEME_PATH ?>images/common/logo.png" style="height: 50px;">      
    </a> 
    <button class="btn btn-lg btn_icon btn_slide_sidemenu btn_slide_sidemenu_js">
      <i class="fal fa-align-justify"></i>
    </button>    
  </div>  
  <div class="d-flex align-items-center justify-content-end float-right">    
    <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])):?>
      <ul class="nav">      
        <li class="nav-item usermenu">
          <div class="dropdown">
            <a href="#" class="nav-link btn btn-lg cyan" data-toggle="dropdown">
             <i class="fas fa-user blue"></i>
            </a>
            <div class="dropdown-menu animated slideIn">            
              <ul class="list-unstyled menu-list">
                <li><a href="#" class="btn link-black"><i class="fas fa-user font30 gray align-middle"></i></i> <span class="d-inline-block text-left pl-2 align-middle"><?= $_SESSION['name']; ?> <br><?= $_SESSION['email_id']; ?></span></a></li>                     
                <div class="dropdown-divider"></div>
                <li>
                  <a href="<?= ADMIN_PATH.'users/logout' ?>" class="btn cyan">
                  <i class="fa fa-power-off blue"></i> Logout</a>
                </li>
              </ul>
              <?php $session = $this->session->userdata(); ?>            
            </div>
          </div>       
        </li>      
      </ul> 
    <?php else:?>
      <a href="<?= base_url().'users/login/create'?>" class="">Login</a>
    <?php endif;?>  
  </div>
</header>