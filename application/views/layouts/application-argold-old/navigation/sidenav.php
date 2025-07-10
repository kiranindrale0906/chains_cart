<?php
	$controller = $this->router->directory.$this->router->class;
	$sessionData = $this->session->userdata();
?>

<aside class="sidenavbar sidenavbar_js expand">	
	<div class="ps_scroll ps_scroll_js">	
		<ul> 
			<li class="active">				
				<a href="<?= ADMIN_PATH.'dashboard/dashboards/view' ?>">
					<span class="icon"><i class="fal fa-tachometer-alt"></i></span>
					<span class="hide-menu">Dashboard</span>
				</a>
			</li>
			<li class="submenu submenu_js">
				<a href="javascript:void(0);" class="dropicon fa-chevron-right">
					<span class="icon">
						<i class="fal fa-file-invoice-dollar"></i>
					</span>
					<span>Melting Lots</span>
				</a>
				<ul>
					<?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'melting_lots',
                'active' => ($controller=='melting_lots') ? 'active' : '',
                'title' => 'Melting Lots',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'melting_lots',
                'active' => ($controller=='user_roles') ? 'active' : '',
                'title' => 'Continous Casting & Induction',
              )); ?>           
      	</ul>
			</li>			
			<li class="submenu submenu_js">
				<a href="javascript:void(0);" class="dropicon fa-chevron-right">
					<span class="icon">
						<i class="fal fa-gem"></i>
					</span>
					<span>Hollow Chain</span>
				</a>
				<ul>
					<?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'hollow_chains/ags',
                  'active' => ($controller=='categories') ? 'active' : '',
                  'title' => 'AG',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'hollow_chains/ag_flattings',
                  'active' => ($controller=='collections') ? 'active' : '',
                  'title' => 'AG-Flatting',
              )); ?>  

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'hollow_chains/pls',
                  'active' => ($controller=='sub_categories') ? 'active' : '',
                  'title' => 'PL')); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'hollow_chains/pl_flattings',
                  'active' => ($controller=='sets') ? 'active' : '',
                  'title' => 'PL-Flatting')); ?> 

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'hollow_chains/spring_lots',
                'active' => ($controller=='sets') ? 'active' : '',
                'title' => 'Spring Lots')); ?> 

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'hollow_chains/final_processes',
                'active' => ($controller=='sets') ? 'active' : '',
                'title' => 'Final Process',
              )); ?>             
      	</ul>
			</li>			   
			<li class="submenu submenu_js">
				<a href="javascript:void(0);" class="dropicon fa-chevron-right">
					<span class="icon">
						<i class="fal fa-tasks"></i>
					</span>
					<span>Rope Chain</span>
				</a>
				<ul>
					<?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'rope_chains/ags',
                  'active' => ($controller=='gold_rates') ? 'active' : '',
                  'title' => 'AG')); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'rope_chains/ag_flattings',
                  'active' => ($controller=='gold_purities') ? 'active' : '',
                  'title' => 'AG-Flatting')); ?>  

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'rope_chains/machine_processes',
                  'active' => ($controller=='gold_tones') ? 'active' : '',
                  'title' => 'Machine Process')); ?>      

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'rope_chains/final_processes',
                  'active' => ($controller=='diamond_shapes') ? 'active' : '',
                  'title' => 'Final Process')); ?>   

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'masters/diamond_qualities',
                  'active' => ($controller=='diamond_qualities') ? 'active' : '',
                  'title' => 'Lot Loss')); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH,
                  'active' => ($controller=='diamond_rates') ? 'active' : '',
                  'title' => 'HCL')); ?>        
      	</ul>
			</li>
			<li class="submenu submenu_js">
				<a href="javascript:void(0);" class="dropicon fa-chevron-right">
					<span class="icon">
						<i class="fal fa-handshake"></i>
					</span>
					<span>Machine Chain</span>
				</a>
				<ul>      
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'machine_chains/ags',
                  'active' => ($controller=='carts') ? 'active' : '',
                  'title' => 'AG')); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'machine_chains/machine_processes',
                  'active' => ($controller=='wishlists') ? 'active' : '',
                  'title' => 'Machine Process')); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'machine_chains/final_processes',
                'active' => ($controller=='orders') ? 'active' : '',
                'title' => 'Final Process',
              )); ?>
                  
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'custom_orders/custom_orders',
                  'active' => ($controller=='custom_orders') ? 'active' : '',
                  'title' => 'Lot Loss')); ?>    

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/screenshots',
                  'active' => ($controller=='screenshots') ? 'active' : '',
                  'title' => 'HCL')); ?>
        </ul>
			</li>
      <li class="submenu submenu_js">
        <a href="javascript:void(0);" class="dropicon fa-chevron-right">
          <span class="icon">
            <i class="fal fa-handshake"></i>
          </span>
          <span>Choco Chain</span>
        </a>
        <ul>      
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'choco_chains/ags',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'AG',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'choco_chains/machine_processes',
                'active' => ($controller=='wishlists') ? 'active' : '',
                'title' => 'Machine Process',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'choco_chains/final_processes',
                'active' => ($controller=='orders') ? 'active' : '',
                'title' => 'Final Process',
              )); ?>
        </ul>
      </li>
      <li class="submenu submenu_js">
        <a href="javascript:void(0);" class="dropicon fa-chevron-right">
          <span class="icon">
            <i class="fal fa-handshake"></i>
          </span>
          <span>Round Box Chain</span>
        </a>
        <ul>      
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'round_box_chains/ags',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'AG',
              )); ?>
          
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'round_box_chains/final_processes',
                'active' => ($controller=='orders') ? 'active' : '',
                'title' => 'Final Process',
              )); ?>
        </ul>
      </li>
      <li class="submenu submenu_js">
        <a href="javascript:void(0);" class="dropicon fa-chevron-right">
          <span class="icon">
            <i class="fal fa-handshake"></i>
          </span>
          <span>Milano Chain</span>
        </a>
        <ul>      
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'milano_chains/ags',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'AG',
              )); ?>
          
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'milano_chains/final_processes',
                'active' => ($controller=='orders') ? 'active' : '',
                'title' => 'Final Process',
              )); ?>
        </ul>
      </li>
      <li class="submenu submenu_js">
        <a href="javascript:void(0);" class="dropicon fa-chevron-right">
          <span class="icon">
            <i class="fal fa-handshake"></i>
          </span>
          <span>Sisma Chain</span>
        </a>
        <ul>      
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'AG',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/orders',
                'active' => ($controller=='orders') ? 'active' : '',
                'title' => 'Machine Process',
              )); ?>
          
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/orders',
                'active' => ($controller=='orders') ? 'active' : '',
                'title' => 'Final Process',
              )); ?>
        </ul>
      </li>
      <li class="submenu submenu_js">
        <a href="javascript:void(0);" class="dropicon fa-chevron-right">
          <span class="icon">
            <i class="fal fa-handshake"></i>
          </span>
          <span>Pipe Chain</span>
        </a>
        <ul>      
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'AG',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/orders',
                'active' => ($controller=='orders') ? 'active' : '',
                'title' => 'Hollow',
              )); ?>
          
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/orders',
                'active' => ($controller=='orders') ? 'active' : '',
                'title' => 'RBDC',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/orders',
                'active' => ($controller=='orders') ? 'active' : '',
                'title' => 'DC',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/orders',
                'active' => ($controller=='orders') ? 'active' : '',
                'title' => 'Lot Loss',
              )); ?>
        </ul>
      </li>
      <li class="submenu submenu_js">
        <a href="javascript:void(0);" class="dropicon fa-chevron-right">
          <span class="icon">
            <i class="fal fa-handshake"></i>
          </span>
          <span>HCL</span>
        </a>
        <ul>      
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'hcl/hcl_wastages',
                  'active' => ($controller=='carts') ? 'active' : '',
                  'title' => 'Wastages')); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'hcl/hcl_processes',
                  'active' => ($controller=='orders') ? 'active' : '',
                  'title' => 'Process')); ?>
          
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'hcl/hcl_melting_processes',
                  'active' => ($controller=='orders') ? 'active' : '',
                  'title' => 'Melting Process')); ?>        
        </ul>
      </li>
			<li>        
        <a href="<?= ADMIN_PATH.'ring_chains/ags' ?>">
          <span class="icon"><i class="fal fa-file-invoice-dollar"></i></span>
          <span class="hide-menu">Ring Chain</span>
        </a>
      </li>
      <li class="submenu submenu_js">
        <a href="javascript:void(0);" class="dropicon fa-chevron-right">
          <span class="icon">
            <i class="fal fa-handshake"></i>
          </span>
          <span>Office Outside</span>
        </a>
        <ul>      
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'office_outside/kdms',
                  'active' => ($controller=='carts') ? 'active' : '',
                  'title' => 'KDM',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'office_outside/hooks',
                  'active' => ($controller=='orders') ? 'active' : '',
                  'title' => 'Hook',
              )); ?>
        </ul>
      </li>
      <li class="submenu submenu_js">
        <a href="javascript:void(0);" class="dropicon fa-chevron-right">
          <span class="icon">
            <i class="fal fa-handshake"></i>
          </span>
          <span>Imp Italy</span>
        </a>
        <ul>      
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'imp_italy_chains/ags',
                  'active' => ($controller=='carts') ? 'active' : '',
                  'title' => 'AG',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'imp_italy_chains/ag_flattings',
                  'active' => ($controller=='orders') ? 'active' : '',
                  'title' => 'AG-Flatting',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'imp_italy_chains/pls',
                  'active' => ($controller=='orders') ? 'active' : '',
                  'title' => 'PL',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'imp_italy_chains/pl_flattings',
                  'active' => ($controller=='orders') ? 'active' : '',
                  'title' => 'PL-Flatting',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'imp_italy_chains/spring_lots',
                  'active' => ($controller=='orders') ? 'active' : '',
                  'title' => 'Spring Lots',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'imp_italy_chains/final_processes',
                  'active' => ($controller=='orders') ? 'active' : '',
                  'title' => 'Final Process',
              )); ?>
        </ul>
      </li>
      <li>        
        <a href="<?= ADMIN_PATH.'solitaires/solitaires' ?>">
          <span class="icon"><i class="fal fa-file-invoice-dollar"></i></span>
          <span class="hide-menu">Refresh</span>
        </a>
      </li>
      <li class="submenu submenu_js">
        <a href="javascript:void(0);" class="dropicon fa-chevron-right">
          <span class="icon">
            <i class="fal fa-handshake"></i>
          </span>
          <span>Daily Drawer</span>
        </a>
        <ul>      
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                  'active' => ($controller=='carts') ? 'active' : '',
                  'title' => 'Daily Drawer',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/orders',
                  'active' => ($controller=='orders') ? 'active' : '',
                  'title' => 'Process',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/orders',
                  'active' => ($controller=='orders') ? 'active' : '',
                  'title' => 'Melting Process',
              )); ?>          
        </ul>
      </li>
      <li>        
        <a href="<?= ADMIN_PATH.'settings/settings' ?>">
          <span class="icon"><i class="fal fa-file-invoice-dollar"></i></span>
          <span class="hide-menu">Process</span>
        </a>
      </li>
      <li>        
        <a href="<?= ADMIN_PATH.'settings/settings' ?>">
          <span class="icon"><i class="fal fa-file-invoice-dollar"></i></span>
          <span class="hide-menu">Spring Process</span>
        </a>
      </li>
      <li>        
        <a href="<?= ADMIN_PATH.'tounch_reports' ?>">
          <span class="icon"><i class="fal fa-file-invoice-dollar"></i></span>
          <span class="hide-menu">Tounch Report</span>
        </a>
      </li>
      <li>        
        <a href="<?= ADMIN_PATH.'settings/settings' ?>">
          <span class="icon"><i class="fal fa-file-invoice-dollar"></i></span>
          <span class="hide-menu">Loss Report</span>
        </a>
      </li>
      <li>        
        <a href="<?= ADMIN_PATH.'settings/settings' ?>">
          <span class="icon"><i class="fal fa-file-invoice-dollar"></i></span>
          <span class="hide-menu">Ghiss Tounch Melting</span>
        </a>
      </li>
      <li>        
        <a href="<?= ADMIN_PATH.'receipt_departments/receipt_departments' ?>">
          <span class="icon"><i class="fal fa-file-invoice-dollar"></i></span>
          <span class="hide-menu">Receipt Department</span>
        </a>
      </li>
      <li>        
        <a href="<?= ADMIN_PATH.'users/accounts' ?>">
          <span class="icon"><i class="fal fa-file-invoice-dollar"></i></span>
          <span class="hide-menu">Account Master</span>
        </a>
      </li>
      <li>        
        <a href="<?= ADMIN_PATH.'settings/settings' ?>">
          <span class="icon"><i class="fal fa-file-invoice-dollar"></i></span>
          <span class="hide-menu">GPC Out</span>
        </a>
      </li>
      <li class="submenu submenu_js">
        <a href="javascript:void(0);" class="dropicon fa-chevron-right">
          <span class="icon">
            <i class="fal fa-handshake"></i>
          </span>
          <span>Reports</span>
        </a>
        <ul>      
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'report_processes',
                  'active' => ($controller=='carts') ? 'active' : '',
                  'title' => 'Report Process')); ?>
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                  'active' => ($controller=='carts') ? 'active' : '',
                  'title' => 'Buffing Loss')); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                  'active' => ($controller=='carts') ? 'active' : '',
                  'title' => 'Fe In/Out Report')); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                  'active' => ($controller=='carts') ? 'active' : '',
                  'title' => 'Stock Report',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                  'active' => ($controller=='carts') ? 'active' : '',
                  'title' => 'Karigar Report',
              )); ?>
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                  'active' => ($controller=='carts') ? 'active' : '',
                  'title' => 'Loss Recovery',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                  'active' => ($controller=='carts') ? 'active' : '',
                  'title' => 'New Stock Report',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'stock_summary_reports',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'Stock Summary Report',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'Close Report',
              )); ?>          
        </ul>
      </li>
      <li class="submenu submenu_js">
        <a href="javascript:void(0);" class="dropicon fa-chevron-right">
          <span class="icon">
            <i class="fal fa-handshake"></i>
          </span>
          <span>Ghiss</span>
        </a>
        <ul>      
          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'Round Box Cutting Ghiss',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'Hand Cutting / Diamond Cutting Ghiss',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'Round Box Machine Ghiss',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'Sisma Ghiss',
              )); ?>

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'Filling Ghiss',
              )); ?> 

          <?php $this->load->view('layouts/application/navigation/menu_item', 
            array('url' => ADMIN_PATH.'transactions/carts',
                'active' => ($controller=='carts') ? 'active' : '',
                'title' => 'Ghiss Cutting Report',
              )); ?>                
        </ul>
      </li>
    </ul>		
	</div>
</aside>