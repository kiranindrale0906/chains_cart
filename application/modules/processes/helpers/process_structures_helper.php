
<?php defined('BASEPATH') or exit('No direct script access allowed.');


function in_common_structure($in_lot_purity = '', $in_weight = '', $in_purity = '', $department_name = '', $sub_department_name="")
{
    $common_column = array();

    $common_column[] = array('LOT NO', 'lot_no', 'label_with_text', '');

    if (!empty($in_lot_purity)) {
        $common_column[] = array('LOT PURITY ', 'in_lot_purity', 'label_with_value', '', '');
    }

    if (!empty($in_weight)) {
        $common_column[] = array('IN', 'in_weight', 'label_with_value', 'total', '');
    }

    if (!empty($in_purity)) {
        $common_column[] = array('IN PURITY ', 'in_purity', 'label_with_value', '', '');
    }

//  if(HOST=='AR Gold Internal') $common_column[] = array('Design Name','melting_lot_category_four', 'label_with_text','');
    //if(HOST=='AR Gold Internal') $common_column[] = array('Quantity','quantity', 'label_with_text','');

    if (HOST == 'ARC') {
        $common_column[] = array('Tone', 'tone', 'label_with_text', '');
    }

    if (!empty($department_name)) {
        $machine_names = get_machine_names($department_name);
        if (!empty($machine_names)) {
            $department_machine_names = array_merge(array(array('name' => '', 'id' => '')), $machine_names);
            $common_column[] = array('Machine No', 'machine_no', 'dropdown', '', $department_machine_names);
        }
    }
    return $common_column;
}

function in_common_structure_with_in_details($in_lot_purity = '', $in_weight = '', $in_purity = '', $lot_no = 'lot_no')
{
    $common_column = array();

    if (!empty($lot_no)) {
        $common_column[] = array('LOT NO', 'lot_no', 'label_with_text', '');
    }

    if (!empty($in_lot_purity)) {
        $common_column[] = array('LOT PURITY', 'in_lot_purity', 'label_with_value', '', '');
    }

    if (!empty($in_weight)) {
        $common_column[] = array('IN', 'in_weight', 'in_weight_details', 'total', '');
    }

    if (!empty($in_purity)) {
        $common_column[] = array('IN PURITY', 'in_purity', 'label_with_value', '', '');
    }

    return $common_column;
}



function hook_in_structure($options)
{
    foreach ($options as $index => $option) {
        $process_fields_options[] = array('name' => $option, 'id' => $option);
    }
    $common_column = array(array('Hook In', 'hook_in', 'text_with_add_more', 'total', '',
        array(array('label' => 'Weight', 'field_type' => 'text', 'database_column' => 'hook_in'),
            array('label' => 'Daily Drawer Type', 'field_type' => 'dropdown',
                'database_column' => 'daily_drawer_type', 'options' => $process_fields_options))));
    return $common_column;
}

function hook_out_structure($options)
{
    $common_column = array();
    foreach ($options as $index => $option) {
        $process_fields_options[] = array('name' => $option, 'id' => $option);
    }
    $common_column = array(array('Hook Out', 'hook_out', 'text_with_add_more', 'total', '',
        array(array('label' => 'Weight', 'field_type' => 'text', 'database_column' => 'hook_out'),
            array('label' => 'Daily Drawer Type', 'field_type' => 'dropdown',
                'database_column' => 'daily_drawer_type', 'options' => $process_fields_options))),
        array('Hook/KDM Purity', 'hook_kdm_purity', 'label_with_value', ''));
    return $common_column;
}

function out_common_structure($out_weight = 'text', $out_purity = '', $out_lot_purity = '',
    $out_purity_label = 'label_with_value') {
    $common_column = array(array('OUT', 'out_weight', $out_weight, 'total', ''));
    if (!empty($out_purity)) {
        $common_column[] = array('OUT PURITY ', 'out_purity', 'label_with_value', '', '');
    }
    if (!empty($out_lot_purity)) {
        $common_column[] = array('OUT LOT PURITY ', 'out_lot_purity', $out_purity_label, '', '');
    }
    return $common_column;
}

function gpc_out_common_structure($gpc_out = 'text_with_add_more', $out_purity = '', $out_lot_purity = '',
    $out_purity_label = 'label_with_value', $repair_out = '', $repair_out_quantity = '', $loss = '', $ml_wastage = 'text', $dd_wastage = 'text', $chain = '') {
    if (HOST == 'ARF') {
        if ($chain != '') {
            $text = $gpc_out;
        } else {
            if ($gpc_out != 'text_with_add_more') {
                $gpc_out = $gpc_out;
            } elseif ($gpc_out == 'text_with_add_more') {
                $gpc_out = 'text_with_add_more';
            } else {
                $gpc_out = 'text';
            }
            $text = $gpc_out;
        }
    } else {
        $text = GPC_OUT_FIELD;
    }
    $common_column = array(array('GPC OUT', 'gpc_out', $text, 'total', ''));
    if (!empty($out_purity)) {
        $common_column[] = array('OUT PURITY ', 'out_purity', 'label_with_value', '', '');
    }

    if (!empty($out_lot_purity)) {
        $common_column[] = array('OUT LOT PURITY ', 'out_lot_purity', $out_purity_label, '', '');
    }
    if (!empty($repair_out)) {
        $common_column[] = array('REPAIR OUT', 'repair_out', $repair_out, '', '');
    }
    if (!empty($repair_out_quantity)) {
        $common_column[] = array('REPAIR QUANTITY', 'repair_out_quantity', $repair_out_quantity, '', '');
    }
    $common_column[] = array('DD WASTAGE', 'daily_drawer_wastage', $dd_wastage, 'total');
    if (!empty($loss)) {
        $common_column[] = array('Loss', 'loss', 'text', 'total');
    }

    if (HOST != 'ARF') {
        $common_column[] = array('ML WASTAGE', 'melting_wastage', $ml_wastage, 'total');
    }

    if (HOST == 'ARF') {
        $common_column[] = array('REMARK', 'remark', 'text', '', '');
    }

    // $common_column[]=array('Tounch No','tounch_no','label_with_value','');
    // $common_column[]=array('Tounch PURITY ', 'tounch_purity','label_with_value','','');
    // $common_column[]=array('Tounch Loss Fine', 'tounch_loss_fine', 'label_with_value', '', '');
    return $common_column;
}

