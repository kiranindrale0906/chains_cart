<?= getHttpButton('CREATE NEW MELTING LOT', base_url().'melting_lots/melting_lots/create', 'float-right btn-success ml-5'); ?>
<?php $this->load->view('melting_lots/melting_lots/summary'); ?>
<hr>
<h6 class="heading blue bold text-uppercase mb-0">Melting Lot Details</h6>
<?php $this->load->view('melting_lots/sub_melting_lot_details/list'); ?>
<?php $this->load->view('melting_lots/melting_lots/alloy_details'); ?>

<?php //$this->load->view('melting_lots/melting_lots/melting_lot_designs'); ?>
<?php if(isset($order_detail_html)) {
  echo $order_detail_html;
  $processes_with_multi_orders = ['Imp Italy Chain', 'Indo tally Chain'];
  if(in_array($record['process_name'], $processes_with_multi_orders)) {
    if($record['process_name'] == 'Imp Italy Chain') $order_link = 'imp_italy_chains/imp_italy_chain_orders/';
    if($record['process_name'] == 'Indo tally Chain') $order_link = 'indo_tally_chains/indo_tally_chain_orders/';
    foreach($orders[0]['sibling_melting_lots'] as $sibling_melting_lot) { ?>
      <a class="btn btn-outline-primary btn-sm" title="Print" href="<?php echo base_url().'melting_lots/melting_lots/view/'.$sibling_melting_lot['melting_lot_id'].'?order_id='.$sibling_melting_lot['order_id'].'&action=print'; ?>"><i class="fas fa-print"></i>
        <?php if($record['id'] == $sibling_melting_lot['melting_lot_id']) {
          echo 'Print for this melting lot';
        } else {
          echo 'Print for order id: '.$sibling_melting_lot['order_id'];
        } ?>
      </a>
    <?php } ?>
    <a class="btn btn-outline-primary btn-sm" title="Print" href="<?php echo base_url().$order_link.'view/'.$orders[0]['sibling_melting_lots'][0]['order_id'].'?type=parent_order&action=print'; ?>"><i class="fas fa-print"></i> Print parent order</a>
    <?php if($record['process_name'] == 'Imp Italy Chain') { ?>
      <a class="btn btn-outline-primary btn-sm" title="Print" href="<?php echo base_url().$order_link.'view/'.$orders[0]['sibling_melting_lots'][0]['order_id'].'?type=parent_order_tarpata&action=print'; ?>"><i class="fas fa-print"></i> Print tarpata details</a>
    <?php } ?>
  <?php } else { ?>
    <a class="btn btn-outline-primary btn-sm" title="Print" href="?action=print"><i class="fas fa-print"></i> Print</a>
  <?php }} ?>
