<h5> Select Period: 
  <a class="ml-5 <?= ($period=='date') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=date&wastage=<?=$wastage?>&product=<?=$product?>&purity=<?=$purity?>&machine_size=<?=$machine_size?>'>Date</a>
  <a class="ml-5 <?= ($period=='week') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=week&wastage=<?=$wastage?>&product=<?=$product?>&purity=<?=$purity?>&machine_size=<?=$machine_size?>'>Week</a>
  <a class="ml-5 <?= ($period=='month') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=month&wastage=<?=$wastage?>&product=<?=$product?>&purity=<?=$purity?>&machine_size=<?=$machine_size?>'>Month</a>
  <a class="ml-5 <?= ($period=='year') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=year&wastage=<?=$wastage?>&product=<?=$product?>&purity=<?=$purity?>&machine_size=<?=$machine_size?>'>Year</a>
</h5>
<h5> Select Wastage: 
	<a class="ml-5 <?= ($wastage=='') ? 'bold black underline' : '' ?>" href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=<?=$period ?>&wastage=&product=<?=$product?>&purity=<?=$purity?>&machine_size=<?=$machine_size?>'>All</a>
<?php 
  foreach ($wastages as $index => $value) {
?>
  <a class="ml-5 <?= ($wastage==$value) ? 'bold black underline' : '' ?>" href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=<?=$period ?>&wastage=<?=$value?>&product=<?=$product?>&purity=<?=$purity?>&machine_size=<?=$machine_size?>'><?=$value?></a>
<?php }
?>
</h5>
<h5> Select Product: 
  <a class="ml-5 <?= ($product=='') ? 'bold black underline' : '' ?>" href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=<?=$period ?>&wastage=<?=$wastage?>&product=&purity=<?=$purity?>&machine_size=<?=$machine_size?>'>All</a>
  <a class="ml-5 <?= ($product=='ka_chain') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=<?=$period ?>&wastage=<?=$wastage?>&product=ka_chain&purity=<?=$purity?>&machine_size=<?=$machine_size?>'>KA Chain</a>
  <a class="ml-5 <?= ($product=='ball_chain') ? 'bold black underline' : '' ?>" 
     href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=<?=$period ?>&wastage=<?=$wastage?>&product=ball_chain&purity=<?=$purity?>&machine_size=<?=$machine_size?>'>Ball Chain</a>
</h5>
<h5> Select Purity: 
  <a class="ml-5 <?= ($purity=='') ? 'bold black underline' : '' ?>" href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=<?=$period ?>&wastage=<?=$wastage?>&product=<?=$product ?>&purity=&machine_size=<?=$machine_size?>'>All</a>
  <?php 
  foreach ($purities as $index => $value) {
  ?>
  <a class="ml-5 <?= ($purity==$value['out_lot_purity']) ? 'bold black underline' : '' ?>" href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=<?=$period ?>&wastage=<?=$wastage?>&product=<?=$product?>&purity=<?=$value['out_lot_purity']?>&machine_size=<?=$machine_size?>'><?=$value['out_lot_purity']?></a>
<?php }
?>
</h5>
<h5> Select Machine Size: 
  <a class="ml-5 <?= ($machine_size=='') ? 'bold black underline' : '' ?>" href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=<?=$period ?>&wastage=&product=<?=$product?>&purity=<?=$purity?>&machine_size='>All</a>
<?php 
  foreach ($machine_sizes as $index => $value) {
?>
  <a class="ml-5 <?= ($machine_size==$value['machine_size']) ? 'bold black underline' : '' ?>" href='<?= base_url().'issue_and_receipts/fancy_out_ledgers/create' ?>?period=<?=$period ?>&wastage=<?=$wastage?>&product=<?=$product?>&purity=<?=$purity?>&machine_size=<?=$value['machine_size']?>'><?=$value['machine_size']?></a>
<?php }
?>
</h5>
<?php $this->load->view('issue_and_receipts/ledgers/form'); ?>