function refresh_gpc_out_common_structure($gpc_out = 'text_with_add_more', $out_purity = '', $out_lot_purity = '',
    $out_purity_label = 'label_with_value', $repair_out = '', $repair_out_quantity = '') {
    $common_column = array(array('GPC OUT', 'gpc_out', $gpc_out, 'total', ''));
    if (!empty($out_purity)) {
        $common_column[] = array('OUT PURITY ', 'out_purity', 'label_with_value', '', '');
    }
    if (!empty($out_lot_purity)) {
        $common_column[] = array('OUT LOT PURITY ', 'out_lot_purity', $out_purity_label, '', '');
    }
    if (!empty($repair_out)) {
        $common_column[] = array('REPAIR OUT', 'repair_out', $repair_out, '', '');
    }
    if (!empty($repair_out_quantity)) {
        $common_column[] = array('REPAIR QUANTITY', 'repair_out_quantity', $repair_out_quantity, '', '');
    }
    $common_column[] = array('DD WASTAGE', 'daily_drawer_wastage', 'text_with_add_more', 'total');

   $common_column[] = array('ML WASTAGE', 'melting_wastage', 'text', 'total');
   $common_column[] = array('REMARK', 'remark', 'text', '', '');

    return $common_column;
}

function design_detail_common_structure($design_code = '', $machine_size = '', $karigar = '', $length = '', $remark = '', $description = '')
{
    $common_column = array();
    if (!empty($design_code)) {
        $common_column[] = array('Design Code', 'design_code', 'label_with_text', '', '');
    }

    if (!empty($karigar)) {
        $common_column[] = array('KARIGAR', 'karigar', 'label_with_text', '');
    }

    if (!empty($length)) {
        $common_column[] = array('LENGTH', 'length', 'label_with_text', '');
    }

    if (!empty($remark)) {
        $common_column[] = array('REMARK', 'remark', 'label_with_text', '', '');
    }

    if (!empty($description)) {
        $common_column[] = array('DESCRIPTION', 'description', 'label_with_text', '', '');
    }

    if (!empty($machine_size)) {
        $common_column[] = array('Machine size', 'machine_size', 'label_with_text', '', '');
    }

    return $common_column;

}
function commond_created_structure()
{
    $common_column = array(array('DATE', 'created_at', 'label_with_value', '', ''),
        array('Created by', 'created_by', 'label_with_value', '', ''),
        array('Updated by', 'updated_by', 'label_with_value', '', ''));
    return $common_column;

}
function balance_structure($balance = '', $balance_gross = '', $balance_fine = '', $tounch_loss_fine = '')
{
    $common_column = array();
    if (!empty($balance)) {
        $common_column[] = array('BALANCE', 'balance', 'label_with_value', 'total', '');
    }

    if (!empty($balance_gross)) {
        $common_column[] = array('BALANCE GROSS', 'balance_gross', 'label_with_value', 'total', '');
    }

    if (!empty($balance_fine)) {
        $common_column[] = array('BALANCE FINE', 'balance_fine', 'label_with_value', 'total', '');
    }

    if (!empty($tounch_loss_fine)) {
        $common_column[] = array('Tounch No', 'tounch_no', 'label_with_value', '');
        $common_column[] = array('Tounch PURITY ', 'tounch_purity', 'label_with_value', '', '');
        $common_column[] = array('TOUNCH LOSS FINE', 'tounch_loss_fine', 'label_with_value', 'total', '');
    }
    $common_column[] = array('Office Side', 'factory_karigar', 'dropdown',
        '', array(array('id' => 'Office', 'name' => 'Office'),
            array('id' => 'Office Outside', 'name' => 'Office Outside')));
    $common_column[] = array('TIME', 'created_at', 'label_with_value', '', '');
    $common_column[] = array('Created by', 'created_by', 'label_with_value', '', '');
    $common_column[] = array('Updated by', 'updated_by', 'label_with_value', '', '');
    $common_column[] = array('updated At', 'updated_at', 'label_with_text', '', '');
    $common_column[] = array('Completed At', 'completed_at', 'label_with_text', '', '');
    $common_column[] = array('Is Outside', 'is_outside', 'redio_button', '', '');
    $common_column[] = array('ACTION', 'action', '', '', '');
    return $common_column;

}

