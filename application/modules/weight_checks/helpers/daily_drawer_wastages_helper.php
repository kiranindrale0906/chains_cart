<?php

function daily_drawer_wastages_checks() {
  return array(
               ddw2(), 
               ddw3a(), ddw3b(), ddw3c(), ddw3d(), ddw3e(),
               ddw4(), ddw5());
}



//////START - IN, OUT AND BALANCE MISMATCH
function ddw2() {
  /* select id, daily_drawer_wastage, (out_daily_drawer_wastage + issue_daily_drawer_wastage + balance_daily_drawer_wastage) 
            from processes 
            where (daily_drawer_wastage) != (out_daily_drawer_wastage + issue_daily_drawer_wastage + balance_daily_drawer_wastage); */
  return array('srno'  => 'DDW2',
               'title' => 'In, Out and Balance mismatch',
               'A'     => 'select sum(daily_drawer_wastage) as weight from processes',
               'C'     => 'select sum(out_daily_drawer_wastage) as weight from processes',
               'D'     => 'select sum(issue_daily_drawer_wastage) as weight from processes',
               'E'     => 'select sum(balance_daily_drawer_wastage) as weight from processes',
               'query' => 'select id, daily_drawer_wastage, (out_daily_drawer_wastage + issue_daily_drawer_wastage + balance_daily_drawer_wastage),
                          product_name,process_name,department_name,id as url 
                          from processes 
                          where (daily_drawer_wastage) != (out_daily_drawer_wastage + issue_daily_drawer_wastage + balance_daily_drawer_wastage)');
}
//////END - IN, OUT AND BALANCE MISMATCH


//////START - CHECK WITH OUT DAILY DRAWER WASTAGE WITH PROCESS OUT WASTAGE DETAILS AND MELTING PROCESS
function ddw3a() {
  /* select processes.id, sum(powd.out_weight) as powd_out, processes.out_daily_drawer_wastage processes_out 
            from process_out_wastage_details powd 
            inner join processes on powd.process_id = processes.id and powd.field_name = 'Daily Drawer Wastage' 
            group by processes.id having powd_out != processes_out; */
  return array('srno'  => 'DDW3A',
               'title' => 'Process out wastage details out weight does not match out daily drawer wastage',
               'A'     => 'select sum(out_daily_drawer_wastage) as weight from processes',
               'C'     => 'select sum(out_weight) as weight from process_out_wastage_details where field_name = "Daily Drawer Wastage"',
               'query' => 'select processes.id, sum(powd.out_weight) as powd_out, processes.out_daily_drawer_wastage processes_out,
                            processes.product_name,processes.process_name,processes.department_name,processes.id as url 
                            from process_out_wastage_details powd 
                            inner join processes on powd.process_id = processes.id and powd.field_name = "Daily Drawer Wastage" 
                            group by processes.id having powd_out != processes_out');
}

function ddw3b() {
  return array('srno'  => 'DDW3B',
               'title' => 'Gross Daily drawer out weight does not match with daily drawer melting process in weight',
               'A'     => 'select sum(out_daily_drawer_wastage) as weight from processes',
               'C'     => 'select sum(in_weight) as weight from processes where product_name = "Daily Drawer" and department_name in ("Melting", "Daily Drawer Wastage") and process_name = "Melting"',
               'query' => 'select 1 from processes');
}

function ddw3c() {
  /* select po.parent_id, sum(po.out_weight), sum(po.out_weight * p.wastage_purity) / sum(po.out_weight), 
            round(sum(po.out_weight * p.wastage_purity * p.wastage_lot_purity) / sum(po.out_weight * p.wastage_purity),8) as lot_purity 
            from process_out_wastage_details po 
            inner join processes p on po.process_id = p.id 
            where po.field_name = 'Daily Drawer Wastage' group by po.parent_id; */

  /* select id, in_weight, in_purity, in_lot_purity 
            from processes 
            where product_name = 'Daily Drawer' and process_name = 'Melting' and department_name = 'Daily Drawer Wastage'; */
  return array('srno'  => 'DDW3C',
               'title' => 'Fine daily drawer out weight does not match with daily drawer melting process in weight',
               'A'     => 'select sum(out_daily_drawer_wastage * wastage_purity / 100 * wastage_lot_purity / 100) as weight from processes',
               'C'     => 'select sum(in_weight * in_purity / 100 * in_lot_purity / 100) as weight from processes where product_name = "Daily Drawer" and  department_name in ("Melting", "Daily Drawer Wastage") and process_name = "Melting"',
               'query' => 'select po.parent_id, sum(po.out_weight), sum(po.out_weight * p.wastage_purity) / sum(po.out_weight), 
                          round(sum(po.out_weight * p.wastage_purity * p.wastage_lot_purity) / sum(po.out_weight * p.wastage_purity),8) as lot_purity,
                          p.product_name,p.process_name,p.department_name,p.id as url 
                          from process_out_wastage_details po 
                          inner join processes p on po.process_id = p.id 
                          where po.field_name = "Daily Drawer Wastage" group by po.parent_id');
}

function ddw3d() {
  /* Check if there are processes with out daily drawer wastage but no process out wastage details
     select id, out_daily_drawer_wastage from processes 
            where out_daily_drawer_wastage > 0 and id not in (select process_id from process_out_wastage_details);  */
  return array('srno'  => 'DDW3D',
               'title' => 'Missing process out wastage details for out daily drawer wastage',
               'A'     => 'select count(*) as weight from processes where out_daily_drawer_wastage > 0 and id not in (select process_id from process_out_wastage_details where field_name = "Daily Drawer Wastage")',
               'query' => 'select id, out_daily_drawer_wastage,product_name,process_name,department_name,id as url from processes 
                            where out_daily_drawer_wastage > 0 and id not in (select process_id from process_out_wastage_details)');
}

function ddw3e() {
  return array('srno'  => 'DDW3E',
               'title' => 'Missing processes out daily drawer wastage records for process out wastage details',
               'A'     => 'select sum(out_weight) as weight from process_out_wastage_details where field_name = "Daily Drawer Wastage" and process_id not in (select id from processes where out_daily_drawer_wastage > 0)',
               'query' => 'select 1 from processes');
}
//////END - CHECK WITH OUT DAILY DRAWER WASTAGE WITH PROCESS OUT WASTAGE DETAILS AND MELTING PROCESS


//////START - CHECK WITH ISSUE DEPARTMENT
function ddw4() {
  return array('srno'  => 'DDW6',
               'title' => 'Gross Check out issue daily drawer wastage with issue department',
               'A'     => 'select sum(issue_daily_drawer_wastage) as weight from processes',
               'C'     => 'select sum(in_weight) as weight from issue_departments where product_name = "Daily Drawer Wastage"',
               'query' => 'select 1 from processes');
}

function ddw5() {
  return array('srno'  => 'DDW7',
               'title' => 'Fine Check out issue daily drawer wastage fine with issue department',
               'A'     => 'select sum((issue_daily_drawer_wastage * wastage_lot_purity)/ 100) as weight from processes',
               'C'     => 'select sum(in_weight * in_purity / 100) as weight from issue_departments where product_name = "Daily Drawer Wastage"',
               'query' => 'select 1 from processes');
}
//////END - CHECK WITH ISSUE DEPARTMENTS