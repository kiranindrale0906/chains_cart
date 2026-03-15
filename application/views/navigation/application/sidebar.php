<div class="sidenavbar sidenavbar_js expand thm_red bold" style="width: 220px; padding: 10px 10px;">
  <div class="sidenav_scroll_js sidenav_scroll">
    <ul style="list-style: none; padding: 0; margin: 0;">
      <?php 
      if (!empty($_SESSION['controller_list'])) {
        foreach ($main_menu as $main_menu_title => $sub_menus) { 
          if (!empty($sub_menus) && is_array($sub_menus)) {
            if (!empty(array_intersect(array_keys($sub_menus), $_SESSION['controller_list']))) { ?> 
              <li class="sidebar-section">
                <div class="sidebar-card" >
                  <i class="<?php echo $menu_icons[$main_menu_title]; ?>"></i>
                  <span><?= $main_menu_title; ?></span>
                </div>
                <ul class="submenu" >
                  <?php 
                  foreach ($sub_menus as $sub_menu_url => $sub_menu_title) { 
                    $active = ($this->router->module . '/' . $this->router->class == $sub_menu_url) ? 'active' : ''; 
                    $this->load->view('navigation/application/sidebar_item', 
                      array(
                        'url' => ADMIN_PATH . $sub_menu_url,
                        'active' => $active,
                        'title' => $sub_menu_title,
                      )); 
                  } ?>
                </ul>
              </li>
            <?php } 
          } else {
            if (!empty(in_array($main_menu[$main_menu_title], $_SESSION['controller_list']))) { ?>
              <li class="sidebar-section">
                <a href="<?= ADMIN_PATH . $main_menu[$main_menu_title] ?>" class="sidebar-card" >
                  <i class="<?php echo $menu_icons[$main_menu_title]; ?>"></i>
                  <span><?= $main_menu_title; ?></span>
                </a>
              </li>
            <?php } 
          }
        }
      } ?>
    </ul>
  </div>
</div>

<script>
  document.querySelectorAll('.sidebar-card').forEach(card => {
    card.addEventListener('click', function() {
      let submenu = this.nextElementSibling;
      if (submenu && submenu.classList.contains('submenu')) {
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
      }
    });
  });
</script>
 <style>
    

    .sidebar {
      width: 260px;
      background-color: transparent;
      padding: 20px 10px;
      height: 100vh;
      box-sizing: border-box;
      overflow-y: auto;
    }

    .sidebar-section {
      margin-bottom: 10px;
    }

    .sidebar-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
      background: #ffffff;
      border-radius: 12px;
      padding: 12px 16px;
      margin: 6px 0;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      color: #333;
      cursor: pointer;
      transition: all 0.2s ease-in-out;
    }

    .sidebar-card:hover {
      background-color: #007bff;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2);
    }

    .sidebar-card i {
      font-size: 18px;
    }

    .submenu {
      display: none;
      padding: 8px 20px;
      background-color: #9da6ae;
      border-radius: 0 0 10px 10px;
      font-size: 14px;
      color: #333;
      margin-top: 4px;
    }

    .sidebar-section.open .submenu {
      display: block;
    }

    .submenu-item {
      padding: 6px 0;
    }
  </style>