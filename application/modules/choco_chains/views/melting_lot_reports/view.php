<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th>Chain</th>
      <th>Lot No</th>
      <th>Date</th>
      <th class='text-right'>In Weight</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Choco Chain</td>
      <td><?= $melting_lot['lot_no'] ?></td>
      <td><?= $melting_lot['created_at'] ?></td>
      <td class='text-right'><?= four_decimal($melting_lot['gross_weight']); ?></td>
    </tr>
  </tbody>
</table>

<hr />
<h6><b>IN WEIGHT</b></h6>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th>Department Name</th>
      <th>Category</th>
      <th>Machine Size</th>
      <th>Design Code</th>
      <th class='text-right'>Hook</th>
      <th class='text-right'>Copper</th>
      <th class='text-right'>Solder</th>
      <th class='text-right'>Micro Coating</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($ins as $in) { ?>
      <tr>
        <td><?= $in['department_name'] ?></td>
        <td><?= $in['melting_lot_category_one'] ?></td>
        <td><?= $in['machine_size'] ?></td>
        <td><?= $in['design_code'] ?></td>
        <td class='text-right'><?= four_decimal($in['hook_in'], '-'); ?></td>
        <td class='text-right'><?= four_decimal($in['copper_in'], '-'); ?></td>
        <td class='text-right'><?= four_decimal($in['solder_in']+$in['alloy_weight'], '-'); ?></td>
        <td class='text-right'><?= four_decimal($in['micro_coating'], '-'); ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>


<hr />
<h6><b>OUT WEIGHT</b></h6>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th>Date</th>
      <th>Department Name</th>
      <th>Category</th>
      <th>Machine Size</th>
      <th>Design Code</th>
      <th class='text-right'>GPC Out</th>
      <th class='text-right'>Fancy Out</th>
      <th class='text-right'>Repair Out</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $gpc_out = $factory_out = $repair_out = 0;
      foreach($outs as $out) { 
        $gpc_out += $out['gpc_out'];
        $factory_out += $out['factory_out'];
        $repair_out += $out['repair_out'];
      ?>
      <tr>
        <td><?= remove_duplicates_in_string($out['created_at']); ?></td>
        <td><?= $out['department_name'] ?></td>
        <td><?= $out['melting_lot_category_one'] ?></td>
        <td><?= $out['machine_size'] ?></td>
        <td><?= $out['design_code'] ?></td>
        <?= $this->load->view('weight_field', array('weight' => $out['gpc_out'], 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
        <?= $this->load->view('weight_field', array('weight' => $out['factory_out'], 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
        <?= $this->load->view('weight_field', array('weight' => $out['repair_out'], 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
      </tr>
    <?php } ?>
    <tr>
      <th>Total</th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <?= $this->load->view('weight_field_total', array('weight' => $gpc_out, 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
      <?= $this->load->view('weight_field_total', array('weight' => $factory_out, 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
      <?= $this->load->view('weight_field_total', array('weight' => $repair_out, 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
    </tr>
  </tbody>
</table>

<hr />
<h6><b>WASTAGE WEIGHT</b></h6>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th>Department Name</th>
      <th>Category</th>
      <th>Machine Size</th>
      <th>Design Code</th>
      <th class='text-right'>Melting Wastage</th>
      <th class='text-right'>Daily Drawer Wastage</th>
      <th class='text-right'>HCL Wastage</th>
      <th class='text-right'>Tounch In</th>
      <th class='text-right'>Ghiss</th>
      <th class='text-right'>Loss</th>
      <th class='text-right'>Solder Wastage</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $melting_wastage = $daily_drawer_wastage =$hcl_wastage = $tounch_in = $ghiss = $loss = $solder_wastage = 0;
      foreach($wastages as $wastage) { 
        $melting_wastage += $wastage['melting_wastage']; 
        $daily_drawer_wastage += $wastage['daily_drawer_wastage']; 
        $hcl_wastage += $wastage['hcl_wastage']; 
        $tounch_in += $wastage['tounch_in']; 
        $ghiss += $wastage['ghiss']; 
        $loss += $wastage['loss']; 
        $solder_wastage += $wastage['solder_wastage'];
      ?>
      <tr>
        <td><?= $wastage['department_name'] ?></td>
        <td><?= $wastage['melting_lot_category_one'] ?></td>
        <td><?= $wastage['machine_size'] ?></td>
        <td><?= $wastage['design_code'] ?></td>
        <?= $this->load->view('weight_field', array('weight' => $wastage['melting_wastage'], 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
        <?= $this->load->view('weight_field', array('weight' => $wastage['daily_drawer_wastage'], 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
        <?= $this->load->view('weight_field', array('weight' => $wastage['hcl_wastage'], 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
        <?= $this->load->view('weight_field', array('weight' => $wastage['tounch_in']+$wastage['fire_tounch_in'], 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
        <?= $this->load->view('weight_field', array('weight' => $wastage['ghiss']+$wastage['pending_ghiss'], 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
        <?= $this->load->view('weight_field', array('weight' => $wastage['loss']+$wastage['pending_loss']+$wastage['karigar_loss'], 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
        <?= $this->load->view('weight_field', array('weight' => $wastage['solder_wastage'], 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
      </tr>
    <?php } ?>
    <tr>
      <th>Total</th>
      <th></th>
      <th></th>
      <th></th>
      <?= $this->load->view('weight_field_total', array('weight' => $melting_wastage, 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
      <?= $this->load->view('weight_field_total', array('weight' => $daily_drawer_wastage, 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
      <?= $this->load->view('weight_field_total', array('weight' => $hcl_wastage, 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
      <?= $this->load->view('weight_field_total', array('weight' => $tounch_in, 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
      <?= $this->load->view('weight_field_total', array('weight' => $ghiss, 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
      <?= $this->load->view('weight_field_total', array('weight' => $loss, 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
      <?= $this->load->view('weight_field_total', array('weight' => $solder_wastage, 'in_weight' => $melting_lot['gross_weight'] + $total_in_weight)); ?>
    </tr>
  </tbody>
</table>

<?= getHttpButton('Back', base_url().'choco_chains/melting_lot_reports/create/', 'float-right btn-success ml-5'); ?>

