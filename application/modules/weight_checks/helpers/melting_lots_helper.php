<?php

function melting_lots_checks() {
  return array(ml1(), ml2(), ml3());
}

function ml1() {
  /* select sum(required_weight) as re, wastage_weight as ww, melting_lot_id 
            from melting_lot_details inner join melting_lots on melting_lot_details.melting_lot_id=melting_lots.id 
            group by melting_lot_details.melting_lot_id having re != ww;  */
  return array( 'srno'  => 'ML1',
                'title' => 'Melting lot wastage weight does not match melting lot details required weight',
                'A'     => 'select sum(wastage_weight) as weight from melting_lots',
                'C'     => 'select sum(required_weight) as weight from melting_lot_details');
}

function ml2() {
  /* select id, gross_weight from melting_lots where id not in (select melting_lot_id from melting_lot_details); */
  return array( 'srno'  => 'ML2',
                'title' => 'Melting lots with no melting lot details',
                'A'     => 'select sum(gross_weight) as weight from melting_lots where id not in (select melting_lot_id from melting_lot_details)');
}

function ml3() {
  return array( 'srno'  => 'ML3',
                'title' => 'Melting lot details with with no melting lots',
                'A'     => 'select sum(required_weight) as weight from melting_lot_details where melting_lot_id not in (select id from melting_lots)');
}