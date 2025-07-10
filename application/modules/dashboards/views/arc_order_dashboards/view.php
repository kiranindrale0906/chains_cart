<h6 class='blue text-uppercase bold mb-3'>Arc Order Dashboard</h6>
<hr> 
<div class='row'>
<?php load_field('dropdown', array('field' => 'customer_name','option'=>$customer_name));  ?>
<?php load_field('dropdown', array('field' => 'order_no','option'=>$order_no));  ?>
</div>

<div class="row">
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_orange bdr_orange white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'APPROVAL PENDING ORDERS',
                        'card_decription_label'=>'Weight -',
                        'card_decription_value'=>isset($order_pending['weight'])?four_decimal($order_pending['weight']).' ('.$order_pending['quantity'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/arc_order_dashboard_reports?type=order_pending&order_no='.@$record['order_no'].'&customer_name='.@$record['customer_name']
                        ));
?>   
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_red bdr_red white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'LOT GENERATE PENDING',
                        'card_decription_label'=>'Weight -',
                        'card_decription_value'=>isset($generate_lot_pending['weight'])?four_decimal($generate_lot_pending['weight']).' ('.$generate_lot_pending['quantity'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/arc_order_dashboard_reports?type=generate_lot_pending&order_no='.@$record['order_no'].'&customer_name='.@$record['customer_name'],
                        ));
?>
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_blue bdr_blue white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'GENERATED LOTS',
                        'card_decription_label'=>'Weight -',
                        'card_decription_value'=>isset($generate_lot['weight'])?four_decimal($generate_lot['weight']).' ('.$generate_lot['quantity'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/arc_order_dashboard_reports?type=generate_lot&order_no='.@$record['order_no'].'&customer_name='.@$record['customer_name']
                        ));
?>
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'INVESTMENT PENDING LOTS',
                        'card_decription_label'=>'Weight -',
                        'card_decription_value'=>isset($investment_pending['weight'])?four_decimal($investment_pending['weight']).' ('.$investment_pending['quantity'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/arc_order_dashboard_reports?type=investment_pending&order_no='.@$record['order_no'].'&customer_name='.@$record['customer_name']
                        ));
?> 
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'TOTAL INVESTED LOTS',
                        'card_decription_label'=>'Weight -',
                        'card_decription_value'=>isset($investment_detail['weight'])?four_decimal($investment_detail['weight']).' ('.$investment_detail['quantity'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/arc_order_dashboard_reports?type=investment_detail&order_no='.@$record['order_no'].'&customer_name='.@$record['customer_name']
                        ));
?>  

 <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_blue bdr_blue white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'TOTAL ORDERS',
                        'card_decription_label'=>'Weight -',
                        'card_decription_value'=>isset($arc_order['weight'])?four_decimal($arc_order['weight']).' ('.$arc_order['quantity'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/arc_order_dashboard_reports?type=approval_order&order_no='.@$record['order_no'].'&customer_name='.@$record['customer_name']
                        ));
?>   
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_red bdr_red white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'TOTAL DISPATCH LOTS',
                        'card_decription_label'=>'Weight -',
                        'card_decription_value'=>isset($dispatch_detail['weight'])?four_decimal($dispatch_detail['weight']).' ('.$dispatch_detail['quantity'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/arc_order_dashboard_reports?type=dispatch_detail&order_no='.@$record['order_no'].'&customer_name='.@$record['customer_name']
                        ));
?>
</div>