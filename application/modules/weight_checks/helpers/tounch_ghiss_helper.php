<?php

function tounch_ghiss_checks() {
  return array(
               tg2(), 
               tg3d(), tg3e());
}


//////START - IN, OUT AND BALANCE MISMATCH
function tg2() {
  /* select id, tounch_ghiss, (out_tounch_ghiss + balance_tounch_ghiss) 
            from processes 
            where (tounch_ghiss) != (out_tounch_ghiss + balance_tounch_ghiss); */
  return array('srno'  => 'G2',
               'title' => 'In, Out and Balance mismatch',
               'A'     => 'select sum(tounch_ghiss) as weight from processes',
               'C'     => 'select sum(out_tounch_ghiss) as weight from processes',
               'E'     => 'select sum(balance_tounch_ghiss) as weight from processes');
}
//////END - IN, OUT AND BALANCE MISMATCH


//////START - CHECK WITH OUT GHISS WITH PROCESS OUT WASTAGE DETAILS AND MELTING PROCESS

//process out wastage details added in ghiss helper

function tg3d() {
  /* Check if there are processes with out ghiss but no process out wastage details
     select id, out_ghiss from processes 
            where out_ghiss > 0 and id not in (select process_id from process_out_wastage_details);  */
  return array('srno'  => 'G3D',
               'title' => 'Missing process out wastage details for out tounch ghiss',
               'A'     => 'select count(*) as weight from processes where out_tounch_ghiss > 0 and id not in (select process_id from process_out_wastage_details where field_name = "Tounch Ghiss Out")');
}

function tg3e() {
  return array('srno'  => 'TG3E',
               'title' => 'Missing processes out tounch ghiss records for process out wastage details',
               'A'     => 'select sum(out_weight) as weight from process_out_wastage_details where field_name = "Ghiss Out" and process_id not in (select id from processes where out_tounch_ghiss > 0 or out_ghiss > 0)');
}
//////END - CHECK WITH OUT GHISS WITH PROCESS OUT WASTAGE DETAILS AND MELTING PROCESS
