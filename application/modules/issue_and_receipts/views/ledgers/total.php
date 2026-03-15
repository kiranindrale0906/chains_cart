<tr class="bold">
  <td><?= $label ?></td>
  <td></td>
  <td></td>
  <?php if( $this->router->fetch_module()=='reports' &&  $this->router->class=='hallmark_ledgers'){ ?>

  <td class="text-right"><?= four_decimal($quantity); ?></td>
  <td class="text-right"><?= four_decimal($design_code); ?></td>
  
   <?php } if($this->router->class=='combine_loss_ledgers' && ($type=='issue' || $type=='receipt')){ ?>
        <td></td><?php }?>
    
     <?php if($this->router->fetch_module()=='reports' && ($this->router->class=='karigar_ledgers'||$this->router->class=='overall_loss_ledgers') && $type=='receipt'){ ?>
  <td class="text-right"><?= four_decimal($in_weight); ?></td>
  <?php }?>
  <td class="text-right"><?= four_decimal($weight); ?></td>
  <?php if( $this->router->fetch_module()=='reports' &&  $this->router->class=='karigar_ledgers' && $type=='issue'){ ?>
  <td class="text-right"><?= four_decimal($out_weight) ?></td>
  <td class="text-right"><?= four_decimal($melting_wastage) ?></td>
  <td class="text-right"><?= four_decimal($daily_drawer_wastage) ?></td>
  <td class="text-right"><?= four_decimal($loss) ?></td>
    <?php }?>
    <?php if( $this->router->fetch_module()=='reports' &&  $this->router->class=='overall_loss_ledgers' && $type=='issue'){ ?>
  <td class="text-right"><?= four_decimal($out_weight) ?></td>
    <?php }?>
   
  <td></td>
  <?php if($this->router->class=='loss_ledgers' && ($type=='issue' || $type=='receipt')){ ?>
  <td class="text-right"><?= four_decimal(@$gross); ?></td>
  <?php } ?>
  
  <td class="text-right"><?= four_decimal($fine); ?></td>
  <?php if($this->router->fetch_module()=='issue_and_receipts' && ($this->router->class=='loss_ledgers') && ($type=='receipt' || $type=='issue')){ ?>
  <td class="text-right"><?= four_decimal($in_weight); ?></td>
  <td class="text-right"><?= four_decimal($out_weight) ?></td>
  <?php }?>
  <?php if($this->router->fetch_module()=='issue_and_receipts' && ($this->router->class=='fancy_out_ledgers') && ($type=='issue')){ ?>
    <td class="text-right"></td>
    <td class="text-right"></td>
    <td class="text-right"><?= four_decimal($wastage_fine) ?></td>
    <td class="text-right"><?= four_decimal($wastage_diff) ?></td>
    <?php }?>
 
  <td></td>
</tr>