function wastage_loss_structure($wastage_column = 'melting_wastage', $wastage = '', $loss = '', $ghiss = '', $melting_wastage_with_dd_wastage = true)
{
    $common_column = array();
    if (!empty($wastage)) {
        if ($wastage_column == 'daily_drawer_wastage') {
            $common_column[] = array('DD WASTAGE', 'daily_drawer_wastage', 'text_with_add_more', 'total');
             if ($melting_wastage_with_dd_wastage == 1 && HOST != 'ARF') {
                $common_column[] = array('Melting Wastage', 'melting_wastage', 'text_with_add_more', 'total');
            }
            if (HOST == 'ARF') {
                $common_column[] = array('REMARK', 'remark', 'text', '', '');
            }
        } else {
            $common_column[] = array('Melting Wastage', $wastage_column, 'text_with_add_more', 'total');
        }
    }
    if (!empty($ghiss)) {
        $common_column[] = array('GHISS', 'ghiss', 'text', 'total', '');
    }

    if (!empty($loss)) {
        $common_column[] = array('LOSS', 'loss', 'text', 'total', '');
    }

    return $common_column;

}
function ghiss_structure($text = 'text', $column_name = 'ghiss')
{
    $common_column = array(array('GHISS', $column_name, $text, 'total', ''));
    return $common_column;

}

function tounch_structure($text = 'text', $fire_tounch = false, $firetext = 'text')
{

    $common_column = array(array('TOUNCH', 'tounch_in', $text, 'total', ''),
        array('TOUNCH NO', 'tounch_no', 'label_with_value', '', ''),
        array('TOUNCH Purity', 'tounch_purity', 'label_with_value', '', ''));

    if ($fire_tounch) {
        $common_column = array_merge($common_column, array(
            array('Fire TOUNCH NO', 'fire_tounch_no', 'label_with_value', '', ''),
            array('Fire Tounch', 'fire_tounch_in', $firetext, 'total', ''),
            array('Fire Tounch Purity', 'fire_tounch_purity', 'label_with_value', '', ''),
        ));
    }
    return $common_column;

}

