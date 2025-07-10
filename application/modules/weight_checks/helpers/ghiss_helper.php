<?php

function ghiss_checks() {
  return array(
               g2(), 
               g3a(), g3b(), g3c(), g3d(), g3e(),
               g4(), g5());
}


//////START - IN, OUT AND BALANCE MISMATCH
function g2() {
  /* select id, ghiss, (out_ghiss + issue_ghiss + balance_ghiss) 
            from processes 
            where (ghiss) != (out_ghiss + issue_ghiss + balance_ghiss); */
  return array('srno'  => 'G2',
               'title' => 'In, Out and Balance mismatch',
               'A'     => 'select sum(ghiss) as weight from processes',
               'C'     => 'select sum(out_ghiss) as weight from processes',
               'D'     => 'select sum(issue_ghiss) as weight from processes',
               'E'     => 'select sum(balance_ghiss) as weight from processes');
}
//////END - IN, OUT AND BALANCE MISMATCH


//////START - CHECK WITH OUT GHISS WITH PROCESS OUT WASTAGE DETAILS AND MELTING PROCESS
function g3a() {
  /* select processes.id, sum(powd.out_weight) as powd_out, processes.out_ghiss processes_out 
            from process_out_wastage_details powd 
            inner join processes on powd.process_id = processes.id and powd.field_name = 'Ghiss Out' 
            group by processes.id having powd_out != processes_out; */
  return array('srno'  => 'G3A',
               'title' => 'Process out wastage details out weight does not match out ghiss plus tounch ghiss out',
               'A'     => 'select sum(out_ghiss + out_tounch_ghiss) as weight from processes',
               'C'     => 'select sum(out_weight) as weight from process_out_wastage_details where field_name in ("Ghiss Out", "Tounch Ghiss Out")');
}

function g3b() {
  return array('srno'  => 'G3B',
               'title' => 'Gross ghiss out weight does not match with ghiss melting process in weight',
               'A'     => 'select sum(out_ghiss + out_tounch_ghiss) as weight from processes',
               'C'     => 'select sum(in_weight) as weight from processes where product_name = "Ghiss Out" and department_name = "Ghiss Melting" and process_name = "Melting"');
}

function g3c() {
  /* select po.parent_id, sum(po.out_weight), sum(po.out_weight * p.wastage_purity) / sum(po.out_weight), 
            round(sum(po.out_weight * p.wastage_purity * p.wastage_lot_purity) / sum(po.out_weight * p.wastage_purity),8) as lot_purity 
            from process_out_wastage_details po 
            inner join processes p on po.process_id = p.id 
            where po.field_name in ('Ghiss Out', 'Tounch Ghiss Out') 
            group by po.parent_id;

    select id, in_weight, in_purity, in_lot_purity 
           from processes 
           where product_name = 'Ghiss Out' and process_name = 'Melting' and department_name = 'Start'; */

  return array('srno'  => 'G3C',
               'title' => 'Fine ghiss out weight does not match with ghiss melting process in weight',
               'A'     => 'select sum((out_ghiss + out_tounch_ghiss) * wastage_purity / 100 * wastage_lot_purity / 100) as weight from processes',
               'C'     => 'select sum(in_weight * in_purity / 100 * in_lot_purity / 100) as weight from processes where product_name = "Ghiss Out" and department_name = "Ghiss Melting" and process_name = "Melting"');
}

function g3d() {
  /* Check if there are processes with out ghiss but no process out wastage details
     select id, out_ghiss from processes 
            where out_ghiss > 0 and id not in (select process_id from process_out_wastage_details);  */
  return array('srno'  => 'G3D',
               'title' => 'Missing process out wastage details for out ghiss',
               'A'     => 'select count(*) as weight from processes where out_ghiss > 0 and id not in (select process_id from process_out_wastage_details where field_name = "Ghiss Out")');
}

function g3e() {
  return array('srno'  => 'G3E',
               'title' => 'Missing processes out ghiss records for process out wastage details',
               'A'     => 'select sum(out_weight) as weight from process_out_wastage_details where field_name = "Ghiss Out" and process_id not in (select id from processes where out_ghiss > 0 or out_tounch_ghiss > 0)');
}
//////END - CHECK WITH OUT GHISS WITH PROCESS OUT WASTAGE DETAILS AND MELTING PROCESS


//////START - CHECK WITH ISSUE DEPARTMENT
function g4() {
  return array('srno'  => 'G4',
               'title' => 'Gross Check out issue ghiss with issue department',
               'A'     => 'select sum(issue_ghiss) as weight from processes',
               'C'     => 'select sum(in_weight) as weight from issue_departments where product_name in ("Cutting Ghiss", "Ice Cutting Ghiss")');
}

function g5() {
  return array('srno'  => 'G5',
               'title' => 'Fine Check out issue ghiss fine with issue department',
               'A'     => 'select sum((issue_ghiss * wastage_lot_purity)/ 100) as weight from processes',
               'C'     => 'select sum(in_weight * in_purity / 100) as weight from issue_departments where product_name in ("Cutting Ghiss", "Ice Cutting Ghiss")');
}

function g6() {
  /* select processes.id, sum(issue_department_details.out_weight) as out_weight, sum(processes.issue_ghiss) as issue_ghiss 
            from issue_department_details 
            inner join processes on issue_department_details.process_id = processes.id 
            inner join issue_departments on issue_departments.id = issue_department_details.issue_department_id 
            where issue_departments.product_name in ('Cutting Ghiss', 'Ice Cutting Ghiss') 
            group by processes.id having out_weight != issue_ghiss;  */
  return array('srno'  => 'G6',
               'title' => 'Fine Check out issue ghiss fine with issue department',
               'A'     => 'select sum(issue_ghiss) as weight from processes',
               'C'     => 'select sum(out_weight) as weight from issue_department_details inner join issue_departments on issue_departments.id = issue_department_details.issue_department_id where issue_departments.product_name in ("Cutting Ghiss", "Ice Cutting Ghiss")');
}
//////END - CHECK WITH ISSUE DEPARTMENTS