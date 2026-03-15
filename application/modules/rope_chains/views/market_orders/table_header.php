<?php 
    load_buttons('anchor',
                array('name'=>'Ready Market orders',
                    'href'=>base_url()."rope_chains/market_orders?ready=1&&like[status]=Ready",
                    'class'=>'btn btn-sm btn_green mb-2 ml-2 float-right'
                )); 
    load_buttons('anchor',
                array('name'=>'order syncs',
                    'href'=>base_url()."rope_chains/order_syncs/create",
                    'class'=>'btn btn-sm btn_green mb-2 ml-2 float-right'
                )); 