function start_structure($process = '', $department_name = '', $sub_department_name="")
{
    $structure['common'] = array_merge(array(array('Barcode', 'bar_code', 'label_with_value', ''),
        array('SR NO', 'id', 'label_with_value', '')),
        in_common_structure('in_lot_purity', 'in_weight', 'in_purity', $department_name,$sub_department_name),
        array(array('Description', 'description', 'label_with_value', '', '')),
        commond_created_structure()
    );
    $structure['common_start_for_indo_tally'] = array_merge(
        array(array('Barcode', 'bar_code', 'label_with_value', ''), array('SR NO', 'id', 'label_with_value', '')),
        array(array('PARENT LOT NO', 'parent_lot_name', 'label_with_text', ''), array('Input Type', 'input_type', 'label_with_text', '')),
        in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        commond_created_structure()
    );
    $structure['common_start_for_rope_chain'] = array_merge(
        array(array('Barcode', 'bar_code', 'label_with_value', ''), array('SR NO', 'id', 'label_with_value', '')),
        array(array('PARENT LOT NO', 'parent_lot_name', 'label_with_text', '')),
        in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        commond_created_structure()
    );
    $structure['common_start_for_rope_chain_machine'] = array_merge(
        array(array('Barcode', 'bar_code', 'label_with_value', ''), array('SR NO', 'id', 'label_with_value', '')),
        array(array('PARENT LOT NO', 'parent_lot_name', 'label_with_text', '')),
        in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        design_detail_common_structure('design_code'),
        commond_created_structure()
    );
    $structure['common_start_without_lotno_indo_tally'] = array_merge(
        array(array('Barcode', 'bar_code', 'label_with_value', ''), array('SR NO', 'id', 'label_with_value', '')),
        array(array('PARENT LOT NO', 'parent_lot_name', 'label_with_text', ''), array('Input Type', 'input_type', 'label_with_text', ''),
            array('LOT PURITY ', 'in_lot_purity', 'label_with_value', '', ''),
            array('IN', 'in_weight', 'label_with_value', 'total', ''),
            array('IN PURITY ', 'in_purity', 'label_with_value', '', '')),
        commond_created_structure()
    );

    $structure['common_machine_process'] = array_merge($structure['common'],
        design_detail_common_structure('design_code'));
    $structure['common_design_machine_size_machine_process'] = array_merge($structure['common'],
        design_detail_common_structure('design_code', 'machine_size'));
    $structure['common_design_karigar_process'] = array_merge(
        array(array('SR NO', 'id', 'label_with_value', '')),
        in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        design_detail_common_structure('design_code', '', 'karigar'),
        commond_created_structure()
    );

    $structure['common_karigar_process'] = array_merge(
        array(array('Barcode', 'bar_code', 'label_with_value', ''), array('SR NO', 'id', 'label_with_value', '')),
        in_common_structure('in_lot_purity', 'in_weight', 'in_purity', $department_name),
        design_detail_common_structure('', 'machine_size', 'karigar'),
        commond_created_structure()
    );
   
    $structure['common_final_process'] = $structure['common'];
    $structure['hand_made_melting'] = $structure['common_start_for_rope_chain'];
    $structure['dus_collection_ags'] = $structure['common'];
    $structure['solid_nawabi_melting'] = $structure['common'];
    $structure['dus_collection_ags'] = $structure['common'];
    $structure['lopster_making_melting'] = array_merge(array(array('Barcode', 'bar_code', 'label_with_value', ''),
        array('SR NO', 'id', 'label_with_value', '')),
        array(array('Lopster No', 'lopster_no', 'label_with_text', '')),
        array(array('PARENT LOT NO', 'parent_lot_name', 'label_with_text', '')),
        in_common_structure('in_lot_purity', 'in_weight', 'in_purity', $department_name),
        array(array('Description', 'description', 'label_with_value', '', '')),
        commond_created_structure()
    );
    $structure['process'] = $structure['common'];
    $structure['daily_drawer_melting_process'] = array_merge(
        array(array('Barcode', 'bar_code', 'label_with_value', ''),
            array('SR NO', 'id', 'label_with_value', '')),
        in_common_structure_with_in_details('in_lot_purity', 'in_weight', 'in_purity'),
        commond_created_structure()
    );
    $structure['casting_process_meltings'] = $structure['common'];
   $structure['office_outside_kdm'] = $structure['common_karigar_process'];
    
    $structure['refresh'] = array_merge(array(array('Barcode', 'bar_code', 'label_with_value', ''),
        array('SR NO', 'id', 'label_with_value', '')),
        in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Account', 'account', 'label_with_value', '', '')),

        array(array('Karigar', 'karigar', 'label_with_value', '', '')),
        array(array('Quantity', 'quantity', 'label_with_value', '', '')),
        array(array('Description', 'description', 'label_with_value', '', '')),
        commond_created_structure()
    );
    $structure['refresh_final_process'] = array_merge(array(array('Barcode', 'bar_code', 'label_with_value', ''),
        array('SR NO', 'id', 'label_with_value', '')),
        in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Chain', 'product_name', 'label_with_text', '', '')),
        array(array('Cat 1', 'melting_lot_category_one', 'label_with_text', '', '')),
        array(array('Size', 'machine_size', 'label_with_text', '', '')),
        array(array('Tone', 'tone', 'label_with_text', '', '')),
        array(array('Quantity', 'quantity', 'label_with_value', '', '')),
        array(array('Description', 'description', 'label_with_value', '', '')),
        commond_created_structure()
    );

    $structure['refresh_hold'] = $structure['refresh'];

    $structure['loss_out_process'] = array_merge(array(array('SR NO', 'id', 'label_with_value', ''),
        array('Lot No', 'lot_no', 'label_with_value', ''),
        array('Description', 'description', 'label_with_value', ''),
        array('IN', 'in_weight', 'in_weight_details', 'total', ''),
        array('IN LOT PURITY ', 'in_lot_purity', 'label_with_value', '', ''),
        array('IN PURITY ', 'in_purity', 'label_with_value', '', '')),
        commond_created_structure());

    $structure['hcl_melting_process'] = array_merge(
        array(array('SR NO', 'id', 'label_with_value', '')),
        array(array('PARENT LOT NO', 'parent_lot_name', 'label_with_text', '')),
        in_common_structure_with_in_details('in_lot_purity', 'in_weight', 'in_purity'),
        commond_created_structure()
    );
    $structure['rod_melting_process'] = array_merge(
        array(array('SR NO', 'id', 'label_with_value', '')),
        in_common_structure_with_in_details('in_lot_purity', 'in_weight', 'in_purity'),
        commond_created_structure()
    );
    $structure['hcl_ghiss_melting_process'] = array_merge(
        array(array('SR NO', 'id', 'label_with_value', ''),
            array('PARENT LOT NO', 'parent_lot_name', 'label_with_text', ''),
            array('LOT NO', 'lot_no', 'label_with_text', ''),
            array('IN PURITY ', 'in_purity', 'label_with_value', '', ''),
            array('IN LOT PURITY ', 'in_lot_purity', 'label_with_value', '', ''),
            array('IN', 'in_weight', 'in_weight_details', 'total', '')),
        commond_created_structure());

    $structure['rope_chain_melting_process']=$structure['common_start_for_rope_chain'];
    
    return $structure[$process];
}

