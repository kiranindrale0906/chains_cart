<?php

function office_outside_checks() {
  return array(
               oo2(), 
               oo3a(), oo3b(), oo3c(),
               oo4a(), oo4b(),
               oo5a(), oo5b(), oo5c(), oo5d(), oo5e(),
               oo5a(), oo5b(), oo5c(),
               oo6a(), oo6b(), oo6c(),
               oo7a(), oo7b(), oo7c(),
               oo8a(), oo8b(), oo8c(),
               oo9a(), oo9b(), oo9c());
}



//////START - TOTAL OFFICE OUTSIDE BALANCE
function oo2() {
  /* select id, hook_out from process_details where hook_out < 0; */
  return array('srno'  => 'OO2',
               'title' => 'Office outside balance check in process_details and processes',
               'A'     => 'select sum(daily_drawer_in_weight - daily_drawer_out_weight - hook_in + hook_out) as weight from processes',
               'C'     => 'select sum(daily_drawer_in_weight - daily_drawer_out_weight - hook_in + hook_out) as weight from process_details');
}
//////END - TOTAL OFFICE OUTSIDE BALANCE


//////START - KARIGAR CHECK
function oo3a() {
  /* select id, daily_drawer_in_weight, hook_in, hook_out, daily_drawer_out_weight 
            from processes 
            where (karigar = "" or karigar is null) 
                  and (daily_drawer_in_weight !=0 or hook_in != 0 or hook_out != 0 or daily_drawer_out_weight != 0); */
  return array('srno'  => 'OO3A',
               'title' => 'Check processes where karigar is not set',
               'A'     => 'select count(*) as weight from processes where (karigar = "" or karigar is null) and (daily_drawer_in_weight !=0 or hook_in != 0 or hook_out != 0 or daily_drawer_out_weight != 0)',
               'query' =>'select id,process_name,product_name,department_name, daily_drawer_in_weight, hook_in, hook_out, daily_drawer_out_weight, id as url 
                          from processes 
                          where (karigar = "" or karigar is null) 
                          and (daily_drawer_in_weight !=0 or hook_in != 0 or hook_out != 0 or daily_drawer_out_weight != 0)');
}

function oo3b() {
  /* select id, process_id, daily_drawer_in_weight, hook_in, hook_out, daily_drawer_out_weight 
            from process_details 
            where (karigar = "" or karigar is null) 
                  and (daily_drawer_in_weight !=0 or hook_in != 0 or hook_out != 0 or daily_drawer_out_weight != 0); */
  return array('srno'  => 'OO3B',
               'title' => 'Check process details where karigar is not set',
               'A'     => 'select sum(process_details.daily_drawer_in_weight + process_details.hook_in + process_details.hook_out + process_details.daily_drawer_out_weight) as weight from process_details where (karigar = "" or karigar is null) and (daily_drawer_in_weight !=0 or hook_in != 0 or hook_out != 0 or daily_drawer_out_weight != 0)',
               'query' => 'select process_details.id, process_details.process_id, process_details.daily_drawer_in_weight, process_details.hook_in, 
                            process_details.hook_out, process_details.daily_drawer_out_weight,processes.process_name,processes.product_name,
                            processes.department_name, process_details.process_id as url 
                            from process_details 
                            inner join processes on processes.id = process_details.process_id 
                            where (process_details.karigar = "" or process_details.karigar is null) 
                            and (process_details.daily_drawer_in_weight !=0 or process_details.hook_in != 0 or process_details.hook_out != 0 or process_details.daily_drawer_out_weight != 0)');
}

function oo3c() {
  /* select process_id, processes.karigar, process_details.karigar 
            from process_details 
            inner join processes on processes.id = process_details.process_id 
            where processes.karigar != process_details.karigar 
                  and (process_details.daily_drawer_in_weight !=0 or process_details.hook_in != 0 or process_details.hook_out !=0  or process_details.daily_drawer_out_weight != 0) */
  return array('srno'  => 'OO3C',
               'title' => 'check mismatch in karigar in processes and process_details',
               'A'     => 'select sum(process_details.daily_drawer_in_weight + process_details.hook_in + process_details.hook_out + process_details.daily_drawer_out_weight) as weight from process_details inner join processes on processes.id = process_details.process_id where processes.karigar != process_details.karigar and (process_details.daily_drawer_in_weight !=0 or process_details.hook_in != 0 or process_details.hook_out !=0  or process_details.daily_drawer_out_weight != 0)',
               'query' => 'select process_id,processes.process_name,processes.product_name,processes.department_name, processes.karigar, process_details.karigar, process_details.process_id as url 
                            from process_details 
                            inner join processes on processes.id = process_details.process_id 
                            where processes.karigar != process_details.karigar 
                            and (process_details.daily_drawer_in_weight !=0 or process_details.hook_in != 0 or process_details.hook_out !=0  or process_details.daily_drawer_out_weight != 0)');
}
//////END - KARIGAR CHECK


//////START - DAILY DRAWER TYPE CHECK
function oo4a() {
  /* select id from processes where daily_drawer_in_weight != 0 and (process_name = "" or process_name is null); */
  return array('srno'  => 'OO4A',
               'title' => 'Daily drawer type check in processes',
               'A'     => 'select count(*) as weight from processes where daily_drawer_in_weight != 0 and (process_name = "" or process_name is null);');
}

function oo4b() {
  /* select process_id, daily_drawer_in_weight, hook_in, hook_out, daily_drawer_out_weight
            from process_details 
            where (daily_drawer_type = "" or daily_drawer_type is null) and 
                  (daily_drawer_in_weight != 0 or hook_in != 0 or hook_out != 0 or daily_drawer_out_weight != 0); */
  return array('srno'  => 'OO4B',
               'title' => 'Daily drawer type check in process details',
               'A'     => 'select sum(daily_drawer_in_weight + hook_in + hook_out + daily_drawer_out_weight) as weight from process_details where (daily_drawer_type = "" or daily_drawer_type is null) and (daily_drawer_in_weight != 0 or hook_in != 0 or hook_out != 0 or daily_drawer_out_weight != 0)');
}
//////END - DAILY DRAWER TYPE CHECK


//////START - HOOK KDM PURITY CHECK
function oo5a() {
  /* select id, daily_drawer_in_weight, hook_in, hook_out, daily_drawer_out_weight 
            from processes 
            where (hook_kdm_purity = 0 or hook_kdm_purity is null) 
                   and (daily_drawer_in_weight !=0 or hook_in != 0 or hook_out != 0 or daily_drawer_out_weight != 0); */
  return array('srno'  => 'OO5A',
               'title' => 'Check processes where hook_kdm_purity is 0',
               'A'     => 'select count(*) as weight from processes where (hook_kdm_purity = 0 or hook_kdm_purity is null) and (daily_drawer_in_weight !=0 or hook_in != 0 or hook_out != 0 or daily_drawer_out_weight != 0)');
}

function oo5b() {
  /* select process_details.process_id, process_details.daily_drawer_in_weight, process_details.hook_in, process_details.hook_out, process_details.daily_drawer_out_weight from process_details where (hook_kdm_purity = 0) and (daily_drawer_in_weight != 0 or hook_in != 0 or hook_out != 0 or daily_drawer_out_weight != 0) */
  return array('srno'  => 'OO5B',
               'title' => 'Check process details where hook_kdm_purity is 0',
               'A'     => 'select sum(process_details.daily_drawer_in_weight + process_details.hook_in + process_details.hook_out + process_details.daily_drawer_out_weight) as weight from process_details where (hook_kdm_purity = 0) and (daily_drawer_in_weight != 0 or hook_in != 0 or hook_out != 0 or daily_drawer_out_weight != 0)');
}

function oo5c() {
  /* select process_id, processes.hook_kdm_purity, process_details.hook_kdm_purity 
            from process_details 
            inner join processes on processes.id = process_details.process_id 
            where processes.hook_kdm_purity != process_details.hook_kdm_purity 
                  and (process_details.hook_in != 0 or process_details.hook_out !=0  or process_details.daily_drawer_out_weight != 0  or process_details.daily_drawer_in_weight != 0); */
  return array('srno'  => 'OO5C',
               'title' => 'Check mismatch in hook_kdm_purity in processes and process_details',
               'A'     => 'select sum(process_details.daily_drawer_in_weight + process_details.hook_in + process_details.hook_out + process_details.daily_drawer_out_weight) as weight from process_details inner join processes on processes.id = process_details.process_id where processes.hook_kdm_purity != process_details.hook_kdm_purity and (process_details.daily_drawer_in_weight != 0 or process_details.hook_in != 0 or process_details.hook_out !=0  or process_details.daily_drawer_out_weight != 0)');
}

function oo5d() {
  /* select process_id, processes.hook_kdm_purity, process_details.hook_kdm_purity 
            from process_details 
            inner join processes on processes.id = process_details.process_id 
            where processes.in_lot_purity < process_details.hook_kdm_purity - 3 
                  and processes.in_lot_purity > process_details.hook_kdm_purity + 3 
                  and (process_details.daily_drawer_in_weight != 0 or process_details.hook_in != 0 or process_details.hook_out !=0 or process_details.daily_drawer_out_weight != 0); */
  return array('srno'  => 'OO5D',
               'title' => 'Check process details where hook_kdm_purity is 0',
               'A'     => 'select count(*) as weight from process_details inner join processes on processes.id = process_details.process_id where processes.in_lot_purity < process_details.hook_kdm_purity - 3 and processes.in_lot_purity > process_details.hook_kdm_purity + 3 and (process_details.daily_drawer_in_weight != 0 or process_details.hook_in != 0 or process_details.hook_out !=0  or process_details.daily_drawer_out_weight != 0)');
}

function oo5e() {
  /* select id, product_name, process_name, department_name, in_lot_purity, hook_kdm_purity 
     from processes 
     where not (in_lot_purity > hook_kdm_purity - 2 and in_lot_purity < hook_kdm_purity + 2)
                and (hook_in !=0 or hook_out !=0 or daily_drawer_in_weight !=0 or daily_drawer_out_weight != 0);
  */
  return array('srno'  => 'OO5E',
               'title' => 'Mismatch in hook kdm purity and in lot purity',
               'A'     => 'select count(*) as weight from processes where not (in_lot_purity > hook_kdm_purity - 2 and in_lot_purity < hook_kdm_purity + 2) and (hook_in !=0 or hook_out !=0 or daily_drawer_in_weight !=0 or daily_drawer_out_weight != 0)');              
}
//////END - HOOK KDM PURITY CHECK


//////START - DAILY DRAWER IN WEIGHT CHECK
function oo6a() {
  /* select processes.id, sum(process_details.daily_drawer_in_weight) as pd_value, processes.daily_drawer_in_weight as p_value 
            from process_details 
            inner join processes on process_details.process_id = processes.id 
            where process_details.daily_drawer_in_weight!= 0 
            group by processes.id having pd_value != p_value; */
  return array('srno'  => 'OO6A',
               'title' => 'Daily drawer in weight check in processes and process_details',
               'A'     => 'select sum(daily_drawer_in_weight) as weight from processes;',
               'C'     => 'select sum(daily_drawer_in_weight) as weight from process_details',
               'query' => 'select processes.id as url, processes.product_name as product_name, processes.process_name as process_name, processes.department_name as department_name, 
                                  sum(process_details.daily_drawer_in_weight) as process_details_value, processes.daily_drawer_in_weight as process_value 
                                  from process_details 
                                  inner join processes on process_details.process_id = processes.id 
                                  where process_details.daily_drawer_in_weight!= 0 
                                  group by processes.id having process_details_value != process_value;');
}

function oo6b() {
  /* select processes.id, processes.karigar, processes.hook_kdm_purity, processes.daily_drawer_in_weight, processes.created_at 
            from processes 
            where id not in (select process_id from process_details where daily_drawer_in_weight != 0) 
                  and daily_drawer_in_weight != 0; */
  return array('srno'  => 'OO6B',
               'title' => 'Check missing process_details records for daily_drawer_in_weight',
               'A'     => 'select sum(processes.daily_drawer_in_weight) as weight from processes where id not in (select process_id from process_details where daily_drawer_in_weight != 0) and daily_drawer_in_weight != 0');
}

function oo6c() {
  /* select id, process_id 
            from process_details 
            where daily_drawer_in_weight != 0 and process_id not in (select id from processes where daily_drawer_in_weight != 0); */
  return array('srno'  => 'OO6C',
               'title' => 'check process_detail records for deleted processes',
               'A'     => 'select count(*) as weight from process_details where daily_drawer_in_weight != 0 and process_id not in (select id from processes where daily_drawer_in_weight != 0)');
}
//////END - DAILY DRAWER IN WEIGHT CHECK


//////START - HOOK IN WEIGHT CHECK
function oo7a() {
  /* select processes.id, sum(process_details.hook_in) as pd_value, processes.hook_in as p_value 
            from process_details 
            inner join processes on process_details.process_id = processes.id 
            where process_details.hook_in!= 0 
            group by processes.id having pd_value != p_value; */
  return array('srno'  => 'OO7A',
               'title' => 'Hook in weight check in processes and process_details',
               'A'     => 'select sum(hook_in) as weight from processes;',
               'C'     => 'select sum(hook_in) as weight from process_details');
}

function oo7b() {
  /* select processes.id, processes.karigar, processes.hook_kdm_purity, processes.hook_in, processes.created_at 
            from processes 
            where id not in (select process_id from process_details where hook_in != 0) 
                  and hook_in != 0; */
  return array('srno'  => 'OO7B',
               'title' => 'Check missing process_details records for hook in',
               'A'     => 'select count(*) as weight from processes where id not in (select process_id from process_details where hook_in != 0) and hook_in != 0');
}

function oo7c() {
  /* select id, process_id 
            from process_details 
            where hook_in != 0 and process_id not in (select id from processes where hook_in != 0); */
  return array('srno'  => 'OO7C',
               'title' => 'check hook in process_detail records for deleted processes',
               'A'     => 'select count(*) as weight from process_details where hook_in != 0 and process_id not in (select id from processes where hook_in != 0)');
}
//////END - HOOK IN WEIGHT CHECK



//////START - HOOK OUT WEIGHT CHECK
function oo8a() {
  /* select processes.id, sum(process_details.hook_out) as pd_value, processes.hook_out as p_value 
            from process_details 
            inner join processes on process_details.process_id = processes.id 
            where process_details.hook_out!= 0 
            group by processes.id having pd_value != p_value; */
  return array('srno'  => 'OO8A',
               'title' => 'Hook out weight check in processes and process_details',
               'A'     => 'select sum(hook_out) as weight  from processes;',
               'C'     => 'select sum(hook_out) as weight  from process_details');
}

function oo8b() {
  /* select processes.id, processes.karigar, processes.hook_kdm_purity, processes.hook_out, processes.created_at 
            from processes 
            where id not in (select process_id from process_details where hook_out != 0) 
                  and hook_out != 0; */
  return array('srno'  => 'OO8B',
               'title' => 'Check missing process_details records for hook out',
               'A'     => 'select count(*) as weight from processes where id not in (select process_id from process_details where hook_out != 0) and hook_out != 0');
}

function oo8c() {
  /* select id, process_id 
            from process_details 
            where hook_out != 0 and process_id not in (select id from processes where hook_out != 0); */
  return array('srno'  => 'OO8C',
               'title' => 'check hook out process_detail records for deleted processes',
               'A'     => 'select count(*) as weight from process_details where hook_out != 0 and process_id not in (select id from processes where hook_out != 0)');
}
//////END - HOOK OUT WEIGHT CHECK


//////START - DAILY DRAWER OUT WEIGHT CHECK
function oo9a() {
  /* select processes.id, sum(process_details.daily_drawer_out_weight) as pd_value, processes.daily_drawer_out_weight as p_value 
            from process_details 
            inner join processes on process_details.process_id = processes.id 
            where process_details.daily_drawer_out_weight!= 0 
            group by processes.id having pd_value != p_value; */
  return array('srno'  => 'OO9A',
               'title' => 'Daily drawer in weight check in processes and process_details',
               'A'     => 'select sum(daily_drawer_out_weight) as weight from processes;',
               'C'     => 'select sum(daily_drawer_out_weight) as weight from process_details');
}

function oo9b() {
  /* select processes.id, processes.karigar, processes.hook_kdm_purity, processes.daily_drawer_out_weight, processes.created_at 
            from processes 
            where id not in (select process_id from process_details where daily_drawer_out_weight != 0) 
                  and daily_drawer_out_weight != 0; */
  return array('srno'  => 'OO9B',
               'title' => 'Check missing process_details records for daily_drawer_out_weight',
               'A'     => 'select sum(processes.daily_drawer_out_weight) as weight from processes where id not in (select process_id from process_details where daily_drawer_out_weight != 0) and daily_drawer_out_weight != 0');
}

function oo9c() {
  /* select id, process_id 
            from process_details 
            where daily_drawer_out_weight != 0 and process_id not in (select id from processes where daily_drawer_out_weight != 0); */
  return array('srno'  => 'OO9C',
               'title' => 'check process_detail records for deleted processes',
               'A'     => 'select count(*) as weight from process_details where daily_drawer_out_weight != 0 and process_id not in (select id from processes where daily_drawer_out_weight != 0)');
}
//////END - DAILY DRAWER OUT WEIGHT CHECK