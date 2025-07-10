<div class="boxrow mb-2">
  <div class="float-left">
    <?php $page_details = @getTableSettings();?>
    <h6 class="heading blue bold text-uppercase mb-0">
      <?= @$page_details['page_title']; ?>
    </h6>
  </div>
</div>
<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th>Serial No.</th>
      <th>Name</th>
      <th>In</th>
      <th>Out</th>      
      <th>Balance</th>
      <th>Difference</th>
    </tr>
  </thead>
  
  <tbody> 
    <?php foreach($record as $data_key => $data_value){
      ?>
      <tr>
        <td><?= $data_value['serial_no']?></td>
        <td><?= $data_key; ?></td>
        <td><?= round($data_value['in_balance'],4);?></td>
        <td><?= round($data_value['out_balance'],4);?></td>
        <td><?= round($data_value['balance'],4); ?></td>
        <td><?= round($data_value['diff'],4); ?></td>
      </tr>
    <?php }?> 
  </tbody>
</table>


<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th>Name</th>
    </tr>
  </thead>
  
  <tbody> 
    <tr>
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/compute_alloy_details_for_all_melting_lots">Compute Alloy Details Of All Melting Lots</a></td>
    </tr>

    <tr>
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/daily_drawer_melting_process">Daily Drawer Melting Process</a></td>
    </tr>
    <tr>
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/hcl_melting_process">HCL Melting Process</a></td>
    </tr>
    <tr>
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/strip_cutting_out_purity">Strip Cutting Out Purity</a></td>
    </tr>
    <tr>
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/expected_out_hcl_loss_hcl_fine_loss">HCL Loss</a></td>
    </tr>
    <tr>
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/tounch_out_melting_process">Tounch Out Melting Process</a></td>
    </tr>
    <tr>
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/tounch_fine">Tounch Fine</a></td>
    </tr>
    <tr>
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/ghiss_out_melting_process">Ghiss Melting Process</a></td>
    </tr>
    <tr>
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/hcl_ghiss_out_melting_process">HCL Ghiss Melting Process</a></td>
    </tr>
    <tr>
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/loss_out_melting_process">Loss Out Melting Process</a></td>
    </tr>
    <tr>
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/solder_wastage_out_melting_process">Solder Wastage Out Melting Process</a></td>
    </tr>
    <tr>
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/issue_department">Issue Department</a></td>
    </tr>
    <tr> 
      <td><?= base_url() ?>system_checks/system_fixes/index/chain_process?product_name=&process_name=&department_name</td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Indo tally Chain',
                           'process_name' => 'AG',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Indo Tally Chain AG Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Indo tally Chain',
                           'process_name' => 'AG Flatting',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Indo Tally Chain AG Flatting Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Indo tally Chain',
                           'process_name' => 'AU FE Process',
                           'department_name' => 'AU%2BFE'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Indo Tally Chain AU FE Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Indo tally Chain',
                           'process_name' => 'PL',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Indo Tally Chain PL Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Indo tally Chain',
                           'process_name' => 'PL Flatting',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Indo Tally Chain PL Flatting Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Indo tally Chain',
                           'process_name' => 'Buffing Process',
                           'department_name' => 'Buffing'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Indo Tally Chain Buffing Process</a>
      </td>
    </tr>
    <tr> 
      <td><a href="<?= base_url() ?>system_checks/system_fixes/index/update_indo_tally_chain_spring_process_start_department_records">Update Indo Tally Chain Spring Process Start Department Records</a></td>
    </tr>
    
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Indo tally Chain',
                           'process_name' => 'Spring Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Indo Tally Chain Spring Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Indo tally Chain',
                           'process_name' => 'Chain Making Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Indo Tally Chain Chain Making Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Indo tally Chain',
                           'process_name' => 'Final Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Indo Tally Chain Final Process</a>
      </td>
    </tr>
    <tr>
      <td>HOLLOW CHOCO CHAIN</td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Hollow Choco Chain',
                           'process_name' => 'PL',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Hollow Choco Chain PL Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Hollow Choco Chain',
                           'process_name' => 'PL Flatting',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Hollow Choco Chain PL Flatting Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Hollow Choco Chain',
                           'process_name' => 'PL Buffing Process',
                           'department_name' => 'PL Buffing'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Hollow Choco Chain Buffing Process</a>
      </td>
    </tr>
    
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Hollow Choco Chain',
                           'process_name' => 'Spring Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Hollow Choco Chain Spring Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Hollow Choco Chain',
                           'process_name' => 'Chain Making Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Hollow Choco Chain Making Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Hollow Choco Chain',
                           'process_name' => 'Final Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Hollow Choco Chain Final Process</a>
      </td>
    </tr>
    <tr>
      <td>IMP ITALY CHAIN</td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Imp Italy Chain',
                           'process_name' => 'AG',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Imp Italy Chain AG Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Imp Italy Chain',
                           'process_name' => 'AG Flatting',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Imp Italy Chain AG Flatting Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Imp Italy Chain',
                           'process_name' => 'AU FE Process',
                           'department_name' => 'AU%2BFE'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Imp Italy Chain AU FE Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Imp Italy Chain',
                           'process_name' => 'Spring Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Imp Italy Chain Spring Process</a>
      </td>
    </tr>
    <tr>
      <td>
        <?php 
          $process = array('product_name' => 'Imp Italy Chain',
                           'process_name' => 'Chain Making Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Imp Italy Chain Making Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Imp Italy Chain',
                           'process_name' => 'Final Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Imp Italy Chain Final Process</a>
      </td>
    </tr>
    <tr>
    <td>ROPE CHAIN</td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Rope Chain',
                           'process_name' => 'AG',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Rope Chain AG Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Rope Chain',
                           'process_name' => 'AG Flatting',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Rope Chain AG Flatting Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Rope Chain',
                           'process_name' => 'AU FE Process',
                           'department_name' => 'AU%2BFE'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Rope Chain AU FE, Machine and Final Process</a>
      </td>
    </tr>
    
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Rope Chain',
                           'process_name' => 'Machine Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Rope Chain Machine and Final Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Rope Chain',
                           'process_name' => 'Final Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Rope Chain Final Process</a>
      </td>
    </tr>
    <td>MACHINE CHAIN</td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Machine Chain',
                           'process_name' => 'AG',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Rope Chain AG Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Machine Chain',
                           'process_name' => 'AU FE Process',
                           'department_name' => 'AU%2BFE'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Machine Chain AU FE Process</a>
      </td>
    </tr>
    
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Machine Chain',
                           'process_name' => 'Machine Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Machine Chain Machine and Final Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Machine Chain',
                           'process_name' => 'Final Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Machine Chain Final Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Machine Chain',
                           'process_name' => 'Rolex Final Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Machine Chain Rolex Final Process</a>
      </td>
    </tr>
    <td>CHOCO CHAIN</td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Choco Chain',
                           'process_name' => 'AG',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Choco Chain AG Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Choco Chain',
                           'process_name' => 'Machine Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Choco Chain Chain Making Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Choco Chain',
                           'process_name' => 'Final Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Choco Chain Final Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Choco Chain',
                           'process_name' => 'Imp Final Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Choco Chain Imp Final Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Choco Chain',
                           'process_name' => 'RND Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Choco Chain RND Process</a>
      </td>
    </tr>
    <td>ROUND BOX CHAIN</td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Round Box Chain',
                           'process_name' => 'AG',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Round Box Chain AG Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Round Box Chain',
                           'process_name' => 'Final Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Round Box Chain Final Process</a>
      </td>
    </tr>
    <td>SISMA Chain</td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Sisma Chain',
                           'process_name' => 'AG',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Sisma Chain AG Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Sisma Chain',
                           'process_name' => 'Sisma Machine Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Sisma Chain Machine Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Sisma Chain',
                           'process_name' => 'Karigar Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Sisma Chain Karigar Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Sisma Chain',
                           'process_name' => 'RND Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Sisma Chain RND Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Sisma Chain',
                           'process_name' => 'Final Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Sisma Chain Final Process</a>
      </td>
    </tr>
    <td>KA Chain</td>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'KA Chain',
                           'process_name' => 'Start Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">KA Chain Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'KA Chain',
                           'process_name' => 'Box Chain Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">KA Chain Box Chain Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'KA Chain',
                           'process_name' => 'Vishnu Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">KA Chain Vishnu Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'KA Chain',
                           'process_name' => 'Laser Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">KA Chain Laser Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'KA Chain',
                           'process_name' => 'Hammering Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">KA Chain Hammering Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'KA Chain',
                           'process_name' => 'Ashish Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">KA Chain Ashish Process</a>
      </td>
    </tr>
    <td>Fancy Chain</td>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Fancy Chain',
                           'process_name' => 'Chain Making Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Fancy Chain Chain Making Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Fancy Chain',
                           'process_name' => 'Final Process',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Fancy Chain Final Process</a>
      </td>
    </tr>
    <td>ARC</td>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'ARC',
                           'process_name' => 'ARC',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">ARC Process</a>
      </td>
    </tr>
    <td>Refresh</td>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Refresh',
                           'process_name' => 'Refresh',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Refresh Process</a>
      </td>
    </tr>
    <td>Office Outside</td>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'KDM',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside KDM Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'Hook',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside Hook Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'Lobster',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside Lobster Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'Ball',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside Ball Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'Cutting Wire',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside Cutting Wire Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'Cutting Pipe',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside Cutting Pipe Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'Solid Pipe',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside Solid Pipe Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'Hollow Pipe',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside Hollow Pipe Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'Solid Wire',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside Solid Wire Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'Hard Wire',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside Hard Wire Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'Shook',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside S Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'ARF KDM',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside ARF KDM Process</a>
      </td>
    </tr>
    <tr> 
      <td>
        <?php 
          $process = array('product_name' => 'Office Outside',
                           'process_name' => 'Cap',
                           'department_name' => 'Start'); 
          $url = base_url().'system_checks/system_fixes/index/chain_process?product_name='.$process['product_name'].'&process_name='.$process['process_name'].'&department_name='.$process['department_name']; ?>
        <a href="<?= $url ?>">Office Outside CAP Process</a>
      </td>
    </tr>
  </tbody>
</table>