function melting_structure($process = '', $department_name = '', $sub_department_name = '')
{
    $structure['common'] = array_merge(
        in_common_structure('in_lot_purity', 'in_weight', 'in_purity', $department_name),

        array(array('Plain Rod', 'in_plain_rod', 'label_with_value', 'total', '')),
        array(array('Description', 'description', 'label_with_value', '', '')),
        array(array('In Rod', 'in_rod', 'text_with_add_more', 'total', '')),

        array(array('Out Rod', 'out_rod', 'text', 'total', '')),
        out_common_structure('text'),
        wastage_loss_structure('daily_drawer_wastage', 'wastage', 'loss'),
        tounch_structure(),
        ghiss_structure('text_with_add_more'),
        balance_structure('balance', '', 'balance_fine'));

 $structure['rope_chain_melting_process'] = array_merge(
        in_common_structure('in_lot_purity', 'in_weight', '', $department_name,$sub_department_name),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        out_common_structure('text'),
        wastage_loss_structure('melting_wastage', 'wastage', '', '', false),
         array(array('Loss', 'loss', 'text_with_add_more', '', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine'));
    $structure['common_without_ghiss'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name), array(array('Description', 'description', 'label_with_value', '', '')),
        out_common_structure('text'),
        wastage_loss_structure('daily_drawer_wastage', 'wastage', 'loss'),
        tounch_structure(),
        balance_structure('balance', '', 'balance_fine'));
    
    $structure['office_outside_hook'] = $structure['common_without_ghiss'];
    $structure['office_outside_kdm'] = $structure['common_without_ghiss'];
    
        $structure['ghiss_out_final_process'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
            array(array('OUT WEIGHT', 'melting_wastage', 'text', 'total', '')),
            //array(array('OUT LOT PURITY', 'out_lot_purity', 'text','','')),
            tounch_structure(),
            wastage_loss_structure('daily_drawer_wastage', 'wastage', 'loss', '', false),
            balance_structure('balance', '', 'balance_fine', 'tounch_loss_fine'));

    $structure['loss_out_process'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', 'in_purity', $department_name),
        array(array('OUT', 'out_weight', 'text', 'total', '')),
        tounch_structure('text_with_add_more', false),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        wastage_loss_structure('melting_wastage', 'wastage', 'loss', '', false),
        balance_structure('balance', '', 'balance_fine', 'tounch_loss_fine'));
    return $structure[$process];
}

function tounch_department_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name), array(array('Description', 'description', 'label_with_value', '', '')),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        ghiss_structure('text_with_add_more'),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        array(array('Tounch PURITY', 'tounch_purity', 'text', '', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
    $structure['rope_chain_melting_process'] = $structure['common'];
    return $structure[$process];
}
function tounch_hold_department_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
    $structure['rope_chain_melting_process'] = $structure['common'];
    return $structure[$process];
}


function stripping_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name), array(array('Description', 'description', 'label_with_value', '', '')),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        wastage_loss_structure('melting_wastage', 'wastage', 'loss', '', false),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
    $structure['rope_chain_melting_process'] = $structure['common'];
    return $structure[$process];
}
function stripping_hold_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
    $structure['rope_chain_melting_process'] = $structure['common'];
    return $structure[$process];
}
function bull_block_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name), array(array('Description', 'description', 'label_with_value', '', '')),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        wastage_loss_structure('melting_wastage', 'wastage', 'loss', '', false),
        array(array('HCL Wastage', 'hcl_wastage', 'text_with_add_more', 'total', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
    $structure['rope_chain_melting_process'] = $structure['common'];
    return $structure[$process];
}
function bull_block_hold_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
    $structure['rope_chain_melting_process'] = $structure['common'];
    return $structure[$process];
}
function tube_forming_hold_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
    $structure['rope_chain_melting_process'] = $structure['common'];
    return $structure[$process];
}
function wire_making_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name), array(array('Description', 'description', 'label_with_value', '', '')),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        array(array('HCL Wastage', 'hcl_wastage', 'text_with_add_more', 'total', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
    $structure['rope_chain_melting_process'] = $structure['common'];
    return $structure[$process];
}
function wire_making_hold_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
    $structure['rope_chain_melting_process'] = $structure['common'];
    return $structure[$process];
}function flatting_hold_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
    $structure['rope_chain_melting_process'] = $structure['common'];
    return $structure[$process];
}
function tube_forming_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name), array(array('Description', 'description', 'label_with_value', '', '')),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        array(array('FE IN', 'fe_in', 'text', 'total', '')),
        array(array('FE Out', 'fe_out', 'text', 'total', '')),
        wastage_loss_structure('melting_wastage', 'wastage', 'loss', '', false),
        array(array('HCL Wastage', 'hcl_wastage', 'text_with_add_more', 'total', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
    $structure['rope_chain_melting_process'] = $structure['common'];
    return $structure[$process];
}
function machine_department_structure($process = '', $department_name = '')
{
    $structure['rope_chain_machine_process'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        array(array('HCL Wastage', 'hcl_wastage', 'text_with_add_more', 'total', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
      return $structure[$process];
}function drum_structure($process = '', $department_name = '')
{
    $structure['rope_chain_machine_process'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        array(array('HCL Wastage', 'hcl_wastage', 'text_with_add_more', 'total', '')),
        array(array('Loss', 'loss', 'text', 'total', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
      return $structure[$process];
}function drum_i_structure($process = '', $department_name = '')
{
    $structure['rope_chain_machine_process'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        wastage_loss_structure('melting_wastage', 'wastage', 'loss', '', false),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
      return $structure[$process];
}function hcl_structure($process = '', $department_name = '')
{
    $structure['rope_chain_machine_process'] = array_merge(
        array(
            array('PARENT LOT NO', 'parent_lot_name', 'label_with_text', ''),
            array('Input Type', 'input_type', 'label_with_text', ''),
            array('LOT NO', 'lot_no', 'label_with_text', ''),
            array('LOT PURITY ', 'in_lot_purity', 'label_with_value', '', ''),
            array('IN', 'in_weight', 'label_with_value', 'total', ''),
            array('IN PURITY ', 'in_purity', 'label_with_value', '', '')),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        
        out_common_structure('text', '$out_purity'),
        array(array('HCL Loss', 'hcl_loss', 'label_with_value', 'total', ''),
        array('FE Out', 'fe_out', 'label_with_value', 'total', ''),
        array('Expected Out', 'expected_out_weight', 'label_with_value', 'total', ''),
        array('Loss', 'loss', 'label_with_value', 'total', '')),
    balance_structure('balance', 'balance_gross', 'balance_fine'));
      return $structure[$process];
}
function hook_structure($process = '', $department_name = '')
{
    $structure['rope_chain_machine_process'] = array_merge(
        array(array('PARENT LOT NO', 'parent_lot_name', 'label_with_text', '')),
        in_common_structure('in_lot_purity', 'in_weight', 'in_purity', $department_name),
        hook_in_structure(array('Hook')),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        
        out_common_structure('text'),
        array(array('Wastage Purity', 'wastage_purity', 'label_with_value', '', '')),
        array(array('HCL Wastage', 'hcl_wastage', 'text_with_add_more', 'total', '')),
        array(array('LOSS', 'loss', 'label_with_value', 'total', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine'));
  return $structure[$process];
}
function hook_i_structure($process = '', $department_name = '')
{
    $structure['rope_chain_machine_process'] = array_merge(
        array(array('PARENT LOT NO', 'parent_lot_name', 'label_with_text', '')),
        in_common_structure('in_lot_purity', 'in_weight', 'in_purity', $department_name),
        hook_in_structure(array('Hook')),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        
        out_common_structure('text'),
        array(array('Wastage Purity', 'wastage_purity', 'label_with_value', '', '')),
        wastage_loss_structure('melting_wastage', 'wastage', ''),
        array(array('LOSS', 'loss', 'label_with_value', 'total', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine'));
  return $structure[$process];
}
function final_process_start_structure($process = 'common')
{
    $structure['common'] = array_merge(array(array('Barcode', 'bar_code', 'label_with_value', ''),
        array('SR NO', 'id', 'label_with_value', '')),
        in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        design_detail_common_structure('design_code', 'machine_size', 'karigar'),
        commond_created_structure());

    return $structure[$process];
}

function polish_structure($process = '', $department_name = '')
{
    $structure['casting_process_polish_processes'] =array_merge(
        in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Category', 'melting_lot_category_one', 'label_with_text', '')),
        array(array('Sub Category', 'melting_lot_category_two', 'label_with_text', '')),
        array(array('Karigar', 'karigar', 'text_with_add_more', '', '',
            array(
                array('label' => 'Karigar', 'field_type' => 'dropdown',
                    'database_column' => 'karigar',
                    'options' => process_wise_karigar_name('', '', 'Stone Setting RND'))))),

        array(array('Out Weight', 'out_weight', 'text_with_add_more', 'total', '',
            array(array('label' => 'Out Weight', 'field_type' => 'text',
                'database_column' => 'out_weight'),
                array('label' => 'Process', 'field_type' => 'dropdown',
                    'database_column' => 'next_department_name',
                    'options' => array(
                        array('name' => 'Filing', 'id' => 'Filing'),
                        array('name' => 'Polish', 'id' => 'Polish'),
                        array('name' => 'Stone Setting', 'id' => 'Stone Setting'),
                        array('name' => 'Final', 'id' => 'Final'),
                       ))))),
        wastage_loss_structure('melting_wastage', 'wastage', '', '', false),
        array(array('DD WASTAGE', 'daily_drawer_wastage', 'text_with_add_more', 'total')),
        
        ghiss_structure('text_with_add_more'),
        array(array('Loss', 'loss', 'text_with_add_more', '', '')),
        balance_structure('balance', 'balance_gross', 'balance_fine'));
   
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Design Name', 'design_code', 'label_with_text', '')),

        out_common_structure('text'),
        array(array('DD WASTAGE', 'daily_drawer_wastage', 'text_with_add_more', 'total'),
            array('CZ WASTAGE', 'cz_wastage', 'text_with_add_more', 'total'),
            array('ML Wastage', 'melting_wastage', 'text', '', 'total'),
            array('LOSS', 'loss', 'text', 'total', '')),
        balance_structure('balance', '', 'balance_fine'));
    
    return $structure[$process];
}

function gpc_structure($process = '', $department_name = '')
{
    $text = 'text_with_add_more';
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        gpc_out_common_structure($text, '', '', '', 'text', 'text'),

        array(array('MICRO COATING', 'micro_coating', 'text', 'total', '')),
        array(array('QC Out', 'out_weight', 'text', '', '')),
        //array(array('MICRO COATING', 'micro_coating', 'text','total','')),
        balance_structure('balance', '', 'balance_fine'));
    $structure['rope_chain_final_process'] = array_merge(
        array(array('PARENT LOT NO', 'parent_lot_name', 'label_with_text', ''),
            array('Input Type', 'input_type', 'label_with_text', ''),
            array('LOT PURITY ', 'in_lot_purity', 'label_with_value', '', ''),
            array('IN', 'in_weight', 'label_with_value', 'total', ''),
            array('IN PURITY ', 'in_purity', 'label_with_value', '', '')),
        gpc_out_common_structure('text_with_add_more', '', '', '', 'text', 'text'),
        array(array('Melting Wastage', 'melting_wastage', 'text', 'total', '')),
        array(array('MICRO COATING', 'micro_coating', 'text', 'total', '')),
        balance_structure('balance', '', 'balance_fine'));
    $structure['refresh'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Out', 'out_weight', 'text', 'total', '')),
        refresh_gpc_out_common_structure('text', '', '', '', 'text', 'text'),
        array(array('Stone Vatav', 'stone_vatav', 'text_with_add_more', 'total')),
        array(array('Karigar', 'karigar', 'label_with_value', '', '')),
        array(array('MICRO COATING', 'micro_coating', 'text', 'total', '')),
        array(array('Description', 'description', 'label_with_value', '', '')),
        balance_structure('balance', '', 'balance_fine', 'tounch_loss_fine'));

    $structure['refresh_final_process'] = array_merge(array(array('Chain', 'product_name', 'label_with_text', '', '')),
        in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Out', 'gpc_out', 'label_with_value', 'total', '')),
        array(array('Description', 'description', 'label_with_value', '', '')),
        balance_structure('balance', '', 'balance_fine'));
   
    return $structure[$process];
}
function refresh_repairing_structure($process = '', $department_name = '')
{
        $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
            out_common_structure('text'),
            array(array('Karigar', 'karigar', 'label_with_value', '', '')),
            array(array('Quantity', 'quantity', 'text', '', '')),
            hook_in_structure(array('Hook', 'KDM', 'Lobster')),
            hook_out_structure(array('Hook', 'KDM', 'Lobster')),
            design_detail_common_structure('', '', 'karigar'),
            array(array('Description', 'description', 'label_with_value', '', '')),
            wastage_loss_structure('daily_drawer_wastage', 'wastage', 'loss'),
            balance_structure('balance', '', 'balance_fine'));
    $structure['refresh'] = $structure['common'];
    return $structure[$process];
}

function refresh_hold_structure($process = '', $department_name = '')
{
        $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
            array(array('Out Weight', 'out_weight', 'text_with_add_more', 'total', '',
                array(array('label' => 'Out Weight', 'field_type' => 'text',
                    'database_column' => 'out_weight'),
                    array('label' => 'Karigar', 'field_type' => 'dropdown',
                        'database_column' => 'karigar',
                        'options' => get_karigars()),
                    array('label' => 'Next Dept', 'field_type' => 'dropdown',
                        'database_column' => 'next_department_name',
                        'options' => array(array('name' => 'Other', 'id' => 'Other')),
                    ),
                ))),
            //array(array('Quantity', 'quantity', 'text', '', '')),
            //hook_in_structure(array('Hook','KDM','Lobster')),
            //hook_out_structure(array('Hook','KDM','Lobster')),
            design_detail_common_structure('', '', 'karigar'),
            wastage_loss_structure('daily_drawer_wastage', 'wastage', 'loss'),
            array(array('Description', 'description', 'label_with_text', '', '')),
            balance_structure('balance', '', 'balance_fine'));

    $structure['refresh_hold'] = $structure['common'];
    return $structure[$process];
}

function filing_structure($process = '', $department_name = '')
{
    $structure['casting_process_filing_processes'] = $structure['arc_customer_order_chain_filing'] = array_merge(
        in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Karigar', 'karigar', 'label_with_text', '')),
        array(array('Out Weight', 'out_weight', 'text_with_add_more', 'total', '',
            array(array('label' => 'Out Weight', 'field_type' => 'text',
                'database_column' => 'out_weight'),
                array('label' => 'Process', 'field_type' => 'dropdown',
                    'database_column' => 'next_department_name',
                    'options' => array(
						array('name' => 'Filing', 'id' => 'Filing'),
                        array('name' => 'Stone Setting', 'id' => 'Stone Setting'),
                        array('name' => 'Polish', 'id' => 'Polish'),
                        array('name' => 'Final', 'id' => 'Final'),
                        ),
                    )))),
        hook_in_structure(array('Hook', 'KDM', 'Lobster')),
        hook_out_structure(array('Hook', 'KDM', 'Lobster')),
        wastage_loss_structure('melting_wastage', 'wastage', '', '', false),
        array(array('DD WASTAGE', 'daily_drawer_wastage', 'text_with_add_more', 'total')),
        
        ghiss_structure('text_with_add_more'),
        //tounch_structure(),
        array(array('Loss', 'loss', 'text_with_add_more', '', '')),
        tounch_structure(),
        balance_structure('balance', 'balance_gross', 'balance_fine'));
    return $structure[$process];
}
function final_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', 'in_purity', $department_name),
        out_common_structure('text'),
        wastage_loss_structure('melting_wastage', 'wastage', 'loss'),
        balance_structure('balance', 'balance_gross', 'balance_fine'));
    $structure['casting_process_final_processes'] =array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Tounch Purity', 'tounch_purity', 'label_with_value', '', '')),

        array(array('GPC Out', 'gpc_out', 'text_with_add_more', '', '')),
        array(array('GPC Quantity', 'quantity', 'label_with_value', '', '')),
        wastage_loss_structure('daily_drawer_wastage', 'wastage', ''),
        array(array('wastage Quantity', 'repair_out_quantity', 'text', '', '')),
        ghiss_structure('text_with_add_more'),

        array(array('Loss', 'loss', 'text', '', 'total')),
        array(array('Tounch Loss Fine', 'tounch_loss_fine', 'label_with_value', '', '')),
        array(array('MICRO COATING', 'micro_coating', 'text', 'total', '')),
        // array(array('QC Out', 'out_weight','text', '', '')),
        balance_structure('balance', '', 'balance_fine'));
        return $structure[$process];
}


function casting_structure($process = '', $department_name = '', $sub_department_name="")
{
    $structure['casting_process_casting_processes'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name,$sub_department_name),
        array(array('Out Weight', 'out_weight', 'text_with_add_more', 'total', '',
            array(array('label' => 'Out Weight', 'field_type' => 'text',
                'database_column' => 'out_weight'),
                array('label' => 'Next Department', 'field_type' => 'dropdown', 'database_column' => 'next_department_name', 'options' => array(
                     array('id' => 'Filing', 'name' => 'Filing'),
                     array('id' => 'Polish', 'name' => 'Polish'),
                     array('id' => 'Stone Setting', 'name' => 'Stone Setting'),
                     array('id' => 'Final', 'name' => 'Final'),
                    )),
            array('label' => 'Karigar', 'field_type' => 'dropdown',
                    'database_column' => 'next_department_karigar',
                    'options' => get_karigar_name())
          ))),
        
        wastage_loss_structure('melting_wastage', 'wastage', '', '', false),
        array(array('DD WASTAGE', 'daily_drawer_wastage', 'text_with_add_more', 'total')),
        
        tounch_structure(),
        ghiss_structure('text_with_add_more'),
        array(array('Loss', 'loss', 'text_with_add_more', '', '')),
          balance_structure('balance', 'balance_gross', 'balance_fine'));
    //$structure['common'];
  
    return $structure[$process];
}

function stone_setting_structure($process = '', $department_name = '')
{
    $structure['casting_process_stone_setting_processes'] =array_merge(
        in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Karigar', 'karigar', 'text_with_add_more', '', '',
            array(
                array('label' => 'Karigar', 'field_type' => 'dropdown',
                    'database_column' => 'karigar',
                    'options' => process_wise_karigar_name('', '', 'Stone Setting RND'))))),

        array(array('Out Weight', 'out_weight', 'text_with_add_more', 'total', '',
            array(array('label' => 'Out Weight', 'field_type' => 'text',
                'database_column' => 'out_weight'),
                array('label' => 'Process', 'field_type' => 'dropdown',
                    'database_column' => 'next_department_name',
                    'options' => array(
                        array('name' => 'Filing', 'id' => 'Filing'),
                        array('name' => 'Polish', 'id' => 'Polish'),
                        array('name' => 'Stone Setting', 'id' => 'Stone Setting'),
                        array('name' => 'Final', 'id' => 'Final'),
                       ))))),
        wastage_loss_structure('melting_wastage', 'wastage', '', '', false),
        array(array('DD WASTAGE', 'daily_drawer_wastage', 'text_with_add_more', 'total')),
        
        ghiss_structure('text_with_add_more'),
        array(array('Loss', 'loss', 'text_with_add_more', '', '')),
         balance_structure('balance', 'balance_gross', 'balance_fine'));
    
    return $structure[$process];
}




function round_and_ball_chain_cutting_structure($process = '', $department_name = '')
{
    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        out_common_structure('text'),
        wastage_loss_structure('daily_drawer_wastage', 'wastage', 'loss', ''),
        array(array('GHISS', 'ghiss', 'text', 'total', '')),
        balance_structure('balance', '', 'balance_fine'));
    return $structure[$process];
}
function flatting_structure($process = '', $department_name = '')
{

    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name), array(array('Description', 'description', 'label_with_value', '', '')),
        array(array('Karigar', 'karigar', 'karigar_dropdown', '')),
        
        array(array('OUT WEIGHT', 'out_weight', 'text', 'total', '')),
        array(array('OUT LOT PURITY', 'out_lot_purity', 'label_with_value', '', '')),
        wastage_loss_structure('melting_wastage', 'wastage', 'loss', '', false),
        balance_structure('balance', 'balance_gross', 'balance_fine', ''));
    $structure['rope_chain_melting_process'] = $structure['common'];
    $structure['office_outside_common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        out_common_structure('text'),
        wastage_loss_structure('melting_wastage', 'wastage', 'loss', '', false),
        balance_structure('balance', '', 'balance_fine'));
    
    $structure['office_outside_kdm'] = $structure['office_outside_common'];
    return $structure[$process];
}
function stamping_structure($process = '', $department_name = '')
{

    $structure['common'] = array_merge(in_common_structure('in_lot_purity', 'in_weight', '', $department_name),
        array(array('Out Weight', 'out_weight', 'text_with_add_more', 'total', '',
            array(array('label' => 'Out Weight', 'field_type' => 'text', 'database_column' => 'out_weight'),
                array('label' => 'Karigar', 'field_type' => 'dropdown',
                    'database_column' => 'next_department_karigar',
                    'options' => get_karigar_name())))),
        wastage_loss_structure('melting_wastage', 'wastage', 'loss', 'wastage', false),
        // array(array('Closing', 'closing_out', 'text', 'total', '')),

        balance_structure('balance', '', 'balance_fine'));
       $structure['office_outside_kdm'] = $structure['common'];
    return $structure[$process];
}

















