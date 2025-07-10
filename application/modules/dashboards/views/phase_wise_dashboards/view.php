
<h6 class='blue text-uppercase bold mb-3'>Phase Wise Dashboard</h6>
<hr> 
<div class="row" >
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_orange bdr_orange white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Phase 1 (Pre Gold)',
                        'card_decription_label'=>'',
                        'card_decription_value'=>isset($phase_1)?four_decimal($phase_1['weight']).'('.$phase_1['count'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=1&status='
                        ));
?>
<br>  
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'In Printing',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['In Printing']['weight'])?four_decimal($cards['In Printing']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['In Printing']['count'])?$cards['In Printing']['count']:0,
                        
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=1&status=In Printing'
                        ));
?>
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Tree Making',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards)?four_decimal($cards['Tree Ready']['weight']+$cards['Print OK']['weight']+$cards['Completed']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards)?four_decimal($cards['Tree Ready']['count']+$cards['Print OK']['count']+$cards['Completed']['count']):0,
                        
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=1&status=Tree Making'
                        
                        ));
?> 
</div>
<hr>

<div class="row" > 
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_orange bdr_orange white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Phase 2',
                        'card_decription_label'=>'',
                        'card_decription_value'=>isset($phase_2)?four_decimal($phase_2['weight']).'('.$phase_2['count'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        //'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=2&status='
                        ));
?> <br>
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'In Investment',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['In Investment']['weight'])?four_decimal($cards['In Investment']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['In Investment']['count'])?four_decimal($cards['In Investment']['count']):0,
                        
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=1&status=In Investment'
                        
                        ));
?>
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Melting',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['melting']['weight'])?four_decimal($cards['melting']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['melting']['count'])?four_decimal($cards['melting']['count']):0,
                        
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=2&department_name=melting'
                        ));
?> 
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Hardening',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['hardening']['weight'])?four_decimal($cards['hardening']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['hardening']['count'])?four_decimal($cards['hardening']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=2&department_name=hardening'
                        ));
?>  
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Casting',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['casting']['weight'])?four_decimal($cards['casting']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['casting']['count'])?four_decimal($cards['casting']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=2&department_name=casting'
                        ));
?>
</div>
<hr>
<div class="row">
 <?php 

        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_orange bdr_orange white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Phase 3',
                        'card_decription_label'=>'',
                        'card_decription_value'=>isset($phase_3)?four_decimal($phase_3['weight']).'('.$phase_3['count'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&status='
                        ));
?><br>
<?php 

        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Segregation',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['segregation']['weight'])?four_decimal($cards['segregation']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['segregation']['count'])?four_decimal($cards['segregation']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Segregation'
                        ));
?> <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Factory Hold',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['factory_hold']['weight'])?four_decimal($cards['factory_hold']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['factory_hold']['count'])?four_decimal($cards['factory_hold']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Factory Hold'
                        ));
?>   
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Grinding',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['grinding']['weight'])?four_decimal($cards['grinding']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['grinding']['count'])?four_decimal($cards['grinding']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Grinding'
                        ));
?>  
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Filing',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['filing']['weight'])?four_decimal($cards['filing']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['filing']['count'])?four_decimal($cards['filing']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Filing'
                        ));
?> <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Filing II',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['filing_ii']['weight'])?four_decimal($cards['filing_ii']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['filing_ii']['count'])?four_decimal($cards['filing_ii']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Filing II'
                        ));
?> <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Filing III',
                        'card_decription_value'=>isset($cards['filing_iii']['weight'])?four_decimal($cards['filing_iii']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['filing_iii']['count'])?four_decimal($cards['filing_iii']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Filing III'
                        ));
?>  <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Lock Filing',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['lock_filing']['weight'])?four_decimal($cards['lock_filing']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['lock_filing']['count'])?four_decimal($cards['lock_filing']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Lock Filing'
                         ));
?>  <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Magnet',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['magnet']['weight'])?four_decimal($cards['magnet']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['magnet']['count'])?four_decimal($cards['magnet']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Magnet'
                        ));
?>  <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Refiling',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['refiling']['weight'])?four_decimal($cards['refiling']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['refiling']['count'])?four_decimal($cards['refiling']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Refiling'));
?>  <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Refiling II',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['refiling_ii']['weight'])?four_decimal($cards['refiling_ii']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['refiling_ii']['count'])?four_decimal($cards['refiling_ii']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Refiling II'));

?>  <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Refiling III',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['refiling_iii']['weight'])?four_decimal($cards['refiling_iii']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['refiling_iii']['count'])?four_decimal($cards['refiling_iii']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Refiling III'));

?>  <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Stone Setting',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['stone_setting']['weight'])?four_decimal($cards['stone_setting']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['stone_setting']['count'])?four_decimal($cards['stone_setting']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Stone Setting'));

?>  <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Meena',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['meena']['weight'])?four_decimal($cards['meena']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['meena']['count'])?four_decimal($cards['meena']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Meena'));

?>  <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Meena Filing',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['meena_filing']['weight'])?four_decimal($cards['meena_filing']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['meena_filing']['count'])?four_decimal($cards['meena_filing']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Meena Filing'));

?>  <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Pasta',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['pasta']['weight'])?four_decimal($cards['pasta']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['pasta']['count'])?four_decimal($cards['pasta']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
			 'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=3&department_name=Pasta'));

?>  
</div><hr><div class="row">
 <?php 

        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_orange bdr_orange white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Phase 4',
                        'card_decription_label'=>'',
                        'card_decription_value'=>isset($phase_4)?four_decimal($phase_4['weight']).'('.$phase_4['count'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                       'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=4&status='
               ));
?>
<?php 

        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Correction',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['correction']['weight'])?four_decimal($cards['correction']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['correction']['count'])?four_decimal($cards['correction']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=4&department_name=Correction'));

?> <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Buffing',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['buffing']['weight'])?four_decimal($cards['buffing']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['buffing']['count'])?four_decimal($cards['buffing']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=4&department_name=Buffing'));

?>   
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Hand Cutting',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['hand_cutting']['weight'])?four_decimal($cards['hand_cutting']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['hand_cutting']['count'])?four_decimal($cards['hand_cutting']['count']):0,
                        
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=4&department_name=Hand Cutting'));


?>  
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Hand Dull',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['hand_dull']['weight'])?four_decimal($cards['hand_dull']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['hand_dull']['count'])?four_decimal($cards['hand_dull']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=4&department_name=Hand Dull'));
?> <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Hallmarking',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['hallmark_out']['weight'])?four_decimal($cards['hallmark_out']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['hallmark_out']['count'])?four_decimal($cards['hallmark_out']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=4&department_name=Hallmark Out'));
?> <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Buffing Refresh',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['buffing_refresh']['weight'])?four_decimal($cards['buffing_refresh']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['buffing_refresh']['count'])?four_decimal($cards['buffing_refresh']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=4&department_name=Buffing Refresh'));
?>  <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'GPC',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['gpc_rhodium']['weight'])?four_decimal($cards['gpc_rhodium']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['gpc_rhodium']['count'])?four_decimal($cards['gpc_rhodium']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=4&department_name=GPC Rhodium'));
?>  <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Packing',
                        'card_decription_label'=>'Total Weight',
                        'card_decription_value'=>isset($cards['packing']['weight'])?four_decimal($cards['packing']['weight']):0,
                        'card_decription_label_2'=>'Total Count',
                        'card_decription_value_2'=>isset($cards['packing']['count'])?four_decimal($cards['packing']['count']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/phase_wise_dashboard_reports?phase=4&department_name=Packing'));
?>
</div>
