<?php 
	$value = $data['process'];
  if(isset($data['value']))
		load_card(fetch_card_view_array($data['process'], $data['value'], @$lot_no, @$record['in_lot_purity']));
	elseif(!empty("${$value}") && "${$value}"){
		$count = "${$value}";
		load_card(fetch_card_view_array($data['process'], $count, @$lot_no, @$record['in_lot_purity']));
	}
?>