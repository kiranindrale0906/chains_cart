<h6 class='blue text-uppercase bold mb-3'>Daily Process Dashboard</h6>
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
                                <td><?=$total_balance?></td>
                                <td><?=$total_balance_gross?></td>
                                <td><?=$total_balance_fine?></td>
                        </tr>
                </tbody>
        </table>
</div>  
<div class="row">
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_orange bdr_orange white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Day 1',
                        'card_decription_label'=>'Total Weight -',
                        'card_decription_value'=>isset($day_one_records['balance'])?four_decimal($day_one_records['balance']).' ('.$count['count_day_one'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/daily_process_reports?type=day_one_records&day=0'
                        ));
?>   
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_red bdr_red white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Day 2',
                        'card_decription_label'=>'Total Weight -',
                        'card_decription_value'=>isset($day_two_records['balance'])?four_decimal($day_two_records['balance']).' ('.$count['count_day_two'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/daily_process_reports?type=day_two_records&day=1'
                        ));
?>
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_blue bdr_blue white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Day 3',
                        'card_decription_label'=>'Total Weight -',
                        'card_decription_value'=>isset($day_three_records['balance'])?four_decimal($day_three_records['balance']).' ('.$count['count_day_three'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/daily_process_reports?type=day_three_records&day=2'
                        ));
?>
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Day 4',
                        'card_decription_label'=>'Total Weight -',
                        'card_decription_value'=>isset($day_four_records['balance'])?four_decimal($day_four_records['balance']).' ('.$count['count_day_four'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/daily_process_reports?type=day_four_records&day=3'
                        ));
?> 
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_green bdr_green white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Day 5',
                        'card_decription_label'=>'Total Weight -',
                        'card_decription_value'=>isset($day_five_records['balance'])?four_decimal($day_five_records['balance']).' ('.$count['count_day_five'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/daily_process_reports?type=day_five_records&day=5&day=4'
                        ));
?>  
<?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_pink bdr_pink white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Day 6',
                        'card_decription_label'=>'Total Weight -',
                        'card_decription_value'=>isset($day_six_records['balance'])?four_decimal($day_six_records['balance']).' ('.$count['count_day_six'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/daily_process_reports?type=day_six_records&day=5'
                        ));
?> <?php 

        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_red bdr_red white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Day 7',
                        'card_decription_label'=>'Total Weight -',
                        'card_decription_value'=>isset($day_seven_records['balance'])?four_decimal($day_seven_records['balance']).' ('.$count['count_day_seven'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/daily_process_reports?type=day_seven_records&day=6'
                        ));
?>
<?php 

        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_orange bdr_orange white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Overdue',
                        'card_decription_label'=>'Total Weight -',
                        'card_decription_value'=>isset($overdues['balance'])?four_decimal($overdues['balance']).' ('.$count['count_overdue'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/daily_process_reports?type=overdue&day=7'
                        ));
?>
 <?php 
        load_card(array('view'=>'layouts/application/dashboard/card',
                        'card_style'=>'bg_blue bdr_blue white',
                        'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                        'card_title'=> 'Finish Goods',
                        'card_decription_label'=>'Total Weight -',
                        'card_decription_value'=>isset($finish_goods['balance'])?four_decimal($finish_goods['balance']).' ('.$count['count_finish_good'].')':0,
                        'col'=>'col-lg-3 col-md-6',
                        'url'=>base_url().'reports/daily_process_reports?type=finish_good&day=0'
                        ));
?>   

</div>