<thead>
<?php //pd($type)?>
  <tr>
    <th>Lot No</th>
    <th>Product Name</th>
    <?php if ($this->router->fetch_module()=='reports' && $this->router->class=='hallmark_ledgers'){ ?>
        <th class="text-right">Quantity</th>
        <th class="text-right">Design Code</th>
    
    <?php }
      if($this->router->fetch_module()=='issue_and_receipts' && ($this->router->class=='gpc_out_ledgers')) { ?>
        <th class="text-right">In Weight</th>
      <?php } else { ?>
        <th>Issue Type</th>
      <?php } ?>
      <?php if($this->router->class=='combine_loss_ledgers' && ($type=='issue' || $type=='receipt')){ ?>
        <th>Account Type</th><?php }?>
    <?php 
      if ($this->router->fetch_module()=='reports' && ($this->router->class=='karigar_ledgers' || $this->router->class=='overall_loss_ledgers') && $type=='receipt'){ ?>
        <th class="text-right">IN Weight</th>
      <?php } 
    ?>
    <th class="text-right">Weight</th>
    <?php 
      if ($this->router->fetch_module()=='reports' && $this->router->class=='overall_loss_ledgers' && $type=='issue'){ ?>
        <th class="text-right">Out Weight</th>
    <?php }
      if ($this->router->fetch_module()=='reports' && $this->router->class=='karigar_ledgers' && $type=='issue'){ ?>
        <th class="text-right">Out Weight</th>
        <th class="text-right">Melting Wastage</th>
        <th class="text-right">Daily Drawer Wastage</th>
        <th class="text-right">Loss</th>
      <?php }
    ?>
    <th class="text-right">Purity</th>
    <?php 
      if ($this->router->class=='loss_ledgers' && ($type=='issue' || $type=='receipt')){ ?>
        <th class="text-right">Gross</th>
      <?php }
    ?>
    <th class="text-right">Fine</th>
    <?php 
      if($this->router->fetch_module()=='issue_and_receipts' && ($this->router->class=='loss_ledgers') && ($type=='receipt' || $type=='issue')) { ?>
        <th class="text-right">IN Weight</th>
        <th class="text-right">Out Weight</th>
      <?php }
    ?>
    <?php if($this->router->fetch_module()=='issue_and_receipts' && ($this->router->class=='fancy_out_ledgers') && ($type=='issue')){ ?>
        <th class="text-right">Wastage</th>
        <th class="text-right">Wastage Purity</th>
        <th class="text-right">Wastage Fine</th>
        <th class="text-right">Wastage Diff</th><?php }?>
 
    <th>Created At</th>
  </tr>
</thead>