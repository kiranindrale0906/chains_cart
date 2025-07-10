<?php

function melting_wastages_checks() {
  return array(mw2(), mw3(), mw5a(), mw5b(), mw6(), mw7());
}




//////START - IN, OUT AND BALANCE MISMATCH
function mw2() {
  /* select id, melting_wastage + in_melting_wastage, (out_melting_wastage + issue_melting_wastage + balance_melting_wastage+ out_opening_melting_wastage) 
            from processes 
            where (melting_wastage + in_melting_wastage) != (out_melting_wastage + issue_melting_wastage + balance_melting_wastage + out_opening_melting_wastage); */
  return array('srno'  => 'MW2',
               'title' => 'In, Out and Balance mismatch',
               'A'     => 'select sum(melting_wastage) as weight from processes',
               //'B'     => 'select sum(in_melting_wastage) as weight from processes',
               'C'     => 'select sum(out_melting_wastage + out_opening_melting_wastage) as weight from processes',
               'D'     => 'select sum(issue_melting_wastage) as weight from processes',
               'E'     => 'select sum(balance_melting_wastage) as weight from processes',
               'query' =>'select id, melting_wastage, (out_melting_wastage + issue_melting_wastage + balance_melting_wastage + out_opening_melting_wastage),
                          product_name,process_name,department_name,id as url from processes 
                          where (melting_wastage) != (out_melting_wastage + issue_melting_wastage + balance_melting_wastage + out_opening_melting_wastage)');
}
//////END - IN, OUT AND BALANCE MISMATCH


//////START - CHECK WITH MELTING LOT DETAILS
function mw3() {
  /* select processes.id, sum(mld.required_weight) as mld_out, processes.out_melting_wastage processes_out 
            from melting_lot_details mld 
            inner join processes on mld.process_id = processes.id group by processes.id having mld_out != processes_out;  */
  return array('srno'  => 'MW3',
               'title' => 'Melting lot details required weight does not match out melting wastage',
               'A'     => 'select sum(required_weight) as weight from melting_lot_details;',
               'C'     => 'select sum(out_melting_wastage) as weight from processes',
               'B'     => 'select sum(in_weight) as weight from processes where product_name = "Melting Wastage Refine Out"',
               'query' => 'select processes.id, sum(mld.required_weight) as mld_out, processes.out_melting_wastage processes_out,
                           processes.product_name,processes.process_name,processes.department_name,processes.id as url 
                           from melting_lot_details mld 
                           inner join processes on mld.process_id = processes.id group by processes.id having mld_out != processes_out');
}

// function mw4() {
//   /* Check if there are processes with out melting wastage but no melting lot details
//      select id, out_melting_wastage from processes where out_melting_wastage > 0 and id not in (select process_id from melting_lot_details);  */
//   return array('srno'  => 'MW4',
//                'title' => 'Missing melting lot details for out melting wastage',
//                'A'     => 'select count(*) as weight from processes where out_melting_wastage > 0 and id not in (select process_id from melting_lot_details)',
//                'query' => 'select id,out_melting_wastage,product_name,process_name,department_name,id as url from processes where out_melting_wastage > 0 and id not in (select process_id from melting_lot_details)');
// }

function mw5a() {
  return array('srno'  => 'MW5a',
               'title' => 'Check out melting wastage fine with melting lot details',
               'A'     => 'select sum(required_weight * in_purity) / 100 as weight from melting_lot_details',
               'C'     => 'select sum((out_melting_wastage * wastage_lot_purity)/ 100) as weight from processes',
               'B'     => 'select sum((in_weight * in_lot_purity)/ 100) as weight from processes where product_name = "Melting Wastage Refine Out"',
               'query' => 'select 1 from processes');
}

function mw5b() {
  /* select melting_lot_details.id,melting_lot_details.required_weight, processes.wastage_lot_purity, melting_lot_details.in_purity 
            from melting_lot_details 
            inner join processes on melting_lot_details.process_id = processes.id 
            where processes.wastage_lot_purity != melting_lot_details.in_purity; */
  return array('srno'  => 'MW5b',
               'title' => 'Check out melting wastage fine with melting lot details',
               'A'     => 'select sum((mld.required_weight * (p.wastage_lot_purity - mld.in_purity)/ 100)) as weight 
                                  from melting_lot_details mld inner join processes p on mld.process_id = p.id',
               'query' => 'select melting_lot_details.id, processes.wastage_lot_purity, melting_lot_details.in_purity,processes.product_name,processes.process_name,processes.department_name,processes.id as url 
                          from melting_lot_details 
                          inner join processes on melting_lot_details.process_id = processes.id 
                          where processes.wastage_lot_purity != melting_lot_details.in_purity');
}
//////END - CHECK WITH MELTING LOT DETAILS


//////START - CHECK WITH ISSUE DEPARTMENT
function mw6() {
  return array('srno'  => 'MW6',
               'title' => 'Check out issue melting wastage gross with issue department',
               'A'     => 'select sum(issue_melting_wastage) as weight from processes',
               'C'     => 'select sum(in_weight) as weight from issue_departments where product_name = "Melting Wastage"',
               'query' => 'select 1 from processes');
}

function mw7() {
  return array('srno'  => 'MW7',
               'title' => 'Check out issue melting wastage fine with issue department',
               'A'     => 'select sum((issue_melting_wastage * wastage_lot_purity)/ 100) as weight from processes',
               'C'     => 'select sum(in_weight * in_purity / 100) as weight from issue_departments where product_name = "Melting Wastage"',
               'query' => 'select 1 from processes');
}
//////END - CHECK WITH ISSUE DEPARTMENTS