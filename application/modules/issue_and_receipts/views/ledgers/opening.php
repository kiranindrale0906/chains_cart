<tr>
  <td>Opening</td>
  <td></td>
  <td></td>
   <?php if($this->router->class=='combine_loss_ledgers' && ($type=='issue' || $type=='receipt')){ ?>
        <td></td><?php }?>
    
  <td></td>
  <td class="text-right"><?= four_decimal($opening_weight); ?></td>
  <td></td>
  <?php if($this->router->class=='loss_ledgers' && ($type=='issue' || $type=='receipt')){ ?>
  <td></td>
  <?php }?>
  <?php if($this->router->fetch_module()=='issue_and_receipts' && ($this->router->class=='fancy_out_ledgers') && ($type=='issue')){ ?>
    <td class="text-right"></td>
    <td class="text-right"></td>
    <td class="text-right"></td>
    <td class="text-right"></td>
    <?php }?>
  <td class="text-right"><?= four_decimal($opening_fine); ?></td>
  <td></td>
</tr>