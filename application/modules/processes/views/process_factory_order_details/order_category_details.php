<?php 
	load_field('label_with_value', array('field' => 'balance', 'value'=>four_decimal($balance)));
	load_field('label_with_value', array('field' => 'category_name', 'value' => @$ka_chain_factory_order_master['category_name']));
	load_field('label_with_value', array('field' => 'market_design_name', 'value' => @$ka_chain_factory_order_master['market_design_name']));
	load_field('label_with_value', array('field' => 'design_name', 'value' => @$ka_chain_factory_order_master['design_name']));
	load_field('label_with_value', array('field' => 'gauge', 'value' => @$ka_chain_factory_order_master['gauge']));
	load_field('label_with_value', array('field' => 'line', 'value' => @$ka_chain_factory_order_master['line']));
?>