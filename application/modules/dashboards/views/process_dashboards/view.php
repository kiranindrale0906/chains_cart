
<h6 class='blue text-uppercase bold mb-3'>Process Dashboard</h6>
<hr>
<div class="table-responsive col-sm-8">
        <table class="table table-sm table-default table-hover">
                <thead>
                        <th>Balance</th>
                        <th>Balance Gross</th>
                        <th>Balance Fine</th>
                </thead>
                <tbody>
                        <tr>
                                <td><?=$total_of_balance['balance']?></td>
                                <td><?=$total_of_balance['balance_gross']?></td>
                                <td><?=$total_of_balance['balance_fine']?></td>
                        </tr>
                </tbody>
        </table>
</div>  
<div class="row">
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_orange bdr_orange white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'CASTING',
                        'card_decription_label'=>'GW-',
                        'card_decription_value'=>isset($arc_chain_casting['balance'])?four_decimal($arc_chain_casting['balance']):0,
                        'card_decription_label_2'=>'FW-',
                        'card_decription_value_2'=>isset($arc_chain_casting['balance_fine'])?four_decimal($arc_chain_casting['balance_fine']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/process_wise_dashboards?type=arc_chain_casting'
                        ));
?>  

<?php 

        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_orange bdr_orange white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'DAILY DRAWER 75',
                        'card_decription_label'=>'GW-',
                        'card_decription_value'=>(isset($daily_drawer_75_in['balance'])||isset($daily_drawer_75_out['balance']))?four_decimal($daily_drawer_75_in['balance']-$daily_drawer_75_out['balance']):0,
                        'card_decription_label_2'=>'FW-',
                        'card_decription_value_2'=>isset($daily_drawer_75_in['balance_fine'])?four_decimal($daily_drawer_75_in['balance_fine']-$daily_drawer_75_out['balance_fine']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/process_wise_dashboards?type=daily_drawer_75'
                        ));
?> <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_blue bdr_blue white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'PURE METAL',
                        'card_decription_label'=>'GW-',
                        'card_decription_value'=>isset($pure_metal['balance'])?four_decimal($pure_metal['balance']):0,
                        'card_decription_label_2'=>'FW-',
                        'card_decription_value_2'=>isset($pure_metal['balance_fine'])?four_decimal($pure_metal['balance_fine']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/process_wise_dashboards?type=pure_metal'
                        ));
?>   
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'OTHER',
                        'card_decription_label'=>'GW-',
                        'card_decription_value'=>isset($other['balance'])?four_decimal($other['balance']):0,
                        'card_decription_label_2'=>'FW-',
                        'card_decription_value_2'=>isset($other['balance_fine'])?four_decimal($other['balance_fine']):0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/process_wise_dashboards?type=other'
                        ));
?>  

</div>