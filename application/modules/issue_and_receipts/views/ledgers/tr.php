<tr>
  <td><?= $record['lot_no'];?></td>
  <td><?= $record['product_name'] ?></td>
  <?php if($this->router->fetch_module()=='reports' && ($this->router->class=='hallmark_ledgers')) { ?>
    <td class="text-right"><?= round($record['quantity']); ?></td>
    <td class="text-right"><?= ($record['design_code']); ?></td>
  
  <?php } if($this->router->fetch_module()=='issue_and_receipts' && ($this->router->class=='gpc_out_ledgers')) { ?>
    <td class="text-right"><?= four_decimal($record['issue_type']); ?></td>
  <?php } else { ?>
    <td><?= $record['issue_type'];?></td>
  <?php } ?>
  <?php if($this->router->class=='combine_loss_ledgers' && ($type=='issue' || $type=='receipt')){ ?>
  <td><?= $record['account_type'];?></td><?php }?>
  <?php if($this->router->fetch_module()=='reports' && ($this->router->class=='karigar_ledgers'||$this->router->class=='overall_loss_ledgers' ) && $type=='receipt'){ ?>
    <td class="text-right"><?= four_decimal($record['in_weight']) ?></td>
  <?php }?>
  <td class="text-right"><?= four_decimal($record['weight']) ?></td>
  <?php if($this->router->fetch_module()=='reports' && $this->router->class=='overall_loss_ledgers' && $type=='issue'){ ?>
  <td class="text-right"><?= four_decimal($record['out_weight']) ?></td>
  <?php }?>
  
  <?php if($this->router->fetch_module()=='reports' && $this->router->class=='karigar_ledgers' && $type=='issue'){ ?>
  <td class="text-right"><?= four_decimal($record['out_weight']) ?></td>
  <td class="text-right"><?= four_decimal($record['melting_wastage']) ?></td>
  <td class="text-right"><?= four_decimal($record['daily_drawer_wastage']) ?></td>
  <td class="text-right"><?= four_decimal($record['loss']) ?></td>
    <?php }?>
  <td class="text-right"><?= four_decimal($record['purity']); ?></td>
  <?php if($this->router->class=='loss_ledgers' && ($type=='issue' || $type=='receipt')){ ?>
  <td class="text-right"><?= four_decimal(@$record['gross']); ?></td>
  <?php }?>
  <td class="text-right"><?= four_decimal($record['fine']); ?></td>
  <?php if($this->router->fetch_module()=='issue_and_receipts' && ($this->router->class=='loss_ledgers') && ($type=='receipt' || $type=='issue')){ ?>
    <td class="text-right"><?= four_decimal($record['in_weight']) ?></td>
    <td class="text-right"><?= four_decimal($record['out_weight']) ?></td>
    <?php }?>
 <?php if($this->router->fetch_module()=='issue_and_receipts' && ($this->router->class=='fancy_out_ledgers') && ($type=='issue')){ ?>
    <td class="text-right"><?= four_decimal($record['wastage']) ?></td>
    <td class="text-right"><?= four_decimal($record['wastage_purity']) ?></td>
    <td class="text-right"><?= four_decimal($record['wastage_fine']) ?></td>
    <td class="text-right"><?= four_decimal($record['wastage_diff']) ?></td>
    <?php }?>
  <td><?= $record['created_at']; ?></td>
</tr>
