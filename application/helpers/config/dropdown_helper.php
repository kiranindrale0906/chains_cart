<?php
function get_dropdown_array($simple_array, $empty_value=false) {
  $dropdown_array = array();
  if ($empty_value)
    $dropdown_array[] = array('id' => '', 'name' => '');
  if (empty($simple_array)) return $dropdown_array;
  foreach($simple_array as $array_item) {
    $dropdown_array[] = array('id' => $array_item, 'name' => $array_item);
  }
  return $dropdown_array;
}

function get_sisma_karigar_names() {
  return array(array('name' => 'ARC', 'id' => 'ARC'),
               array('name' => 'ARF', 'id' => 'ARF'),
               array('name' => 'Amit', 'id' => 'Amit'),
               array('name' => 'Ashish', 'id' => 'Ashish'),
               array('name' => 'Bappy Nawabi-Sisma', 'id' => 'Bappy Nawabi-Sisma'),
               array('name' => 'Kashinath', 'id' => 'Kashinath'),
               array('name' => 'Kumar', 'id' => 'Kumar'),
               array('name' => 'Suman', 'id' => 'Suman'),
               array('name' => 'Shyam sundar', 'id' => 'Shyam sundar'),
               array('name' => 'Pappu', 'id' => 'Pappu'),
               array('name' => 'Ganesh RND', 'id' => 'Ganesh RND'),
               array('name' => 'Ansari', 'id' => 'Ansari'),
               array('name' => 'Office', 'id' => 'Office'),
               ); 
}

function get_purity() {
  return array(array('id' => '92', 'name' => '92'),
               array('id' => '88', 'name' => '88'),
               array('id' => '87.65', 'name' => '87.65'),
               array('id' => '83.65', 'name' => '83.65'),
               array('id' => '83.50', 'name' => '83.50'),
               array('id' => '75.00', 'name' => '75.00'),
               array('id' => '75.15', 'name' => '75.15'),
               array('id' => '58.50', 'name' => '58.50'));
}

function get_skip_department() {
  return array(array('name' => 'No', 'id' => 'No', 'selected' => 'selected'),
               array('name'=> 'Yes', 'id' => 'Yes'));
}
function get_factory_karigar(){
  return array(array('name' => 'Factory', 'id' => 'factory'),
               array('name'=> 'Karigar', 'id' => 'karigar'));
}
function get_length() {
  return array(array('name' => '8 inch', 'id' => '8 inch'),
               array('name' => '16 inch', 'id' =>'16 inch'),
               array('name' => '18 inch', 'id' =>'18 inch'),
               array('name' => '22 inch', 'id' =>'22 inch'),
               array('name' => '26 inch', 'id' =>'26 inch'));
}

function get_flatting_machine_size() {
  return array(array('name' => '40', 'id' => '40'),
               array('name' => '50', 'id' =>'50'),
               array('name' => '60', 'id' =>'60'),
               array('name' => '80', 'id' =>'80'));
}

function get_issue_department_product_names() {
  if(HOST=='Hallmark'){ 
  $issue_department_product_names =  array(array('name'=> 'Huid', 'id' => 'Huid'),
                                           array('name'=> 'Hallmark Receipt', 'id' => 'Hallmark Receipt'));
  }elseif(HOST=='Export'){ 
  $issue_department_product_names =  array(array('name'=> 'Export Internal', 'id' => 'Export Internal'),array('name'=> 'Packing Slip', 'id' => 'Packing Slip'));
  }elseif(HOST=='Domestic'){ 
  $issue_department_product_names =  array(array('name'=> 'Domestic Internal', 'id' => 'Domestic Internal'),array('name'=> 'QC Out', 'id' => 'QC Out'));
  }elseif($_SESSION['name']=="Room"){ 

  $issue_department_product_names =  array(array('name'=> 'Hallmark Out', 'id' => 'Hallmark Out'));
  }else{
  $issue_department_product_names =  array(/*array('name'=> 'Daily Drawer Wastage', 'id' => 'Daily Drawer Wastage'),
                                           array('name'=> 'Melting Wastage', 'id' => 'Melting Wastage'),
                                           // array('name'=> 'Huid', 'id' => 'Huid'),
                                           array('name'=> 'HCL Loss', 'id' => 'HCL Loss'),
                                           array('name'=> 'Refine Loss', 'id' => 'Refine Loss'),
                                           array('name'=> 'Tounch Loss Fine', 'id' => 'Tounch Loss Fine'),
                                           array('name'=> 'Cutting Ghiss', 'id' => 'Cutting Ghiss'),
                                           array('name'=> 'Ice Cutting Ghiss', 'id' => 'Ice Cutting Ghiss'),
                                           array('name'=> 'Hand Cutting Ghiss', 'id' => 'Hand Cutting Ghiss'),
                                           array('name'=> 'Hand Dull Ghiss', 'id' => 'Hand Dull Ghiss'),
                                           array('name'=> 'Sand Dull Ghiss', 'id' => 'Sand Dull Ghiss'),
                                           array('name'=> 'Ghiss Melting Loss', 'id' => 'Ghiss Melting Loss'),
                                           array('name'=> 'Fire Tounch Loss', 'id' => 'Fire Tounch Loss'),
                                           array('name'=> 'Hallmark Out', 'id' => 'Hallmark Out'),*/
                                           array('name'=> 'Select', 'id' => ''),
                                           array('name'=> 'GPC Out', 'id' => 'GPC Out'),
                                          /* array('name'=> 'GPC Repair Out', 'id' => 'GPC Repair Out'),
                                           array('name'=> 'GPC Loss Out', 'id' => 'GPC Loss Out'),
                                           array('name'=> 'Finish Good', 'id' => 'Finish Good'),
                                           array('name'=> 'Castic Loss', 'id' => 'Castic Loss'),
                                           array('name'=> 'Finished Goods Receipt', 'id' => 'Finished Goods Receipt'),
                                           array('name'=> 'Chitti Out', 'id' => 'Chitti Out')*/);
  }
  return $issue_department_product_names;
}


function get_chain_names() {
  if(HOST=='ARF'){
      return array(
               array('name'=> 'KA Chain', 'id' => 'KA Chain'),
               array('name'=> 'Fancy Chain', 'id' => 'Fancy Chain'),
               array('name'=> 'Fancy 75 Chain', 'id' => 'Fancy 75 Chain'),
               array('name'=> 'Ball Chain', 'id' => 'Ball Chain'),
               array('name'=> 'IMP Premium Chain', 'id' => 'IMP Premium Chain'),
               array('name'=> 'Omega Chain', 'id' => 'Omega Chain'),
               array('name'=> 'Stone Chain', 'id' => 'Stone Chain'),
               array('name'=> 'Sisma ARF Chain', 'id' => 'Sisma ARF Chain'),
               array('name'=> 'Morocco Collection', 'id' => 'Morocco Collection'));   
  }else if(HOST=='ARC'){
      return array(
               array('name'=> 'Ring', 'id' => 'Ring'),
               array('name'=> 'Ring 75', 'id' => 'Ring 75'),
               array('name'=> 'Pendant', 'id' => 'Pendant'),
               array('name'=> 'Bracelet', 'id' => 'Bracelet'),
               array('name'=> 'Kuwaitis', 'id' => 'Kuwaitis'),
               array('name'=> 'Pendant 75', 'id' => 'Pendant 75'),
               array('name'=> 'Chain 92', 'id' => 'Chain 92'),
               array('name'=> 'Chain 75', 'id' => 'Chain 75'),
               array('name'=> 'Pro 92', 'id' => 'Pro 92'),
               array('name'=> 'Pro 75', 'id' => 'Pro 75'),
               array('name'=> 'Stone Ring 92', 'id' => 'Stone Ring 92'),
               array('name'=> 'Stone Ring 75', 'id' => 'Stone Ring 75'),
               array('name'=> 'Plain Ring', 'id' => 'Plain Ring'),
               array('name'=> 'Lock Process', 'id' => 'Lock Process'),
               array('name'=> 'Pendent Set', 'id' => 'Pendent Set'),
               array('name'=> 'Pendent Set 75', 'id' => 'Pendent Set 75'),
               array('name'=> 'Pendent Set Plain', 'id' => 'Pendent Set Plain'));   
  }else{
      return array(array('name'=> 'Choco Chain', 'id' => 'Choco Chain'),
                   array('name'=> 'Rolex Chain', 'id' => 'Rolex Chain'),
                   array('name'=> 'Hollow Choco Chain', 'id' => 'Hollow Choco Chain'),
                   array('name'=> 'Lotus Chain', 'id' => 'Lotus Chain'),
                   array('name'=> 'Lopster Making Chain', 'id' => 'Lopster Making Chain'),
                   array('name'=> 'Hollow Bangle Chain', 'id' => 'Hollow Bangle Chain'),
                   array('name'=> 'Roco Choco Chain', 'id' => 'Roco Choco Chain'),
                   array('name'=> 'Nawabi Chain', 'id' => 'Nawabi Chain'),
                   array('name'=> 'Casting 92 Chain', 'id' => 'Casting 92 Chain'),
                   array('name'=> 'Casting 75 Chain', 'id' => 'Casting 75 Chain'),
                   array('name'=> 'Imp Italy Chain', 'id' => 'Imp Italy Chain'),
                   array('name'=> 'Machine Chain', 'id' => 'Machine Chain'),
                   array('name'=> 'Solid Machine Chain', 'id' => 'Solid Machine Chain'),
                   array('name'=> 'Rope Chain', 'id' => 'Rope Chain'),
                   array('name'=> 'Solid Rope Chain', 'id' => 'Solid Rope Chain'),
                   array('name'=> 'Solid Nawabi Chain', 'id' => 'Solid Nawabi Chain'),
                   array('name'=> 'Round Box Chain', 'id' => 'Round Box Chain'),
                   array('name'=> 'Indo tally Chain', 'id' => 'Indo tally Chain'),
                   array('name'=> 'Fancy Chain', 'id' => 'Fancy Chain'),
                   array('name'=> 'Fancy 75 Chain', 'id' => 'Fancy 75 Chain'),
                   array('name'=> 'Sisma Chain', 'id' => 'Sisma Chain'));
  }
}

function get_product_names() {
  if(HOST=='ARF'){
      return array(
               array('name'=> 'KA Chain', 'id' => 'KA Chain'),
               array('name'=> 'Fancy Chain', 'id' => 'Fancy Chain'),
               array('name'=> 'Fancy 75 Chain', 'id' => 'Fancy 75 Chain'),
               array('name'=> 'Daily Drawer Wastage', 'id' => 'Daily Drawer Wastage'),
               array('name'=> 'Melting Wastage', 'id' => 'Melting Wastage'),
               array('name'=> 'Repair Out', 'id' => 'Repair Out'),
               array('name'=> 'Tounch Loss Fine', 'id' => 'Tounch Loss Fine'),
               array('name'=> 'Sisma ARF Chain', 'id' => 'Sisma ARF Chain'),
               array('name'=> 'Cutting Ghiss', 'id' => 'Cutting Ghiss'));   
  }else if(HOST=='ARC'){
      return array(
               array('name'=> 'Ring', 'id' => 'Ring'),
               array('name'=> 'Ring 75', 'id' => 'Ring 75'),
               array('name'=> 'Pendant', 'id' => 'Pendant'),
               array('name'=> 'Kuwaitis', 'id' => 'Kuwaitis'),
               array('name'=> 'Bracelet', 'id' => 'Bracelet'),
               array('name'=> 'Pendant 75', 'id' => 'Pendant 75'),
               array('name'=> 'Chain 92', 'id' => 'Chain 92'),
               array('name'=> 'Chain 75', 'id' => 'Chain 75'),
               array('name'=> 'Pro 92', 'id' => 'Pro 92'),
               array('name'=> 'Pro 75', 'id' => 'Pro 75'),
               array('name'=> 'Stone Ring 92', 'id' => 'Stone Ring 92'),
               array('name'=> 'Stone Ring 75', 'id' => 'Stone Ring 75'),
               array('name'=> 'Plain Ring', 'id' => 'Plain Ring'),
               array('name'=> 'Lock Process', 'id' => 'Lock Process'),
               array('name'=> 'Pendent Set', 'id' => 'Pendent Set'),
               array('name'=> 'Pendent Set 75', 'id' => 'Pendent Set 75'),
               array('name'=> 'Pendent Set Plain', 'id' => 'Pendent Set Plain'),
               array('name'=> 'Daily Drawer Wastage', 'id' => 'Daily Drawer Wastage'),
               array('name'=> 'Melting Wastage', 'id' => 'Melting Wastage'),
               array('name'=> 'Repair Out', 'id' => 'Repair Out'),
               array('name'=> 'Tounch Loss Fine', 'id' => 'Tounch Loss Fine'),
               array('name'=> 'Cutting Ghiss', 'id' => 'Cutting Ghiss'));   
  }else{
      return array(array('name'=> 'Choco Chain', 'id' => 'Choco Chain'),
                   array('name'=> 'Rolex Chain', 'id' => 'Rolex Chain'),
                   array('name'=> 'Daily Drawer Wastage', 'id' => 'Daily Drawer Wastage'),
                   array('name'=> 'Hollow Choco Chain', 'id' => 'Hollow Choco Chain'),
                   array('name'=> 'Lotus Chain', 'id' => 'Lotus Chain'),
                   array('name'=> 'Lopster Making Chain', 'id' => 'Lopster Making Chain'),
                   array('name'=> 'Hollow Bangle Chain', 'id' => 'Hollow Bangle Chain'),
                   array('name'=> 'Roco Choco Chain', 'id' => 'Roco Choco Chain'),
                   array('name'=> 'Nawabi Chain', 'id' => 'Nawabi Chain'),
                   array('name'=> 'Casting 92 Chain', 'id' => 'Casting 92 Chain'),
                   array('name'=> 'Casting 75 Chain', 'id' => 'Casting 75 Chain'),
                   array('name'=> 'Hand Made Chain', 'id' => 'Hand Made Chain'),
                   array('name'=> 'Dus Collection', 'id' => 'Dus Collection'),
                   array('name'=> 'Imp Italy Chain', 'id' => 'Imp Italy Chain'),
                   array('name'=> 'Machine Chain', 'id' => 'Machine Chain'),
                   array('name'=> 'Solid Machine Chain', 'id' => 'Solid Machine Chain'),
                   array('name'=> 'Melting Wastage', 'id' => 'Melting Wastage'),
                   array('name'=> 'Rope Chain', 'id' => 'Rope Chain'),
                   array('name'=> 'Solid Rope Chain', 'id' => 'Solid Rope Chain'),
                   array('name'=> 'Solid Nawabi Chain', 'id' => 'Solid Nawabi Chain'),
                   array('name'=> 'Round Box Chain', 'id' => 'Round Box Chain'),
                   // array('name'=> 'Refresh', 'id' => 'Refresh'),
                   array('name'=> 'Indo tally Chain', 'id' => 'Indo tally Chain'),
                   array('name'=> 'Fancy Chain', 'id' => 'Fancy Chain'),
                   array('name'=> 'KA Chain', 'id' => 'KA Chain'),
                   array('name'=> 'Stone Ring 92', 'id' => 'Stone Ring 92'),
                   array('name'=> 'Sisma Chain', 'id' => 'Sisma Chain'),
                   array('name'=> 'Repair Out', 'id' => 'Repair Out'),
                   array('name'=> 'HCL Loss', 'id' => 'HCL Loss'),
                   array('name'=> 'Tounch Loss Fine', 'id' => 'Tounch Loss Fine'),
                   array('name'=> 'Cutting Ghiss', 'id' => 'Cutting Ghiss'));
  }
}

function get_process_names() {
  return array(array('name' => 'AG', 'id' => 'AG'),
               array('name' => 'AG Flatting', 'id' => 'AG Flatting'),
               array('name' => 'Machine Process', 'id' => 'Machine Process'),
               array('name' => 'Final Process', 'id' => 'Final Process'),
               array('name' => 'Hooks', 'id' => 'Hooks'),
               array('name' => 'KDMs', 'id' => 'KDMs'));  
}

function get_all_department_names() {
return  array(array('name' => 'Start', 'id' => 'Start'),
             array('name' => 'Melting', 'id' =>'Melting'),
             array('name' => 'Flatting', 'id' =>'Flatting'),
             array('name' => 'AU+FE', 'id' =>'AU_FE'),
             array('name' => 'Bull Block', 'id' =>'Bull Block'),
             array('name' => 'Tarpatta', 'id' =>'Tarpatta'),
             array('name' => 'Wire Drawing', 'id' =>'Wire Drawing'),
             array('name' => 'AG Melting', 'id' => 'AG Melting'),
             array('name' => 'Machine Department', 'id' => 'Machine Department'),
             array('name' => 'Joining Department', 'id' =>'Joining Department'),
             array('name' => 'Walnut Shampoo', 'id' =>'Walnut Shampoo'),
             array('name' => 'HCL', 'id' =>'HCL'),
             array('name' => 'Castic Process', 'id' =>'Castic Process'),
             array('name' => 'Hook', 'id' =>'Hook'),
             array('name' => 'Polish', 'id' =>'Polish'),
             array('name' => 'GPC', 'id' =>'GPC'),
             ); 
}

function get_office_ouside_product_name(){
  if(HOST=='ARF'){
    return array('"Office Outside ARF KDM"',
                 '"Office Outside Cap"',
                 '"Office Outside S"',
                 '"Office Outside Mesh Gope"',
                 '"Office Outside Lobster"',
                 '"Office Outside Lasiya"',
                 '"Office Outside Tar"',
                 '"Office Outside Pipe"'
                  );
  }else{
    return array('"Office Outside ARF KDM"',
                '"Office Outside Ball"',
                '"Office Outside Cap"',
                '"Office Outside Cutting Pipe"',
                '"Office Outside Cutting Wire"',
                '"Office Outside Hard Wire"',
                '"Office Outside Hollow Pipe"',
                '"Office Outside Hook"',
                '"Office Outside Kdm"',
                '"Office Outside Lobster"',
                '"Office Outside Solid Pipe"',
                '"Office Outside Solid Wire"'
            );
  };
}

function get_process($key='') {
 
  return array(
            array('name'=>'Rope Chain','id' =>'Rope Chain'),
            array('name'=>'Office Outside Hook','id' =>'Office Outside Hook'),
            array('name'=>'Office Outside KDM','id' =>'Office Outside KDM'),
            array('name'=>'Office Outside Lobster','id' =>'Office Outside Lobster'),
            array('name'=>'Office Outside Solid Pipe','id' =>'Office Outside Solid Pipe'),
            array('name'=>'Refresh','id' =>'Refresh'),
    );
}
function get_process_refresh($key='') {
  if(HOST=='ARF'){
    return array( array('name' => 'KA Chain',               'id' => 'KA Chain'),
                  array('name' => 'Ball Chain',               'id' => 'ball Chain'),
                  array('name' => 'Ball Chain',               'id' => 'Ball Chain'),
                  array('name' => 'KA Chain Refresh',       'id' => 'KA Chain Refresh'),
                  array('name' => 'Nano Process',           'id' => 'Nano Process'),
                  array('name' => 'I 10 Process',           'id' => 'I 10 Process'),
                  array('name' => 'Dhoom A',                'id' => 'Dhoom A'),
                  array('name' => 'Dhoom B',                'id' => 'Dhoom B'),
                  array('name' => 'Refresh', 'id' => 'Refresh'),
                  array('name' => 'Office Outside ARF KDM', 'id' => 'Office Outside ARF KDM'),
                  array('name' => 'Office Outside Mesh Gope', 'id' => 'Office Outside Mesh Gope'),
                  array('name' => 'Office Outside Cap',     'id' => 'Office Outside Cap'),
                  array('name' => 'Office Outside S',       'id' => 'Office Outside Shook'),
                  array('name' => 'Office Outside Pipe',    'id' => 'Office Outside Pipe'),
                  array('name' => 'Office Outside Lasiya',  'id' => 'Office Outside Lasiya'),
                  array('name' => 'Office Outside Para',    'id' => 'Office Outside Para'),
                  array('name' => 'Office Outside Tar',     'id' => 'Office Outside Tar'),
                  array('name'=>'Office Outside Lobster','id' =>'Office Outside Lobster'),
                  array('name' => 'Fancy Chain',            'id' => 'Fancy Chain'),
                  array('name' => 'Fancy 75 Chain',            'id' => 'Fancy 75 Chain'),
                  array('name' => 'Finished Goods Receipt', 'id' => 'Finished Goods Receipt'),
                  );
  }elseif(HOST=='AR Gold Internal'){
    return array(
            array('name'=>'Rope Chain','id' =>'Rope Chain Internal'),
            array('name'=>'Machine Chain','id' =>'Machine Chain Internal'),
            array('name'=>'Choco Chain','id' =>'Choco Chain Internal'),
            array('name'=>'Rolex Chain','id' =>'Rolex Chain Internal'),
            array('name'=>'Imp Italy Chain','id' =>'Imp Italy Chain Internal'), 
            array('name'=>'Indo tally Chain','id' =>'Indo tally Chain Internal'), 
            array('name'=>'Hollow Choco Chain','id' =>'Hollow Choco Chain Internal'),
            array('name'=>'Round Box Chain','id' =>'Round Box Chain Internal'),
          );
  }else if(HOST=='ARC'){
    return array(
            array('name'=> 'Ring', 'id' => 'Ring'),
            array('name'=> 'Ring 75', 'id' => 'Ring 75'),
            array('name'=> 'Pendant', 'id' => 'Pendant'),
            array('name'=> 'Bracelet', 'id' => 'Bracelet'),
            array('name'=> 'Kuwaitis', 'id' => 'Kuwaitis'),
            array('name'=> 'Pendant 75', 'id' => 'Pendant 75'),
            array('name'=> 'Chain 92', 'id' => 'Chain 92'),
            array('name'=> 'Chain 75', 'id' => 'Chain 75'),
            array('name'=> 'Pro 92', 'id' => 'Pro 92'),
            array('name'=> 'Pro 75', 'id' => 'Pro 75'),
            array('name'=> 'Stone Ring 92', 'id' => 'Stone Ring 92'),
            array('name'=> 'Stone Ring 75', 'id' => 'Stone Ring 75'),
            array('name'=> 'Stone Ring 92', 'id' => '+'),
            array('name'=> 'Stone Ring 75', 'id' => 'Stone Ring 75'),
            array('name'=> 'Plain Ring', 'id' => 'Plain Ring'),
            array('name'=> 'Lock Process', 'id' => 'Lock Process'),
            array('name'=> 'Pendent Set', 'id' => 'Pendent Set'),
            array('name'=> 'Pendent Set 75', 'id' => 'Pendent Set 75'),
            array('name'=> 'Pendent Set Plain', 'id' => 'Pendent Set Plain'),
            array('name'=>'Office Outside ARF KDM','id' =>'Office Outside ARF KDM'),
            array('name'=>'Office Outside Mesh Gope','id' =>'Office Outside Mesh Gope'),
            array('name'=>'Office Outside Cap','id' =>'Office Outside Cap'),
            array('name'=>'Office Outside S','id' =>'Office Outside Shook'),
            );
  }else{
  return array(
            array('name' => 'ARC', 'id' => 'ARC'),
            array('name'=>'Choco Chain','id' =>'Choco Chain'),
            array('name'=>'Rolex Chain','id' =>'Rolex Chain'),
            array('name'=>'Dus Collection','id' =>'Dus Collection'),
            array('name'=>'Fancy Chain','id' =>'Fancy Chain'),
            array('name'=>'Hollow Choco Chain','id' =>'Hollow Choco Chain'), 
            array('name'=>'Lotus Chain','id' =>'Lotus Chain'),
            array('name'=>'Lopster Making Chain','id' =>'Lopster Making Chain'),
            array('name'=>'Hollow Bangle Chain','id' =>'Hollow Bangle Chain'),
            array('name'=>'Roco Choco Chain','id' =>'Roco Choco Chain'),
            array('name'=>'Nawabi Chain','id' =>'Nawabi Chain'), 
            array('name'=>'Casting 92 Chain','id' =>'Casting 92 Chain'), 
            array('name'=>'Casting 75 Chain','id' =>'Casting 75 Chain'), 
            array('name'=> 'Hand Made Chain', 'id' => 'Hand Made Chain'),
            array('name'=>'Imp Italy Chain','id' =>'Imp Italy Chain'), 
            array('name'=>'Indo tally Chain','id' =>'Indo tally Chain'), 
            array('name'=>'Machine Chain','id' =>'Machine Chain'),
            array('name'=>'Solid Machine Chain','id' =>'Solid Machine Chain'),
            array('name'=>'Office Outside ARF KDM','id' =>'Office Outside ARF KDM'),
            array('name'=>'Office Outside Mesh Gope','id' =>'Office Outside Mesh Gope'),
            array('name'=>'Office Outside Ball','id' =>'Office Outside Ball'),
            array('name'=>'Office Outside Cap','id' =>'Office Outside Cap'),
            array('name'=>'Office Outside Cutting Pipe','id' =>'Office Outside Cutting Pipe'),
            array('name'=>'Office Outside Cutting Wire','id' =>'Office Outside Cutting Wire'),
            array('name'=>'Office Outside Hard Wire','id' =>'Office Outside Hard Wire'),
            array('name'=>'Office Outside Hollow Pipe','id' =>'Office Outside Hollow Pipe'),
            array('name'=>'Office Outside Hook','id' =>'Office Outside Hook'),
            array('name'=>'Office Outside KDM','id' =>'Office Outside KDM'),
            array('name'=>'Office Outside Lobster','id' =>'Office Outside Lobster'),
            array('name'=>'Office Outside Solid Pipe','id' =>'Office Outside Solid Pipe'),
            array('name'=>'Office Outside Solid Wire','id' =>'Office Outside Solid Wire'),
            array('name'=>'Office Outside S','id' =>'Office Outside Shook'),
            // array('name'=>'Refresh','id' =>'Refresh'),
            array('name'=>'Rope Chain','id' =>'Rope Chain'),
            array('name'=>'Solid Rope Chain','id' =>'Solid Rope Chain'),
            array('name'=>'Solid Nawabi Chain','id' =>'Solid Nawabi Chain'),
            array('name'=>'Round Box Chain','id' =>'Round Box Chain'),
            array('name'=>'Sisma Chain','id' =>'Sisma Chain'),
            array('name'=>'Refresh','id' =>'Refresh'),
    );
  }
}

function get_process_for_issue_daily_drawer($options) {
  foreach ($options as $index => $option) {
    $processes[] = array('name' => $option,'id'=>$option);
  }
  return $processes;
}

function get_database_name_from_account($process_name) {
  $database_name = array('Hollow Choco Chain' => 'argold_hollowchocochain_production',
                         'Imp Italy Chain' => 'argold_impitalychain_production',
                         'Machine Chain' => 'argold_machinechain_production',
                         'Choco Chain' => 'argold_chocochain_production',
                         'Rolex Chain' => 'argold_rolexchain_production',
                         'Rope Chain' => 'argold_ropechain_production',
                         'Round Box Chain' => 'argold_roundboxchain_production',
                         'Fancy Chain' => 'argold_fancychain_production',
                         'Indo tally Chain' => 'argold_indotallychain_production', 
                         'Refresh' => 'argold_refresh_production',
                         'Sisma Chain' => 'argold_sismachain_production',
                         'ARC' => 'argold_arcs_production',
                         'Office Outside' =>'argold_dailydrawer_production');
  return $database_name[$process_name];
}
function get_database_name_from_factory_and_version($hostversion) {
  $database_name = array('ARC JAN21' =>array('database'=>ARC_DB_NAME,'url'=>ARC_URL) ,
                         'ARF JAN21' => array('database'=>ARF_DB_NAME,'url'=>ARF_URL),
                         'AR Gold JAN21' => array('database'=>ARGOLD_DB_NAME,'url'=>ARGOLD_URL),
                         // 'ARC Nov 20' =>array('database'=>NOV_ARC_DB_NAME,'url'=>NOV_ARC_URL) ,
                         // 'ARF Nov 20' =>array('database'=>NOV_ARF_DB_NAME,'url'=>NOV_ARF_URL) ,
                         // 'AR Gold Nov 20' =>array('database'=>NOV_ARGOLD_DB_NAME,'url'=>NOV_ARGOLD_URL) ,
                         );
  return $database_name[$hostversion];
}

function get_tones() {
  return array(array('id' => 'Single Tone', 'name' => 'Single Tone'),
               array('id' => '2 Tone', 'name' => '2 Tone'));
}

function get_customers(){
  $ci =& get_instance();
  $ci->load->model('settings/customer_model');
  return $ci->customer_model->get('name as id, name');
}
 
function get_melting_lot_category_ones($product_name = ''){
  $ci =& get_instance();
  $ci->load->model('settings/category_model');
  $where = array();
  if (!empty($product_name)) $where['product_name'] = $product_name;
  if (HOST=='ARF' && empty($product_name)) {
    return array(array('id' => 'Dhoom Chain', 'name' => 'Dhoom Chain'),
                 array('id' => 'Others', 'name' => 'Others'));
  } else
    return $ci->category_model->get('category_one as id, category_one as name', $where, array(), array('group_by' => 'category_one'));
}

function get_machine_sizes($product_name = ''){
  $ci =& get_instance();
  $ci->load->model('settings/category_model');
  $where = array();
  if (!empty($product_name)) $where['product_name'] = $product_name;
  if (HOST=='ARF' && empty($product_name)) {
    return array(array('id' => '0.21', 'name' => '0.21'),
                 array('id' => 'Others', 'name' => 'Others'));
  } else
  return $ci->category_model->get('category_three as id, category_three as name', $where, array(), array('group_by' => 'category_three'));
}

function get_karigars(){
  if(HOST=='ARF'){
    return array(
               // array('name' => 'Ashish', 'id' => 'Ashish'),
               array('name' => 'Biplav', 'id' => 'Biplav'),
               // array('name' => 'Bikas', 'id' => 'Bikas'),
               // array('name' => 'Clipping', 'id' => 'Clipping'),
               // array('name' => 'Chotu', 'id' => 'Chotu'),
               array('name' => 'Factory', 'id' => 'Factory'),
               array('name' => 'Factory Fancy', 'id' => 'Factory Fancy'),
               array('name' => 'Ganesh', 'id' => 'Ganesh'),
               // array('name' => 'Hira', 'id' => 'Hira'),
               array('name' => 'Prasanjit', 'id' => 'Prasanjit'),
               // array('name' => 'Prashant', 'id' => 'Prashant'),
               array('name' => 'Shahdev', 'id' => 'Shahdev'),
               array('name' => 'Madan', 'id' => 'Madan'),
               array('name' => 'Bappa', 'id' => 'Bappa'),
               // array('name' => 'Souman', 'id' => 'Souman'),
               // array('name' => 'Shivnath', 'id' => 'Shivnath'),
               // array('name' => 'Vishnu', 'id' => 'Vishnu'),
               // array('name' => 'A', 'id' => 'A'),
               // array('name' => 'B', 'id' => 'B'),
               // array('name' => 'C', 'id' => 'C'),
               // array('name' => 'D', 'id' => 'D'),
               // array('name' => 'E', 'id' => 'E'),
               // array('name' => 'F', 'id' => 'F'),
               ); 
  }elseif(HOST=='ARC'){
    return array(array('name' => 'Milan', 'id' => 'Milan'),
               array('name' => 'Bikas', 'id' => 'Bikas'),
               array('name' => 'Sunil', 'id' => 'Sunil'),
               array('name' => 'Chitra', 'id' => 'Chitra'),
               array('name' => 'Chotu', 'id' => 'Chotu'),
               array('name' => 'Ajaya', 'id' => 'Ajaya'),
               array('name' => 'Krishna', 'id' => 'Krishna'),
               array('name' => 'Siba', 'id' => 'Siba'),
               array('name' => 'Shivnath', 'id' => 'Shivnath'),
               array('name' => 'Kunal', 'id' => 'Kunal'),
               array('name' => 'Factory', 'id' => 'Factory'),
               ); 
  }else {
  return array(array('name' => 'Amit', 'id' => 'Amit'),
               array('name' => 'Ashish', 'id' => 'Ashish'),
               array('name' => 'Bappa', 'id' => 'Bappa'),
               array('name' => 'Bappy Nawabi', 'id' => 'Bappy Nawabi'),
               array('name' => 'Bhim', 'id' => 'Bhim'),
               array('name' => 'Bikas', 'id' => 'Bikas'),
               array('name' => 'Chotu', 'id' => 'Chotu'),
               array('name' => 'Dharmendra', 'id' => 'Dharmendra'),
               array('name' => 'Dipu', 'id' => 'Dipu'),
               array('name' => 'Golu', 'id' => 'Golu'),
               array('name' => 'Hollow-Bapi', 'id' => 'Hollow-Bapi'),
               array('name' => 'Kamal', 'id' => 'Kamal'),
               array('name' => 'Kumar', 'id' => 'Kumar'),
               array('name' => 'Nandanji', 'id' => 'Nandanji'),
               array('name' => 'Shyam sundar', 'id' => 'Shyam sundar'),
               array('name' => 'Shivnath', 'id' => 'Shivnath'),
               array('name' => 'Soiley', 'id' => 'Soiley'),
               array('name' => 'Suman', 'id' => 'Suman'),
               array('name' => 'Ganesh', 'id' => 'Ganesh'),
               array('name' => 'Prashanto', 'id' => 'Prashanto'),
               array('name' => 'Tushar', 'id' => 'Tushar'),
               array('name' => 'Nishikant', 'id' => 'Nishikant'),
               array('name' => 'Factory', 'id' => 'Factory'),
               ); 
  }
}

function get_clipping_types() {
  return array(array('id' => 'Ball and Capsule Clipping', 'name' => 'Ball and Capsule Clipping'),
               array('id' => 'Lasiya Clipping', 'name' => 'Lasiya Clipping'),
               array('id' => 'Pipe Clipping', 'name' => 'Pipe Clipping'));
}
function differenceInHours($startdate,$enddate){
  $starttimestamp = strtotime($startdate);
  $endtimestamp = strtotime($enddate);
  $difference = abs($endtimestamp - $starttimestamp)/3600;
  return $difference;
}

// function get_karigar_dropdown_with_host($key='') {
//   if(HOST == 'localhost' || HOST == 'staging-argold.ascratech.com'){
//     return get_dd_issue_departments_karigar_names();
//   }else {
//     $chains =  array(
//       'ropechain-argold.ascratech.com' => array(array('id' => 'Ashish','name' => 'Ashish',
//                                                 array('id' => 'Nishikant', 'name' => 'Nishikant'))),
//       'hollowchocochain-argold.ascratech.com' => array(array('id' => 'Ashish','name' => 'Ashish'),
//                                                        array('id' => 'Hollow Bappy','name' => 'Hollow Bappy'),
//                                                        array('id' => 'Chotu', 'name' => 'Chotu'),
//                                                        array('id' => 'Nandanji', 'name' => 'Nandanji'),
//                                                        array('id' => 'Nishikant', 'name' => 'Nishikant'),
//                                                        array('id' => 'Soiley', 'name' => 'Soiley')), 
//       'impitalychain-argold.ascratech.com' => array(array('id' => 'Hollow Bappy','name' => 'Hollow Bappy'),
//                                                     array('id' => 'Nishikant', 'name' => 'Nishikant')),
//       'machinechain-argold.ascratech.com' => array(array('id' => 'Ashish','name' => 'Ashish'),
//                                                    array('id' => 'Nishikant', 'name' => 'Nishikant')),
//       'chocochain-argold.ascratech.com' => array(array('id' => 'Ashish','name' => 'Ashish'),
//                                                  array('id' => 'Bappy Nawabi','name' => 'Bappy Nawabi'),
//                                                  array('id' => 'Nishikant', 'name' => 'Nishikant'),
//                                                  array('id' => 'Prashanto','name' => 'Prashanto'),
//                                                  array('id' => 'Suman','name' => 'Suman'),
//                                                  array('id' => 'Kamal','name' => 'Kamal')),
//       'roundboxchain-argold.ascratech.com' => array(array('id' => 'Ashish','name' => 'Ashish'),
//                                                     array('id' => 'Nishikant', 'name' => 'Nishikant')),
//       'fancychain-argold.ascratech.com' => array(array('name'=>'Kashinath','id' =>'Kashinath'),
//                                                  array('id' => 'Nishikant', 'name' => 'Nishikant')),
//       'indotallychain-argold.ascratech.com' => array(array('id' => 'Bhim','name' => 'Bhim'),
//                                                      array('id' => 'Dharmendra','name' => 'Dharmendra'),
//                                                      array('id' => 'Golu','name' => 'Golu'),
//                                                      array('id' => 'Hollow Bappy','name' => 'Hollow Bappy'),
//                                                      array('id' => 'Kashinath','name' => 'Kashinath'),
//                                                      array('id' => 'Nandanji', 'name' => 'Nandanji'),
//                                                      array('id' => 'Nishikant', 'name' => 'Nishikant'),
//                                                      array('id' => 'Soiley','name' => 'Soiley')),
//       'refresh-argold.ascratech.com' => array(array('id' => 'Ashish','name' => 'Ashish'),
//                                               array('id' => 'Nishikant', 'name' => 'Nishikant')),
//       'sismachain-argold.ascratech.com' => array(array('id' => 'ARC','name' => 'ARC'),
//                                                  array('id' => 'ARF','name' => 'ARF'),
//                                                  array('id' => 'Amit','name' => 'Amit'),
//                                                  array('id' => 'Ashish','name' => 'Ashish'),
//                                                  array('id' => 'Bappy Nawabi','name' => 'Bappy Nawabi'),
//                                                  array('id' => 'Kashinath','name' => 'Kashinath'),
//                                                  array('id' => 'Kumar','name' => 'Kumar'),
//                                                  array('id' => 'Nishikant', 'name' => 'Nishikant'),
//                                                  array('id' => 'Shyam Sundar','name' => 'Shyam Sundar')),
//       'dailydrawer-argold.ascratech.com' => array(array('name' => 'Kashinath', 'id' => 'Kashinath'),
//                                                   array('name' => 'Nandanji', 'id' => 'Nandanji'),
//                                                   array('name' => 'Hollow Bappy', 'id' => 'Hollow Bappy'),
//                                                   array('name' => 'Soiley', 'id' => 'Soiley'),
//                                                   array('name' => 'Golu', 'id' => 'Golu'),
//                                                   array('name' => 'Dharmendra', 'id' => 'Dharmendra'),
//                                                   array('name' => 'Bhim', 'id' => 'Bhim'),
//                                                   array('name' => 'Ashish', 'id' => 'Ashish'),
//                                                   array('name' => 'ARC', 'id' => 'ARC'),
//                                                   array('name' => 'ARF', 'id' => 'ARF'),
//                                                   array('name' => 'Amit', 'id' => 'Amit'),
//                                                   array('name' => 'Ashish', 'id' => 'Ashish'),
//                                                   array('name' => 'Bappy Nawabi', 'id' => 'Bappy Nawabi'),
//                                                   array('name' => 'Kashinath', 'id' => 'Kashinath'),
//                                                   array('name' => 'Kumar', 'id' => 'Kumar'),
//                                                   array('id' => 'Nishikant', 'name' => 'Nishikant'),
//                                                   array('name' => 'Shyam sundar', 'id' => 'Shyam sundar'),
//                                                   array('id' => 'Prashanto','name' => 'Prashanto'),
//                                                   array('id' => 'Suman','name' => 'Suman'),
//                                                   array('id' => 'Kamal','name' => 'Kamal'),
//                                                   
//       'ARF' => array(array('name' => 'Ganesh', 'id' => 'Ganesh'),
//                                            array('name' => 'Somain', 'id' => 'Somain'),
//                                            array('name' => 'Sahdev', 'id' => 'Sahdev'),
//                                            array('name' => 'Prasanjit', 'id' => 'Prasanjit'),
//                                            array('name' => 'Hiral', 'id' => 'Hiral'),
//                                            array('name' => 'Shivam', 'id' => 'Shivam')));
//     return $chains[HOST];
//   }
// }

function get_parent_lot_process($key='') {

    return array(array('name'=>'Rope Chain','id' =>'Rope Chain'), 
                 );
}
function get_melting_lot_process($key='') {
  return array(
    array('name'=>'Imp Italy Chain','id' =>'Imp Italy Chain'),
    array('name'=>'Office Outside','id' =>'Office Outside'));
}

function get_concept($key='') {
  return array(
    array('name'=>'IMP','id' =>'IMP'), 
    array('name'=>'PIPE','id' =>'PIPE')
    );
}


function get_final_process($key='') {
  return array(
    array('name'=>'Hollow','id' =>'Hollow'),
    array('name'=>'Round box diamond cutting','id' =>'Round box diamond cutting'),
    array('name'=>'Diamond Cutting','id' =>'Diamond Cutting'),
    );
}

function get_process_hcl($key='') {
  return array(
    array('name'=>'Rope Chain','id' =>'Rope Chain')
    );
}

function get_issue_department_comapny_name() {
  // if(HOST == 'ARC'){
  //   return array(
  //   array('name'=>'ARC','id' =>'3', 'selected' => 'selected'),
  //   );
  // }elseif(HOST == 'ARF'){
  //   return array(
  //   array('name'=>'ARF','id' =>'2', 'selected' => 'selected'),
  //   );
  // }else{
  
    return array(
    array('name'=>'AR Gold','id' =>'1', 'selected' => 'selected'),
    );
  // }
}

function get_product_name($key='')
{
    $product_name= array(
                 'Rope Chain'=>'rope_chains',
                 'Solid Rope Chain'=>'solid_rope_chains',
                 'Solid Nawabi Chain'=>'solid_nawabi_chains',
                 'Machine Chain'=>'machine_chains',
                 'Solid Machine Chain'=>'solid_machine_chains',
                 'Choco Chain'=>'choco_chains',
                 'Rolex Chain'=>'rolex_chains',
                 'Round Box Chain'=>'round_box_chains',
                 'Hand Made Chain'=>'hand_made_chains',
                 'Dus Collection'=>'dus_collections',
                 'Sisma Chain'=>'sisma_arf_chains',
                 'Sisma ARF Chain'=>'sisma_chains',
                 'Office Outside Hook'=>'office_outside_hook',
                 'Office Outside Ball'=>'office_outside_ball',
                 'Office Outside Cutting Wire'=>'office_outside_cutting_wire',
                 'Office Outside KDM'=>'office_outside_kdm',
                 'Office Outside Lobster'=>'office_outside_lobsters',
                 'Office Outside Solid Pipe'=>'office_outside_solid_pipes',
                 'Office Outside Solid Wire'=>'office_outside_solid_wires',
                 'Office Outside Hard Wire'=>'office_outside_hard_wires',
                 'Office Outside Hollow Pipe'=>'office_outside_hollow_pipes',
                 'Office Outside Sisma Stripe'=>'office_outside_sisma_stripe',
                 'Office Outside Cutting Pipe'=>'office_outside_cutting_pipes',
                 'Office Outside Pipe'=>'office_outside_pipes',
                 'Office Outside Lasiya'=>'office_outside_lasiyas',
                 'Office Outside Para'=>'office_outside_paras',
                 'Office Outside Tar'=>'office_outside_tars',
                 'Imp Italy Chain'=>'imp_italy_chains',
                 'Indo tally Chain'=>'indo_tally_chains',
                 'Refresh'=>'refresh',
                 'Hollow Choco Chain'=>'hollow_choco_chains',
                 'Lotus Chain'=>'lotus_chains',
                 'Lopster Making Chain'=>'lopster_making_chains',
                 'Hollow Bangle Chain'=>'hollow_bangle_chains',
                 'Roco Choco Chain'=>'roco_choco_chains',
                 'Nawabi Chain'=>'nawabi_chains',
                 'Casting 92 Chain'=>'casting_ninety_processes',
                 'Casting 75 Chain'=>'casting_seventy_processes',
                 'Fancy Chain'=>'fancy_chains',
                 'Fancy 75 Chain'=>'fancy_seventy_chains',
                 'Ghiss Cutting'=>'ghiss_cuttings',
                 'Daily Drawer'=>'daily_drawers',
                 'Office Outside'=>'office_outside',
                 'Loss Out'=>'loss_outs',
                 'Ghiss Out'=>'ghiss_outs',
                 'ARC'=>'arcs',
                 'KA Chain'=>'ka_chains',
                 'HCL'=>'hcl');
     return $product_name[$key];
}

function get_product_name_for_category($type= '') {
  if (HOST == 'AR Gold' || HOST == 'ARG') {
    $product_name= array('Rope Chain',
                         'Solid Rope Chain',
                         'Solid Nawabi Chain',
                         'Machine Chain',
                         'Solid Machine Chain',
                         'Choco Chain',
                         'Rolex Chain',
                         'Round Box Chain',
                         'Sisma Chain',
                         'Imp Italy Chain',
                         'Indo tally Chain',
                         'Refresh',
                         'Hollow Choco Chain',
                         'Lotus Chain',
                         'Lopster Making Chain',
                         'Hollow Bangle Chain',
                         'Roco Choco Chain',
                         'Nawabi Chain',
                         'Casting 92 Chain',
                         'Casting 75 Chain',
                         'Fancy Chain',
                         'Finished Goods Receipt');
  } else {
    if ($type == 'category_master')
      $product_name = array('Refresh',
                            'Fancy Chain',
                            'Finished Goods Receipt');
    else
      $product_name = array('Refresh',
                            'Fancy Chain',
                            'Finished Goods Receipt',
                            'KA Chain',
                            'Ball Chain',
                            'KA Chain Refresh',
                            );
  }
  return $product_name;
}

function get_new_product_name_with_diffrent_controllers($product_name){
  $chain = array(
            'Ghiss Out'=>array('Melting'=>'ghiss_out_melting_processes'),
            'Loss Out' => array('Melting'=>'loss_out_melting_processes'),
            'Daily Drawer' => array('Melting'=>'melting_processes'),
  );
  return isset($chain[$product_name])?$chain[$product_name]:'';
}

function get_product_value($key='')
{
    $product_name= array(
                 'rope_chains'=>'Rope Chain',
                 'solid_rope_chains'=>'Solid Rope Chain',
                 'solid_nawabi_chains'=>'Solid Nawabi Chain',
                 'machine_chains'=>'Machine Chain',
                 'solid_machine_chains'=>'Solid Machine Chain',
                 'choco_chains'=>'Choco Chain',
                 'rolex_chains'=>'Rolex Chain',
                 'round_box_chains'=>'Round Box Chain',
                 'sisma_chains'=>'Sisma Chain',
                 'sisma_accessories_making_chains'=>'Sisma Accessories Making Chain',
                 'office_outside_hook'=>'Office Outside Hook',
                 'office_outside_kdm'=>'Office Outside KDM',
                 'office_outside_lobsters'=>'Office Outside Lobster',
                 'office_outside_balls'=>'Office Outside Ball',
                 'office_outside_cutting_wires'=>'Office Outside Cutting Wire',
                 'office_outside_hard_wires'=>'Office Outside Hard Wire',
                 'office_outside_hollow_pipes'=>'Office Outside Hollow Pipe',
                 'office_outside_sisma_stripe'=>'Office Outside Sisma Stripe',
                 'office_outside_cutting_pipes'=>'Office Outside Cutting Pipe',
                 'office_outside_lasiyas'=>'Office Outside Lasiya',
                 'office_outside_paras'=>'Office Outside Para',
                 'office_outside_tars'=>'Office Outside Tar',
                 'office_outside_pipes'=>'Office Outside Pipe',
                 'nano_processes'=>'Nano Process',
                 'i_ten_processes'=>'I 10 Process',
                 'dhoom_a_processes'=>'Dhoom A Process',
                 'dhoom_b_processes'=>'Dhoom B Process',
                 'para_final_processes'=>'Para Final Process',
                 'pipe_cuttings'=>'Pipe Cutting',
                 'dhoom_b_processes'=>'Dhoom B Process',
                 'imp_italy_chains'=>'Imp Italy Chain',
                 'indo_tally_chains'=>'Indo tally Chain',
                 'hollow_choco_chains'=>'Hollow Choco Chain',
                 'lotus_chains'=>'Lotus Chain',
                 'roco_choco_chains'=>'Roco Choco Chain',
                 'nawabi_chains'=>'Nawabi Chain',
                 'casting_chains'=>'Casting 92 Chain',
                 'hand_made_chains'=>'Hand Made Chain',
                 'dus_collections'=>'Dus Collection',
                 'fancy_chains'=>'Fancy Chain',
                 'fancy_seventy_chains'=>'Fancy 75 Chain',
                 'ghiss_cutting'=>'Ghiss Cutting',
                 'hcl'=>'HCL',
                 'ghiss_outs'=>'Ghiss Out',
                 'daily_drawers'=>'Daily Drawer',
                 'loss_outs'=>'Loss Out',
                 'tounch_outs'=>'Tounch Out',
                 'fire_tounch_outs'=>'Fire Tounch Out',
                 'tounch_ghiss_outs'=>'Tounch Ghiss Out',
                 'hcl'=>'HCL',
                 'hcl_ghiss_outs'=>'Rope Ghiss Out',
                 'hcl_ghiss'=>'Rope Ghiss',
                 'refresh'=>'Refresh',
                 'ka_chains'=>'KA Chain',
                 'solder_wastage_outs'=>'Solder Wastage',
                 'solder_wastage_outs'=>'Solder Wastage',
                 'melting_wastage_refine_outs'=>'Melting Wastage Refine',
                 'arcs'=>'ARC',
                 'stone_ring_nineties'=>'Stone Ring 92',
                 'rings'=>'Ring',
                 'pendants'=>'Pendant',
                 'kuwaitis'=>'Kuwaitis',
                 'bracelets'=>'Bracelets',
                 'stone_ring_seventies'=>'Stone Ring 75',
                 'plain_rings'=>'Plain Ring',
                 'lock_processes'=>'Lock Process',
                 'pendent_sets'=>'Pendent Set',
                 'pendent_set_seventies'=>'Pendent Set 75',
                 'pendent_set_plains'=>'Pendent Set Plain',
                 'ball_chains'=>'Box Process',
                 'stone_vatav_outs'=>'Stone Vatav',
                 'rod_cleaning'=>'Rod Cleaning',
                 'casting_rnds'=>'Casting RND',
                 'internals'=>'Internal',
                 'ring_seventies'=>'Ring 75',
                 'pendant_seventies'=>'Pendant 75',
                 'solder_nineties'=>'Solder 92',
                 'chain_nineties'=>'Chain 92',
                 'arc_chains'=>'ARC',
                 'arc_customer_order_chains'=>'ARC Customer Order',
                 'arc_lock_chains'=>'ARC Lock',
                 'arc_rnd_chains'=>'ARC RND',
                 'chain_seventies'=>'Chain 75',
                 'pro_nineties'=>'Pro 92',
                 'pro_seventies'=>'Pro 75',
                 'pipe_and_para_processes'=>'Pipe And Para',
                 'office_outside'=>'Office Outside',
                 'arc_para_chains'=>'ARC PARA',
                 'hallmarking'=>'Hallmarking',
                 'lopster_making_chains'=>'Lopster Making',
                 'hollow_bangle_chains'=>'Hollow Bangle',
                 'arc_ornament_chains'=>'Arc Ornament',
                 'sisma_arf_chains'=>'Sisma ARF Chain',
                 'tanishq_fancy_chains'=>'Tanishq Fancy Chain',
                 'domestic_internals'=>'Domestic Internals',
                 'lopsters'=>'Lopsters',
                 'arc_kuwaiti_chains'=>'ARC KUWAITI',
                 'arc_turkey_chains'=>'ARC Turkey',
                 'casting_processes'=>'Casting',
                 'arc_fancy_chains'=>'ARC Fancy');
     return $product_name[$key];
}
function get_product_controller_name_on_product_name($key='',$process_name='')
{
    $product_name= array(
                 'Rope Chain'=>'rope_chains',
                 'Solid Rope Chain'=>'solid_rope_chains',
                 'Solid Nawabi Chain'=>'solid_nawabi_chains',
                 'Machine Chain'=>'machine_chains',
                 'Solid Machine Chain'=>'solid_machine_chains',
                 'Hand Made Chain'=>'hand_made_chains',
                 'Dus Collection'=>'dus_collections',
                 'Choco Chain'=>'choco_chains',
                 'Rolex Chain'=>'rolex_chains',
                 'Round Box Chain'=>'round_box_chains',
                 'Sisma Chain'=>'sisma_chains',
                 'Office Outside Hook'=>'office_outside_hook',
                 'Office Outside KDM'=>'office_outside_kdm',
                 'Office Outside Lobster'=>'office_outside_lobsters',
                 'Office Outside Ball'=>'office_outside_balls',
                 'office_outside_cutting_wires'=>'Office Outside Cutting Wire',
                 'Office Outside Hard Wire'=>'office_outside_hard_wires',
                 'Office Outside Hollow Pipe'=>'office_outside_hollow_pipes',
                 'Office Outside Sisma Stripe'=>'office_outside_sisma_stripe',
                 'Office Outside Cutting Pipe'=>'office_outside_cutting_pipes',
                 'Office Outside Lasiya'=>'office_outside_lasiyas',
                 'Office Outside Para'=>'office_outside_paras',
                 'Office Outside Tar'=>'office_outside_tars',
                 'Office Outside Pipe'=>'office_outside_pipes',
                 'Nano Process'=>'nano_processes',
                 'I 10 Process'=>'i_ten_processes',
                 'Dhoom A Process'=>'dhoom_a_processes',
                 'Dhoom B Process'=>'dhoom_b_processes',
                 'Para Final Process'=>'para_final_processes',
                 'Pipe Cutting'=>'pipe_cuttings',
                 'Dhoom B Process'=>'dhoom_b_processes',
                 'Imp Italy Chain'=>'imp_italy_chains',
                 'Indo tally Chain'=>'indo_tally_chains',
                 'Hollow Choco Chain'=>'hollow_choco_chains',
                 'Lotus Chain'=>'lotus_chains',
                 'Roco Choco Chain'=>'roco_choco_chains',
                 'Nawabi Chain'=>'nawabi_chains',
                 'Casting 92 Chain'=>'casting_ninety_processes',
                 'Casting 75 Chain'=>'casting_seventy_processes',
                 'Fancy Chain'=>'fancy_chains',
                 'Fancy 75 Chain'=>'fancy_seventy_chains',
                 'Ghiss Cutting' =>'ghiss_cutting',
                 'HCL'=>'hcl',
                 'Ghiss Out'=>'ghiss_outs',
                 'Daily Drawer'=>'daily_drawers',
                 'Loss Out'=>'loss_outs',
                 'Tounch Out'=>'tounch_outs',
                 'Fire Tounch Out'=>'fire_tounch_outs',
                 'Tounch Ghiss Out'=>'tounch_ghiss_outs',
                 'HCL'=>'hcl',
                 'Rope Ghiss Out'=>'hcl_ghiss_outs',
                 'Rope Ghiss'=>'hcl_ghiss',
                 'Refresh'=>'refresh',
                 'KA Chain'=>'ka_chains',
                 'Solder Wastage'=>'solder_wastage_outs',
                 'ARC'=>'arcs',
                 'Stone Ring 92'=>'stone_ring_nineties',
                 'Ring'=>'rings',
                 'Pendant'=>'pendants',
                 'Kuwaitis'=>'kuwaitis',
                 'Bracelet'=>'bracelets',
                 'Stone Ring 75'=>'stone_ring_seventies',
                 'Plain Ring'=>'plain_rings',
                 'Lock Process'=>'lock_processes',
                 'Pendent Set'=>'pendent_sets',
                 'Pendent Set 75'=>'pendent_set_seventies',
                 'Pendent Set Plain'=>'pendent_set_plains',
                 'Box Process'=>'ball_chains',
                 'Stone Vatav'=>'stone_vatav_outs',
                 'Rod Cleaning'=>'rod_cleaning',
                 'Casting RND'=>'casting_rnds',
                 'internals'=>'Internal',
                 'Ring 75'=>'ring_seventies',
                 'Pendant 75'=>'pendant_seventies',
                 'Solder 92'=>'solder_nineties',
                 'Chain 92'=>'chain_nineties',
                 'Chain 75'=>'chain_seventies',
                 'Pro 92'=>'pro_nineties',
                 'Pro 75'=>'pro_seventies',
                 'Casting RND Process'=>'pipe_and_para_processes',
                 'Solder'=>'pendants',
                 'Pipe And Para'=>'casting_rnd_processes',
                 'Casting'=>'arc_chains',
                 'Lopster Making Chain'=>'lopster_making_chains',
                 'Hollow Bangle Chain'=>'hollow_bangle_chains',
                 'Office Outside'=>'office_outside',
                 'ARC Turkey'=>'arc_turkey_chains',
                 );
      if(in_array($process_name,array('Pipe and Para CNC Process','Pipe and Para Copper Dull Process','Pipe and Para Copper Process','Pipe and Para Dull Process','Pipe and Para Final Process','Pipe and Para Hand Cutting Process','Pipe and Para Hold Process','Pipe and Para Rhodium Process','Pipe and Para Round and Ball Chain Process','Pipe and Para Start Process','Pipe and Para Stripping Process'))){
        $product_name['Office Outside']='pipe_and_para_processes';
      }
      if(in_array($process_name,array('Imp Italy Dye Process'))){
        $product_name['Office Outside']='imp_italy_chains';
      }
      if(in_array($process_name,array('Hollow Choco Dye Process'))){
        $product_name['Office Outside']='hollow_choco_chains';
      }
      if(in_array($process_name,array('Lotus Dye Process'))){
        $product_name['Office Outside']='lotus_chains';
      }
      if(in_array($process_name,array('Roco Dye Process'))){
        $product_name['Office Outside']='roco_choco_chains';
      }
      if(in_array($process_name,array('Nawabi Dye Process'))){
        $product_name['Office Outside']='nawabi_chains';
      }
      if(in_array($process_name,array('Choco Chain Dye Process'))){
        $product_name['Office Outside']='choco_chains';
      }
     return $product_name[$key];
}

function get_process_name($key='')
{
 $process_name= array(
                 'AG'=>'ags',
                 'AG Flatting'=>'ag_flattings',
                 'PL Flatting'=>'pl_flattings',
                 'Machine Process'=>'machine_processes',
                 'Final Process'=>'final_processes',
                 'Imp Final Process'=>'imp_final_processes',
                 'Rolex Final Process'=>'rolex_final_processes',
                 'Spring Process'=>'spring_processes',
                 'Chain Making Process'=>'chain_making_processes',
                 'Chain Making 75 Process'=>'chain_making_seventy_processes',
                 'HCL Melting Process'=>'hcl_melting_processes',
                 'Melting Wastage Refine Process'=>'
                 melting_wastage_refine_out_melting_processes',
                 'KDM'=>'kdms',
                 'Hook'=>'hooks',
                 'Lobsters'=>'lobsters',
                 'Solid Pipe'=>'solid_pipes',
                 'Solid Wire'=>'solid_wires',
                 'Hollow Pipe'=>'hollow_pipes',
                 'ARC'=>'arcs',
                 'Buffing'=>'buffing',
                 'Buffing I'=>'buffing_i_processes',
                 'Assembling Process'=>'assembling_processes',
                 'Melting'=>'melting',
                 'Pipe and Para CNC Process'=>'pipe_and_para_cnc_processes',
                 'Round and Ball Chain Process'=>'round_and_ball_chain_processes',
                 'Pipe and Para Round and Ball Chain Process'=>'pipe_and_para_round_and_ball_chain_processes',
                 'CNC Process'=>'cnc_processes',
                 'Casting RND Process'=>'pipe_and_para_processes',
                 'Solder'=>'pendants',
                 'PL'=>'pls',
                 'Imp Italy Dye Process'=>'imp_italy_dye_processes',
                 'Indo Italy Dye Process'=>'indo_tally_dye_processes',
                 'Hollow Choco Dye Process'=>'hollow_choco_dye_processes',
                 'Lotus Dye Process'=>'lotus_dye_processes',
                 'Roco Dye Process'=>'roco_choco_dye_processes',
                 'Nawabi Dye Process'=>'nawabi_dye_processes',
                 'Casting Dye Process'=>'casting_dye_processes',
                 'Choco Chain Dye Process'=>'choco_chain_dye_processes',
                 'Rolex Chain Dye Process'=>'rolex_chain_dye_processes',
                 'Factory Hold Plain Process'=>'factory_hold_plain_processes',
                 'Plain Cutting Process'=>'plain_cutting_processes',
                 'Copper Cutting Two Tone Process'=>'copper_cutting_two_tone_processes',
                 'Internal GPC Processes'=>'internal_gpc_processes',
                 'Internal Pasta GPC Processes'=>'internal_pasta_gpc_processes',
                 'Lock Buffing Processes'=>'lock_buffing_processes',
                 'Lock Filing Processes'=>'lock_buffing_processes',
                 'Buffing Process'=>'buffing_processes',
                 'Customer Order Process'=>'customer_order_processes',
                 'Hook Process'=>'hook_processes',
                                  );
     return $process_name[$key];
}
function get_process_value($key='')
{
 $process_name= array(
                 'ags'=>'AG',
                 'ag_ninety_twos'=>'AG 92',
                 'casting_ninety_two_processes'=>'Casting 92',
                 'ag_seventy_fives'=>'AG 75',
                 'casting_seventy_five_processes'=>'Casting 75',
                 'grinding_processes'=>'Grinding',
                 'filing_processes'=>'Filing',
                 'filing_ii_processes'=>'Filing II',
                 'filing_iii_processes'=>'Filing III',
                 'filing_rnd_processes'=>'Filing RND',
                 'magnet_processes'=>'Magnet',
                 'correction_processes' => 'Correction',
                 'magnet_rnd_processes'=>'Magnet RND',
                 'caustic_loss_processes'=>'Caustic Loss',
                 'caustic_loss_rnd_processes'=>'Caustic Loss RND',
                 'steel_vibrator_processes'=>'Steel Vibrator',
                 'pasta_processes'=>'Pasta',
                 'pre_polish_processes'=>'Pre Polish',
                 'pre_polish_rnd_processes'=>'Pre Polish RND',
                 'stone_setting_processes'=>'Stone Setting',
                 'refiling_processes'=>'Refiling',
                 'refiling_rnd_processes'=>'Refiling RND',
                 'refiling_ii_processes'=>'Refiling II',
                 'refiling_iii_processes'=>'Refiling III',
                 'sale_i_processes'=>'Sale I',
                 'resale_i_processes'=>'Resale I',
                 'hardening_processes'=>'Hardening',
                 'cell_i_magnet_processes'=>'Cell I Magnet',
                 'cell_i_buffing_processes'=>'Cell I Buffing',
                 'cell_i_refiling_processes'=>'Cell I Refiling',
                 'cell_i_filing_processes'=>'Cell I Filing',
                 'cell_ii_magnet_processes'=>'Cell II Magnet',
                 'cell_ii_buffing_processes'=>'Cell II Buffing',
                 'cell_ii_buffing_refresh_processes'=>'Cell II Buffing Refresh',
                 'cell_iii_buffing_processes'=>'Cell III Buffing',
                 'cell_iv_buffing_processes'=>'Cell IV Buffing',
                 'cell_ii_refiling_processes'=>'Cell II Refiling',
                 'cell_ii_filing_processes'=>'Cell II Filing',
                 'booming_processes'=>'Booming',
                 'segregation_processes'=>'Segregation',
                 'buffings_processes'=>'Buffing',
                 'buffings_rnd_processes'=>'Buffing RND',
                 'assembling_processes'=>'Assembling Process',
                 'hand_cutting_processes'=>'Hand Cutting',
                 'hand_cutting_ii_processes'=>'Hand Cutting II',
                 'hand_cutting_iii_processes'=>'Hand Cutting III',
                 'hand_dull_processes'=>'Hand Dull',
                 'sand_dull_processes'=>'Sand Dull',
                 'buffing_refresh_processes'=>'Buffing Refresh',
                 'buffing_refresh_rnd_processes'=>'Buffing Refresh RND',
                 'gpc_processes'=>'GPC',
                 'meena_processes'=>'Meena',
                 'finish_goods_processes'=>'Finish Good',
                 'ag_flattings'=>'AG Flatting',
                 'sisma_machine_processes'=>'Sisma Machine Process',
                 'pl_buffing_processes'=>'PL Buffing Process',
                 'buffing_processes'=>'Buffing Process',
                 'dye_processes'=>'Dye Process',
                 'pls'=>'PL',
                 'pl_flattings'=>'PL Flatting',
                 'machine_processes'=>'Machine Process',
                 'final_processes'=>'Final Process',
                 'imp_final_processes'=>'Imp Final Process',
                 'rolex_final_processes'=>'Rolex Final Process',
                 'spring_processes'=>'Spring Process',
                 'chain_making_processes'=>'Chain Making Process',
                 'hcl_melting_processes'=>'HCL Melting Process',
                 'melting_wastage_refine_out_melting_processes'=>'Melting Wastage Refine Process',
                 'kdms'=>'KDM',
                 'hooks'=>'Hook',
                 'lobsters'=>'Lobsters',
                 'balls'=>'Balls',
                 'solid_pipes'=>'Solid Pipe',
                 'solid_wires'=>'Solid Wire',
                 'hard_wires'=>'Hard Wire',
                 'hollow_pipes'=>'Hollow Pipe',
                 'hcl_melting_processes'=>'HCL Melting Process',
                 'loss_out_melting_processes'=>'Melting Process',
                 'ghiss_out_melting_processes'=>'Melting Process',
                 'ghiss_out_final_processes'=>'Final Process',
                 'tounch_out_melting_processes'=>'Melting Process',
                 'tounch_ghiss_out_melting_processes'=>'Melting Process',
                 'fire_tounch_out_melting_processes'=>'Melting Process',
                 'melting_processes'=>'Melting Process',
                 'hcl_ghiss_out_melting_processes'=>'Melting Process',
                 'hcl_ghiss_melting_processes'=>'Melting Process',
                 'karigar_processes'=>'Karigar Process',
                 'karigar_bom_processes'=>'Karigar Bom Process',
                 'refresh'=>'Refresh',
                 'start_processes'=>'Start Processes',
                 'vishnu_processes'=>'Vishnu Processes',
                 'clipping_processes'=>'Clipping Processes',
                 'ashish_processes'=>'Ashish Processes',
                 'laser_processes'=>'Laser Processes',
                 'hammering_processes'=>'Hammering Processes',
                 'dhoom_processes'     => 'Dhoom Process',
                 'rnd_processes'=>'Rnd Processes',
                 'rnd_in_processes'=>'Rnd In Processes',
                 'cutting_wires'=>'Cutting Wire',
                 'cutting_pipes'=>'Cutting Pipe',
                 'rope_chain_cutting_pipes'=>'Cutting Pipe',
                 'choco_chain_cutting_pipes'=>'Cutting Pipe',
                 'machine_chain_cutting_pipes'=>'Cutting Pipe',
                 'hollow_choco_chain_cutting_pipes'=>'Cutting Pipe',
                 'sisma_chain_cutting_pipes'=>'Cutting Pipe',
                 'imp_italy_chain_cutting_pipes'=>'Cutting Pipe',
                 'hollow_choco_chain_cutting_pipes'=>'Cutting Pipe',
                 'rope_chain_hollow_pipes'=>'hollow Pipe',
                 'choco_chain_hollow_pipes'=>'hollow Pipe',
                 'machine_chain_hollow_pipes'=>'hollow Pipe',
                 'hollow_choco_chain_hollow_pipes'=>'hollow Pipe',
                 'sisma_chain_hollow_pipes'=>'hollow Pipe',
                 'imp_italy_chain_hollow_pipes'=>'hollow Pipe',
                 'hollow_choco_chain_hollow_pipes'=>'hollow Pipe',
                 'rope_chain_solid_pipes'=>'Solid Pipe',
                 'choco_chain_solid_pipes'=>'Solid Pipe',
                 'rolex_chain_solid_pipes'=>'Solid Pipe',
                 'machine_chain_solid_pipes'=>'Solid Pipe',
                 'hollow_choco_chain_solid_pipes'=>'Solid Pipe',
                 'sisma_chain_solid_pipes'=>'Solid Pipe',
                 'imp_italy_chain_solid_pipes'=>'Solid Pipe',
                 'hollow_choco_chain_solid_pipes'=>'Solid Pipe',
                 'rope_chain_solid_wires'=>'Solid Wire',
                 'choco_chain_solid_wires'=>'Solid Wire',
                 'rolex_chain_solid_wires'=>'Solid Wire',
                 'machine_chain_solid_wires'=>'Solid Wire',
                 'hollow_choco_chain_solid_wires'=>'Solid Wire',
                 'sisma_chain_solid_wires'=>'Solid Wire',
                 'imp_italy_chain_solid_wires'=>'Solid Wire',
                 'hollow_choco_chain_solid_wires'=>'Solid Wire',
                 'rope_chain_hard_wires'=>'Hard Wire',
                 'choco_chain_hard_wires'=>'Hard Wire',
                 'rolex_chain_hard_wires'=>'Hard Wire',
                 'machine_chain_hard_wires'=>'Hard Wire',
                 'hollow_choco_chain_hard_wires'=>'Hard Wire',
                 'sisma_chain_hard_wires'=>'Hard Wire',
                 'imp_italy_chain_hard_wires'=>'Hard Wire',
                 'hollow_choco_chain_hard_wires'=>'Hard Wire',
                 'gpc_processes'=>'GPC Process',
                 'arcs'=>'ARC',
                 'casting_processes'=>'Casting Process',
                 'gpc_rolex_processes'=>'GPC Rolex Process',
                 'rolex_processes'=>'Rolex Process',
                 'shooks'=>'Shooks',
                 'arf_kdms'=>'ARF KDM',
                 'mesh_gope_chains'=>'Mesh Gope Chain',
                 'solder_wastage_out_melting_processes'=>'Solders',
                 'caps'=>'Cap',
                 'issue_arc_or_arf_processes'=>'Issue ARC or ARF',
                 'combine_processes'=>'Choco Chain Combine Process',
                 'casting_final_processes'=>'Choco Chain Casting Final Process',
                 'box_chain_processes'=>'Box Chain Process',
                 'hammering_ii_processes'=>'Hammering II Process',
                 'anchor_processes'=>'Anchor Process',
                 'box_start_processes'=>'Box Start Process',
                 'anchor_start_processes'=>'Anchor Start Process',
                 'cnc_processes'=>'CNC Process',
                 'dc_processes'=>'DC Process',
                 'dc_ii_processes'=>'DC II Process',
                 'round_and_ball_chain_processes'=>'Roun And Ball Chain Process',
                 'hook_processes'=>'Hook Process',
                 'hook_refresh_processes'=>'Hook Refresh Process',
                 'factory_processes'=>'Factory Process',
                 'factory_hold_processes' => 'Factory Hold Process',
                 'factory_hold_rnd_processes' => 'Factory Hold RND Process',
                 'cnc_recutting_processes' => 'CNC Recutting Process',
                 'dc_recutting_processes' => 'DC Recutting Process',
                 'dc_ii_recutting_processes' => 'DC II Recutting Process',
                 'round_and_ball_chain_recutting_processes' => 'Round and Ball Chain Recutting Process',
                 'customer_order_processes'=>'Customer Order Process',
                 'au_fe_processes'=>'AU + FE Process',
                 'pipes'=>'Pipes',
                 'lasiyas'=>'Lasiya',
                 'tars'=>'Tar',
                 'paras'=>'Para',
                 'nano_processes'=>'Nano Process',
                 'i_ten_processes'=>'I 10 Process',
                 'dhoom_a_processes'=>'Dhoom A',
                 'dhoom_b_processes'=>'Dhoom B',
                 'pipe_cuttings'=>'Pipe Cutting',
                 'para_final_processes'=>'Para Final Process',
                 'refresh_hold'=>'Refresh Hold',
                 'daily_drawer_melting_processes'=>'Daily Drawer Melting Process',
                 'daily_drawer_melting_final_processes'=>'Daily Drawer Melting Final Process',
                 'fancy_out_processes' => 'Fancy Out',
                 'fancy_customer_gpc_processes' => 'Fancy Customer GPC Process',
                 'melting_ii_processes' => 'Melting ii Process',
                 'pipe_and_para_start_processes'                => 'Start Process',
                 'pipe_and_para_hold_processes'                 => 'Hold Process',
                 'pipe_and_para_dull_processes'                 => 'Dull Process',
                 'pipe_and_para_copper_dull_processes'          => 'Copper Dull Process',
                 'pipe_and_para_copper_processes'               => 'Copper Process',
                 'pipe_and_para_hand_cutting_processes'         => 'Hand Cutting Process',
                 'pipe_and_para_round_and_ball_chain_processes' => 'Round and Ball Chain Process',
                 'pipe_and_para_rhodium_processes'              => 'Rhodium Process',
                 'rhodium_processes'              => 'Rhodium Process',
                 'pipe_and_para_cnc_processes'                  => 'CNC Process',
                 'pipe_and_para_final_processes'                => 'Final Process',
                 'strip_start_processes'                => 'Strip Start Process',
                 'rose_gold_two_tone_processes'                => 'Rose Gold TT Process',
                 'factory_hold_i_processes'                => 'Factory Hold I Process',
                 'factory_hold_plain_processes'                => 'Factory Hold Plain Process',
                 'hook_plain_processes'                => 'Hook Process',
                 'hook_ninety_plain_processes'                => 'Hook 92 Process',
                 'laser_plain_processes'                => 'Laser Process',
                 'plain_cutting_processes'                => 'Plain Cutting Process',
                 'stone_vatav_melting_processes'                => 'Stone Melting Process',
                 'rod_cleaning_melting_processes'                => 'Rod Cleaning Melting Process',
                 'yellow_and_white_gold_cutting_processes'                => 'Yellow and White Gold Cutting Process',
                 'rose_and_white_gold_cutting_processes'                => 'Rose and White Gold Cutting Process',
                 'copper_cutting_two_tone_processes'                => 'Copper Cutting Two Tone Process',
                 'laser_two_tone_processes'                => 'Laser Two Tone Process',
                 'casting_rnd_processes'                => 'Casting Rnd Process',
                 'stripper_two_tone_processes'                => 'Stripper Two Tone Process',
                 'factory_hold_two_tone_processes'                => 'Factory Hold Two Tone Process',
                 'factory_hold_ii_processes'                => 'Factory Hold II Process',
                 'final_gpc_processes' => 'GPC Process',
                 'hallmarking_processes' => 'Hallmarking Process',
                 'customer_order_hallmarking_processes' => 'Customer Hallmarking Process',
                 'rolex_final_gpc_processes' => 'Rolex GPC Process',
                 'refresh_final_processes' => 'Final Process',
                 'internal_final_processes' => 'Final Process',
                 'mangalsutra_processes' => 'Mangalsutra Process',
                 'hollow_choco_dye_processes' => 'Hollow Choco Dye Process',
                 'lotus_dye_processes' => 'Lotus Dye Process',
                 'roco_choco_dye_processes' => 'Roco Dye Process',
                 'nawabi_dye_processes' => 'Nawabi Dye Process',
                 'choco_chain_dye_processes' => 'Choco Chain Dye Process',
                 'rolex_chain_dye_processes' => 'Rolex Chain Dye Process',
                 'imp_italy_dye_processes' => 'Imp Italy Dye Process',
                 'engraving_out_processes' => 'Engraving Process',
                 'polish_processes' => 'Polish Process',
                 'buffing_processes' => 'Buffing Process',
                 'buffing_rnd_processes' => 'Buffing RND Process',
                 'hand_cutting_processes' => 'Hand Cutting Process',
                 'diamond_cutting_processes' => 'Diamond Cutting Process',
                 'cnc_processes' => 'Cnc Process',
                 'dull_processes' => 'Dull Process',
                 'round_and_ball_chain_processes' => 'Round and Ball Chain Process',
                 'fancy_hold_processes' => 'Fancy Hold Process',
                 'filing_processes' => 'Filing Process',
                 'pipe_and_para_stripping_processes' => 'Stripping Process',
                 'gpc_final_processes' => 'GPC Final Process',
                 'hand_dull_processes' => 'Hand Dull Process',
                 'sand_dull_processes' => 'Sand Dull Process',
                 'chain_making_arg_processes' => 'Chain Making Process',
                 'melting_loss_out_processes' => 'Melting Loss Out Process',
                 'refresh_hand_cutting_processes' => 'Hand Cutting Process',
                 'refresh_hand_dull_processes' => 'Hand Dull Process',
                 'meltings' => 'Melting',
                 'basket_processes' => 'Basket Proccess',
                 'casting_ninety_processes' => 'Casting 92',
                 'casting_seventy_processes' => 'Casting 75',
                 'chain_making_seventy_processes' => 'Cahin Making 75 Proccess',
                 'customer_bunch_order_processes' => 'Customer Bunch Proccess',
                 'pipe_and_para_lasiya_cutting_processes' => 'Lasiya Cutting Proccess',
                 'lasiya_cutting_processes' => 'Lasiya Cutting Proccess',
                 'internal_gpc_processes' => 'Internal GPC Processes',
                 'indo_tally_dye_processes' => 'Indo Tally Dye Process',
                 'indo_tally_dye_final_processes' => 'Indo Tally Dye Final Process',
                 'choco_chain_dye_final_processes' => 'Choco Chain Dye Final Process',
                 'rolex_chain_dye_final_processes' => 'Rolex Chain Dye Final Process',
                 'hollow_choco_dye_final_processes' => 'Hollow Choco Dye Final Process',
                 'lotus_dye_final_processes' => 'Lotus Dye Final Process',
                 'roco_choco_dye_final_processes' => 'Roco Choco Dye Final Process',
                 'nawabi_dye_final_processes' => 'Nawabi Dye Final Process',
                 'anchor_clipping_processes'=>'Anchor Clipping Process',
                 'two_mm_ball_processes'=>'Two Mm Ball Chain Process',
                 'pipe_clipping_processes'=>'Pipe Clipping Process',
                 'para_processes'=>'Para Process',
                 'patti_making_processes'=>'Patti Making Process',
                 'sisma_accessories_making_final_processes'=>'Sisma Accessories Making Final Process',
                 'quality_manager_processes'=>'Quality Manager Process',
                 'fire_assay_processes'=>'Fire Assay Process',
                 'fire_assay_out_chains'=>'Fire Assay Out Chain',
                 'huid_processes'=>'HUID Process',
                 'xrf_processes'=>'Xrf Process',
                 'electropolish_processes'=>'Electropolish Process',
                 'electropolish_rnd_processes'=>'Electropolish RND Process',
                 'electrostripping_processes'=>'Electrostripping Process',
                 'assembling_processes'=>'Assembling Process',
                 'soldering_processes'=>'Soldering Process',
                 'lock_processes'=>'Lock Process',
                 'arc_ornament_chains'=>'Arc Ornament Chain',
                 'quality_processes'=>'Quality Process',
                 'internal_pasta_gpc_processes'=>'Internal Pasta GPC Process',
                 'pipe_and_para_three_mm_slash_processes'=>'3.25 MM Slash Process',
                 'pipe_and_para_two_mm_slash_processes'=>'2 MM Slash Process',
                 'pipe_and_para_three_mm_dot_processes'=>'3.25 MM Dot Process',
                 'lock_buffing_processes'=>"Lock Buffing Process",
                 'lock_filing_processes'=>"Lock Filing Process",
                 'factory_out_processes'=>"Factory Out Process",
                 'hook_ninety_plain_processes'=>"Hook 92 Process",
                 'hallmark_out_hold_processes'=>"Hallmark Out Hold Process",
                 'tanishq_hold_processes'=>"Tanishq Hold Process",
                 'packing_processes'=>"Packing Process",
                 'hold_processes'=>"Hold Process",
                 'qc_processes'=>"QC Process",
                 'lopster_92_processes'=>"Lopster 92",
                 'lopster_75_processes'=>"Lopster 75",
                 'lopster_87_processes'=>"Lopster 87",
                 'lopster_83_processes'=>"Lopster 83",
                 'lopster_58_processes'=>"Lopster 58",
                 'lopster_41_processes'=>"Lopster 41",
                 'lopster_37_processes'=>"Lopster 37",
                 'lopster_final_processes'=>"Lopster Final Process",
                 'meena_filing_processes' => 'Meena Filing',
                 'hardening_processes' => 'Harding Process',
                 'booming_processes' => 'Booming Process',
                 'gpc_rhodium_processes' => 'GPC Rhodium'
                 );
  return $process_name[$key];
}

function get_melting_type(){
  if(HOST=="AR Gold Internal"){
    return  array(array('id'=>'AR','name'=>'AR'),
                 array('id'=>'ARK','name'=>'ARK'),
                 array('id'=>'HC','name'=>'HC'),
                 array('id'=>'IMP','name'=>'IMP'),
                 array('id'=>'IC','name'=>'IC'));
  }else{
    return  array(array('id'=>'Melting Lot','name'=>'Melting Lot'),
                 array('id'=>'Continuous Casting','name'=>'Continuous Casting'),
                 array('id'=>'Induction Process','name'=>'Induction Process'));
  }
}

function get_type(){
  return array(array('id'=>'Pure','name'=>'Pure'));
}

function get_hcl_ghiss_department(){
  return array(
             array('id'=>'Rope Chain,Solid Rope Chain,Machine Chain', 'name'=>'Rope Chain,Solid Rope Chain,Machine Chain'),
             array('id'=>'Hand Made Chain', 'name'=>'Hand Made Chain'),
             array('id'=>'Solid Machine Chain','name'=>'Solid Machine Chain'),
             array('id'=>'Indo tally Chain', 'name'=>'Indo tally Chain'),
             array('id'=>'Imp Italy Chain', 'name'=>'Imp Italy Chain'),
             array('id'=>'Hollow Choco Chain', 'name'=>'Hollow Choco Chain'),
             array('id'=>'Lotus Chain', 'name'=>'Lotus Chain'),
             array('id'=>'Lopster Making Chain', 'name'=>'Lopster Making Chain'),
             array('id'=>'Hollow Bangle Chain', 'name'=>'Hollow Bangle Chain'),
             array('id'=>'Roco Choco Chain', 'name'=>'Roco Choco Chain'),
             array('id'=>'Nawabi Chain', 'name'=>'Nawabi Chain'),
             array('id'=>'Casting 92 Chain', 'name'=>'Casting 92 Chain'),
             array('id'=>'Casting 75 Chain', 'name'=>'Casting 75 Chain'),
             array('id'=>'Office Outside', 'name'=>'Office Outside'));
}

function get_pending_ghiss_department(){
return array(
            array('id'=>'DC Department',
                  'name'=>'DC Department'),
//               array('id'=>'DC Recutting',
//                     'name'=>'DC Recutting'),
            array('id'=>'CNC Department',
                  'name'=>'CNC Department'),
//               array('id'=>'CNC Recutting',
//                     'name'=>'CNC Recutting'),
            array('id'=>'Round and Ball Chain',
                  'name'=>'Round and Ball Chain'),
//               array('id'=>'Round and Ball Chain Recutting',
//                     'name'=>'Round and Ball Chain Recutting'),
//               array('id'=>'Hand Cutting',
//                     'name'=>'Hand Cutting'),
//               array('id'=>'Dull',
//                     'name'=>'Dull')
            );
          
 } 

function get_ghiss_department(){
  if(HOST=='ARF'){
    return array(
               array('id'=>'DC Department,DC Recutting,Diamond Cutting,DC',
                     'name'=>'DC Department, DC Recutting,DC'),
               array('id'=>'CNC Department,CNC Recutting',
                     'name'=>'CNC Department, CNC Recutting'),
               array('id'=>'Round and Ball Chain,Round and Ball Chain Recutting,Round and Ball Chain Cutting',
                     'name'=>'Round and Ball Chain, Round and Ball Chain Recutting, Round and Ball Chain Cutting'),
               array('id'=>'Hand Cutting',
                     'name'=>'Hand Cutting'),
               array('id'=>'Hand Cutting II',
                     'name'=>'Hand Cutting II'),
               array('id'=>'Hand Cutting III',
                     'name'=>'Hand Cutting III'),
               array('id'=>'DC II Department',
                     'name'=>'DC II Department'),
               array('id'=>'Dull',
                     'name'=>'Dull'),
               array('id'=>'Sand Dull',
                     'name'=>'Sand Dull'),
                // array('id'=>'Ghiss Melting,Melting', 'name'=>'Melting'),
                array('id'=>'Lasiya Cutting', 'name'=>'Lasiya Cutting'),
               // array('id'=>'Stamping',
               //       'name'=>'Stamping'),
               // array('id'=>'Pipe And Para Making',
               //       'name'=>'Pipe And Para Making'),
               );

  }else if(HOST=='ARC'){
    return [
      ["id" => "Ghiss Melting", "name" => "Ghiss Melting"],
      ["id" => "Melting", "name" => "Melting"],
      ["id" => "Filing,Refiling", "name" => "Filing & Refiling I"],
      ["id" => "Lock Filing", "name" => "Lock Filing"],
      ["id" => "Filing II,Refiling II,Assembling", "name" => "Filing & Refiling II,Assembling"],
      ["id" => "Filing III,Refiling III", "name" => "Filing & Refiling III"],
      ["id" => "Filing RND,Refiling RND", "name" => "Filing & Refiling RND"],
      ["id" => "Cell I Refiling,Cell I Filing", "name" => "Cell I Refiling & Cell I Filing"],
      ["id" => "Cell II Refiling,Cell II Filing", "name" => "Cell II Refiling & Cell II Filing"],
      ["id" => "Stone Setting", "name" => "Stone Setting"],
      ["id" => "Stone Setting RND", "name" => "Stone Setting RND"],
      ["id" => "Hand Cutting", "name" => "Hand Cutting"],
      ["id" => "Hand Cutting II", "name" => "Hand Cutting II"],
      ["id" => "Hand Dull", "name" => "Hand Dull"],
      ["id" => "Casting", "name" => "Casting"],
      ["id" => "Buffing", "name" => "Buffing"],
      ["id" => "Grinding", "name" => "Grinding"],
      ["id" => "Buffing RND", "name" => "Buffing RND"],
      ["id" => "Meena Filing", "name" => "Meena Filing"],
      ["id" => "Meena", "name" => "Meena"]
    ];

  }else{

  return array(array('id'=>'Ag Melting,Chain Making,Melting,Ghiss Melting,PL Melting,Stamping,Wire Making',
                     'name'=>'Ag Melting,Chain Making,Melting,PL Melting,Stamping,Wire Making'),
               array('id'=>'Hand Dull,Hand Dull II',
                     'name'=>'Hand Dull,Hand Dull II'),
               array('id'=>'Buffing,PL Buffing',
                     'name'=>'Buffing,PL Buffing'),
               array('id'=>'Filing,Filing II',
                     'name'=>'Filing,Filing II'),
               array('id'=>'Cutting,Recutting',
                     'name'=>'Cutting'),
               array('id'=>'Ice Cutting',
                     'name'=>'Ice Cutting'),
               array('id'=>'Machine Department',
                     'name'=>'Machine Department'),
               array('id'=>'Hand Cutting',
                     'name'=>'Hand Cutting'),
               array('id'=>'Sisma Machine',
                     'name'=>'Sisma Machine'),
               array('id'=>'DC',
                     'name'=>'DC'));
  }
}function get_ghiss_issue_department(){
  if(HOST=='ARF'){
    return array(
               array('id'=>'DC Department',
                     'name'=>'DC Department'),
               array('id'=>'DC II Department',
                     'name'=>'DC II Department'),
               array('id'=>'CNC Department',
                     'name'=>'CNC Department'),
               array('id'=>'Round and Ball Chain',
                     'name'=>'Round and Ball Chain'),
               array('id'=>'Hand Cutting,Hand Cutting II,Hand Cutting III',
                     'name'=>'Hand Cutting,Hand Cutting II,Hand Cutting III'),
               array('id'=>'Dull',
                     'name'=>'Dull'),
               array('id'=>'Lasiya Cutting',
                     'name'=>'Lasiya Cutting'),
                array('id'=>'Ghiss Melting,Melting', 'name'=>'Melting'),
               // array('id'=>'Stamping',
               //       'name'=>'Stamping'),
               // array('id'=>'Pipe And Para Making',
               //       'name'=>'Pipe And Para Making'),
               );

  }else if(HOST=='ARC'){
    return array(
               array('id'=>'Ghiss Melting,Melting', 'name'=>'Melting'),
               array('id'=>'Casting', 'name'=>'Casting'),
               array('id'=>'Filing,Lock Filing', 'name'=>'Filing'),
               array('id'=>'Filing II,Assembling', 'name'=>'Filing II'),
               array('id'=>'Filing III', 'name'=>'Filing III'),
               array('id'=>'Filing RND,Refiling RND', 'name'=>'Filing RND'),
               array('id'=>'Stone Setting RND', 'name'=>'Stone Setting RND'),
               array('id'=>'Stone Setting', 'name'=>'Stone Setting'),
               array('id'=>'Hand Cutting', 'name'=>'Hand Cutting'),
               array('id'=>'Hand Cutting II', 'name'=>'Hand Cutting II'),
               array('id'=>'Hand Dull', 'name'=>'Hand Dull'),
               array('id'=>'Meena Filing', 'name'=>'Meena Filing'),
               array('id'=>'Grinding', 'name'=>'Grinding'),
               array('id'=>'Cell I Refiling,Cell I Filing', 'name'=>'Cell I Refiling & Cell I Filing'),
               array('id'=>'Cell II Refiling,Cell II Filing', 'name'=>'Cell II Refiling & Cell II Filing')
               );

  }else{

  return array(array('id'=>'AG Melting',
                     'name'=>'AG Melting'),
               array('id'=>'PL Buffing',
                     'name'=>'PL Buffing'),
               array('id'=>'Tounch Department',
                     'name'=>'Tounch Department'),
               array('id'=>'Melting',
                     'name'=>'Melting'),
               array('id'=>'Hand Dull',
                     'name'=>'Hand Dull'),
               array('id'=>'Buffing',
                     'name'=>'Buffing'),
               array('id'=>'Filing',
                     'name'=>'Filing'),
               array('id'=>'Cutting',
                     'name'=>'Cutting'),
               array('id'=>'Ice Cutting',
                     'name'=>'Ice Cutting'),
               array('id'=>'Machine Department',
                     'name'=>'Machine Department'),
               array('id'=>'Hand Cutting',
                     'name'=>'Hand Cutting'),
               array('id'=>'Sisma Machine',
                     'name'=>'Sisma Machine'));
  }
}
function get_ghiss_ledger_department() {
  return array(array('name' => 'All', 'id' => 'All'),
               array('name' => 'Hand Dull', 'id' => 'Hand Dull'),
               array('name' => 'Hand Cutting', 'id' =>'Hand Cutting'),
               array('name' => 'Filing', 'id' =>'Filing'),
               array('id'=>'Sisma Machine','name'=>'Sisma Machine'));
}function get_arc_order_process() {
  return array(array('name' => 'WAX', 'id' => 'WAX'),
               array('name' => 'PROJET', 'id' =>'PROJET'),
               array('name' => 'WAX SETTING', 'id' =>'WAX SETTING'));
}
function get_arc_order_product() {
  return array(array('name' => 'Chain', 'id' => 'Chain'),
               array('name' => 'Ornament', 'id' =>'Ornament'),
               // array('name' => 'Kuwaiti', 'id' =>'Kuwaiti'),
               array('name' => 'Turkey', 'id' =>'Turkey')
             );
}
function get_yes_no() {
  return array(array('name' => 'No', 'id' => '0'),
               array('name' => 'Yes', 'id' =>'1','selected'=>'selected'));
}

function get_daily_drawer_receipt_type(){
  if (HOST == 'ARF') {
    return array(array('id'=>'ARF Accessories','name'=>'ARF Accessories'),
                 array('id'=>'GPC Powder','name'=>'GPC Powder'));
  } else {
    return array(
               array('id'=>'Hook','name'=>'Hook'),
               array('id'=>'KDM','name'=>'KDM'),
               array('id'=>'Lobster','name'=>'Lobster'),
               array('id'=>'Ball','name'=>'Ball'),
               array('id'=>'Solid Pipe','name'=>'Solid Pipe'),
               array('id'=>'Hollow Pipe','name'=>'Hollow Pipe'),
               array('id'=>'Solid Wire','name'=>'Solid Wire'),
               array('id'=>'Cutting Wire','name'=>'Cutting Wire'),
               array('id'=>'Hard Wire','name'=>'Hard Wire'),
               array('id'=>'Cutting Pipe','name'=>'Cutting Pipe'),
               array('id'=>'Para','name'=>'Para'),
               array('id'=>'I/O Pic','name'=>'I/O Pic'),
               array('id'=>'Pipe','name'=>'Pipe'),
               array('id'=>'Anc Chain','name'=>'Anc Chain'),
               array('id'=>'Stone','name'=>'Stone'),
               array('id'=>'Sisma Pic','name'=>'Sisma Pic'),
               array('id'=>'1.8 pipe','name'=>'1.8 pipe'),
               array('id'=>'1.8mm kajol','name'=>'1.8mm kajol'),
               array('id'=>'1.8mm clipping','name'=>'1.8mm clipping'),
               array('id'=>'3mm clipping','name'=>'3mm clipping'),
               array('id'=>'2mm ball chain','name'=>'2mm ball chain'),
               array('id'=>'30 anchor','name'=>'30 anchor'),
               array('id'=>'30 pipe','name'=>'30 pipe'),
               array('id'=>'4gm fancy box','name'=>'4gm fancy box'),
               array('id'=>'Box pipe clipping','name'=>'Box pipe clipping'),
               array('id'=>'Cutting wire 0.5','name'=>'Cutting wire 0.5'),
               array('id'=>'Cutting wire 0.8','name'=>'Cutting wire 0.8'),
               array('id'=>'Cutting wire 1.1','name'=>'Cutting wire 1.1'),
               array('id'=>'Para 2mm','name'=>'Para 2mm'),
               array('id'=>'Para 3mm','name'=>'Para 3mm'),
               array('id'=>'Para 4mm','name'=>'Para 4mm'),
               array('id'=>'Plain Wire 0.4','name'=>'Plain Wire 0.4'),
               array('id'=>'Plain Wire 0.8','name'=>'Plain Wire 0.8'),
               array('id'=>'Tibki','name'=>'Tibki'),
               array('id'=>'Shook','name'=>'S'),
               array('id'=>'ARF KDM','name'=>'ARF KDM'),
               array('id'=>'Cap','name'=>'Cap'),
               array('id'=>'GPC Powder','name'=>'GPC Powder'),
               array('id'=>'Caping Accessories  ','name'=>'Caping Accessories '),
               array('id'=>'Spring','name'=>'Spring'),
               array('id'=>'Kadi','name'=>'Kadi'),
               array('id'=>'Screw','name'=>'Screw'),
               array('id'=>'Wire','name'=>'Wire'),
               array('id'=>'Chain','name'=>'Chain'),
               array('id'=>'Clip','name'=>'Clip'),
               array('id'=>'Loop','name'=>'Loop'),
               array('id'=>'Latkan','name'=>'Latkan'),
               array('id'=>'Stripe','name'=>'Stripe'),
              );
  }
}

function get_sisma_type(){
  return array(array('id'=>'Sisma Accessories','name'=>'Sisma Accessories'),
               array('id'=>'Kala Mani','name'=>'Kala Mani'),
               );
}function get_sisma_bom_type(){
  return array(array('id'=>'35 PLAIN WIRE','name'=>'35 PLAIN WIRE'),
               array('id'=>'40 PLAIN WIRE','name'=>'40 PLAIN WIRE'),
               array('id'=>'65 PLAIN WIRE','name'=>'65 PLAIN WIRE'),
               array('id'=>'50 CUTTING WIRE','name'=>'50 CUTTING WIRE'),
               array('id'=>'60 CUTTING WIRE','name'=>'60 CUTTING WIRE'),
               array('id'=>'70 CUTTING WIRE','name'=>'70 CUTTING WIRE'),
               array('id'=>'80 CUTTING WIRE','name'=>'80 CUTTING WIRE'),
               array('id'=>'110 CUTTING WIRE','name'=>'110 CUTTING WIRE'),
               array('id'=>'2MM PARA','name'=>'2MM PARA'),
               array('id'=>'2.5MM PARA','name'=>'2.5MM PARA'),
               array('id'=>'3MM PARA','name'=>'3MM PARA'),
               array('id'=>'4MM PARA','name'=>'4MM PARA'),
               array('id'=>'5MM PARA','name'=>'5MM PARA'),
               array('id'=>'OMEGA','name'=>'OMEGA'),
               array('id'=>'CAP','name'=>'CAP'),
               array('id'=>'TIKLI','name'=>'TIKLI'),
               array('id'=>'1.80 ROUND CUTTING PIPE','name'=>'1.80 ROUND CUTTING PIPE'),
               array('id'=>'PUSH LOCK','name'=>'PUSH LOCK'),
               array('id'=>'FISH LOPSTER','name'=>'FISH LOPSTER'),
               array('id'=>'RING LOPSTER','name'=>'RING LOPSTER'),
               array('id'=>'30 ANC CHAIN','name'=>'30 ANC CHAIN'),
               array('id'=>'40 ANC CHAIN','name'=>'40 ANC CHAIN'),
               array('id'=>'50 ANC CHAIN','name'=>'50 ANC CHAIN'),
               array('id'=>'3MM ANC CHAIN','name'=>'3MM ANC CHAIN'),
               array('id'=>'1.5MM CEPCULE CLIPPING','name'=>'1.5MM CEPCULE CLIPPING'),
               array('id'=>'2MM BALL CHAIN','name'=>'2MM BALL CHAIN'),
               array('id'=>'KAJOL CHAIN','name'=>'KAJOL CHAIN'),
               array('id'=>'3LINE BALL CHAIN','name'=>'3LINE BALL CHAIN'),
               array('id'=>'1.8 MM BALL CLIPPING','name'=>'1.8 MM BALL CLIPPING'),
               array('id'=>'2 FANCY BOX','name'=>'2 FANCY BOX'),
               array('id'=>'INDRAJEET CHAIN','name'=>'INDRAJEET CHAIN'),
               array('id'=>'OPEN PIPE','name'=>'OPEN PIPE'),
               );
}

function get_alloy_type(){
  return array(
               array('id'=>'Pro Gold-Genia 123','name'=>'Pro Gold-Genia 123'),
               array('id'=>'Galorini-SY2022','name'=>'Galorini-SY2022'),
               array('id'=>'Silver','name'=>'Silver'),
               array('id'=>'Pro Gold-Genia 154','name'=>'Pro Gold-Genia 154'),
               array('id'=>'Indian Co-GR30','name'=>'Indian Co-GR30'),
               array('id'=>'Galorini-RLG-RR','name'=>'Galorini-RLG-RR'),
               array('id'=>'Pro Gold-Genia 173','name'=>'Pro Gold-Genia 173'),
               array('id'=>'Ekisson-FAS10','name'=>'Ekisson-FAS10'),
               array('id'=>'Zinc','name'=>'Zinc'),
               array('id'=>'Pro Gold-Unibax 121','name'=>'Pro Gold-Unibax 121'),
               array('id'=>'Galorini-SSR-1418M','name'=>'Galorini-SSR-1418M'),
               array('id'=>'Mix Alloy','name'=>'Mix Alloy'),
               );
}

function get_chain_receipt_type(){
  return array(array('id'=>'Solid Machine Chain','name'=>'Solid Machine Chain'),
               array('id'=>'Box Chain','name'=>'Box Chain'),
               array('id'=>'Italy Chain','name'=>'Italy Chain'),
               array('id'=>'Hollow Machine Chain','name'=>'Hollow Machine Chain'),
               array('id'=>'Round Box Chain','name'=>'Round Box Chain'),
               array('id'=>'Choco Chain','name'=>'Choco Chain'),
               array('id'=>'Rolex Chain','name'=>'Rolex Chain'));
}
function get_account_name(){
    if(HOST=='ARF'){
      $karigars = array(array('id' => 'ARC Software '.HOSTVERSION,     'name' => 'ARC Software'.HOSTVERSION),
                        array('id' => 'AR Gold Software '.HOSTVERSION, 'name' => 'AR Gold Software'.HOSTVERSION));
    }elseif(HOST=='ARC'){
      $karigars = array(array('id' => 'ARF Software'.HOSTVERSION,     'name' => 'ARF Software'.HOSTVERSION),
                        array('id' => 'AR Gold Software'.HOSTVERSION, 'name' => 'AR Gold Software'.HOSTVERSION),
                        array('id' => 'Stone', 'name' => 'Stone'));
    }else{
      $karigars = array(array('id' => 'ARF Software '.HOSTVERSION, 'name' => 'ARF Software'.HOSTVERSION),
                        array('id' => 'ARC Software '.HOSTVERSION, 'name' => 'ARC Software'.HOSTVERSION));
    }
  return $karigars;
}

function get_melting_description(){
  return array(array('id'=>'AG','name'=>'AG'),
               array('id'=>'PL','name'=>'PL')
              );
} 

function daily_drawer_melting(){
  return array(array('id'=>'92.00','name'=>'88% >'),
               array('id'=>'87.65','name'=>'86% - 88%'),
               array('id'=>'83.65','name'=>'80% - 85%'),
               array('id'=>'75.15','name'=>'< 80%'));

}

function get_melting_purity(){
  if(HOST=='ARF'){
    return array(array('id'=>'91.80','name'=>'91.80'),
                 //array('id'=>'91.90','name'=>'91.90'),
                 //array('id'=>'83.65','name'=>'83.65'),
                 //array('id'=>'83.50','name'=>'83.50'),
                 array('id'=>'83.35','name'=>'83.35'),
                 array('id'=>'87.65','name'=>'87.65'),
                 //array('id'=>'84.00','name'=>'84.00'),
                 array('id'=>'75.25','name'=>'75.25'),
                 //array('id'=>'75.15','name'=>'75.15'),
                 //array('id'=>'75.00','name'=>'75.00'),
                 array('id'=>'70.00','name'=>'70.00'),
                 array('id'=>'58.50','name'=>'58.50'),
                 array('id'=>'41.70','name'=>'41.70'),
                 array('id'=>'37.50','name'=>'37.50')
                 );
  }else{
    return array(array('id'=>'100.00','name'=>'100.00'),
                 array('id'=>'92.00','name'=>'92.00'),
                 array('id'=>'91.80','name'=>'91.80'),
                 array('id'=>'91.85','name'=>'91.85'),
                 array('id'=>'91.75','name'=>'91.75'),
                 array('id'=>'87.65','name'=>'87.65'),
                 array('id'=>'83.65','name'=>'83.65'),
                 array('id'=>'83.50','name'=>'83.50'),
                 array('id'=>'87.50','name'=>'87.50'),
                 array('id'=>'75.25','name'=>'75.25'),
                 array('id'=>'75.15','name'=>'75.15'),
                 array('id'=>'75.05','name'=>'75.05'),
                 array('id'=>'75.00','name'=>'75.00'),
                 array('id'=>'70.00','name'=>'70.00'),
                 array('id'=>'58.50','name'=>'58.50'),
                 array('id'=>'41.70','name'=>'41.70'),
                 array('id'=>'37.50','name'=>'37.50')
                 );
  }
  

}

function get_parent_lot_melting_purity(){
  return array(array('id'=>'92',    'name'=>'92.00'),
               array('id'=>'91.85', 'name'=>'91.85'),
               array('id'=>'87',    'name'=>'87.65'),
               array('id'=>'83',    'name'=>'83.65'),
               array('id'=>'83.50', 'name'=>'83.50'),
               array('id'=>'75',    'name'=>'75.15'),
               array('id'=>'58',    'name'=>'58.50'),
               array('id'=>'41.70', 'name'=>'41.70'),
               array('id'=>'37.50','name'=>'37.50')
               );

}
function get_parent_lot_hook_kdm_purity(){
  return array(array('id'=>'92','name'=>'92.00'),
               array('id'=>'91.85','name'=>'91.85'),
               array('id'=>'87','name'=>'87.65'),
               array('id'=>'83','name'=>'83.65'),
               array('id'=>'83.50','name'=>'83.50'),
               array('id'=>'75','name'=>'75.15'),
               array('id'=>'58','name'=>'58.50'),
               array('id'=>'41.70','name'=>'41.70'),
               array('id'=>'37.50','name'=>'37.50')
               );

}

if (!function_exists('get_daily_drawer_type')) {
  function get_daily_drawer_type(){
    $daily_drawer_type=array(
      'kdm'=>'KDM', 
      'hook'=>'HOOK', 
      'lobster'=>'Lobster',
      'liquid_gold'=>'Liquid Gold'
    );
    return $daily_drawer_type;
  }
}

function get_design_code_cols($process){
  $cols=array(
      'Rope Chain'=>array(
          'design_code'=>'Design Code',
          'length'=>'Length',
          'design_description'=>'Description',
          'remarks'=>'Remarks',
      ),'Solid Rope Chain'=>array(
          'design_code'=>'Design Code',
          'length'=>'Length',
          'design_description'=>'Description',
          'remarks'=>'Remarks',
      ),
      'Hollow Machine Chain'=>array(
          'design_code'=>'Design Code',
          'karigar_out'=>'Karigar',
          'length'=>'Length',
          'design_description'=>'Machine',
          'remarks'=>'Remarks',
      ),
      'Choco Chain'=>array(
          'design_code'=>'Design Code',
          'karigar_out'=>'Karigar',
          'tone'=>'Tone',
          'length'=>'Length',
          'design_description'=>'Order Weight',
          'remarks'=>'Remarks',
      ),'Rolex Chain'=>array(
          'design_code'=>'Design Code',
          'karigar_out'=>'Karigar',
          'tone'=>'Tone',
          'length'=>'Length',
          'design_description'=>'Order Weight',
          'remarks'=>'Remarks',
      ),
      'Round Box Chain'=>array(
          'design_code'=>'Design Code',
          'karigar_out'=>'Karigar',
          'tone'=>'Tone',
          'length'=>'Length',
          'remarks'=>'Remarks',
      ),
      'Milano Chain'=>array(
          'design_code'=>'Design Code',
          'karigar_out'=>'Karigar',
          'tone'=>'Tone',
          'length'=>'Length',
          'remarks'=>'Remarks',
      ),
      'Pipe Chain'=>array(
          'karigar_out'=>'Karigar',
          'design_code'=>'Design Code',
          'length'=>'Length',
          'design_description'=>'Description',
          'remarks'=>'Remarks',
      ),
      'Office Outside'=>array(
          'design_code'=>'Design Code',
          'length'=>'Length',
          'design_description'=>'Description',
          'remarks'=>'Remarks',
      ),
  );
  return (isset($cols[$process])) ? $cols[$process] : array();
}

function get_choco_chain_options() {
  return array(array('id' => 'Choco', 'name' => 'Choco'),
               array('id' => 'Choco IMP', 'name' => 'Choco IMP'),
               array('id' => 'Choco RND', 'name' => 'Choco RND')
               /*array('id' => 'Casting Chain', 'name' => 'Casting Chain')*/);
}function get_rolex_chain_options() {
  return array(array('id' => 'Rolex', 'name' => 'Rolex'),
               array('id' => 'Rolex IMP', 'name' => 'Rolex IMP'),
               array('id' => 'Rolex RND', 'name' => 'Rolex RND')
               /*array('id' => 'Casting Chain', 'name' => 'Casting Chain')*/);
}
function get_pipe_and_para_options() {
  return array(array('id' => 'Pipe and Para Start Process', 'name' => 'Pipe and Para Start Process'),
               array('id' => '3.25 MM Slash', 'name' => '3.25 MM Slash'),
               array('id' => '3.25 MM Dot', 'name' => '3.25 MM Dot'),
               array('id' => '2 MM Slash', 'name' => '2 MM Slash')
               /*array('id' => 'Casting Chain', 'name' => 'Casting Chain')*/);
}

function get_sisma_accessories_making_chain_options() {
  return array(array('id' => 'Anchor Clipping', 'name' => 'Anchor Clipping'),
               array('id' => '2 MM Ball Chains', 'name' => '2 MM Ball Chains'),
               array('id' => 'Pipe Clipping', 'name' => 'Pipe Clipping'),
               array('id' => 'Para', 'name' => 'Para'),
               array('id' => 'Patti Making', 'name' => 'Patti Making'));
}

function get_ball_chain_category_one() {
  return array(array('id' => 'Capsule', 'name' => 'Capsule'),
               array('id' => 'Ball Cap', 'name' => 'Ball Cap'),
               array('id' => 'Ball Chain', 'name' => 'Ball Chain'),
               array('id' => 'Big Barrel', 'name' => 'Big Barrel'),
               array('id' => 'Kajol', 'name' => 'Kajol'),
               array('id' => 'K.Cap', 'name' => 'K.Cap'),
               array('id' => 'Peanut', 'name' => 'Peanut'),
               array('id' => 'Double Ball', 'name' => 'Double Ball'),
               );
}
function get_ball_chain_category_two() {
  return array(array('id' => 'Yellow', 'name' => 'Yellow'),
               array('id' => 'Rose', 'name' => 'Rose'),
               array('id' => 'White', 'name' => 'White'),
               );
}
function get_ball_chain_tone() {
  return array(array('id' => 'PLAIN', 'name' => 'A. PLAIN'),
                                 array('id' => '2 Tone', 'name' => 'B. 2 TONE'),
                                 array('id' => 'RG 2 TONE', 'name' => 'C. RG 2 TONE'),
                                 array('id' => 'RG and WG', 'name' => 'D. RG and WG'),
                                 array('id' => 'YG and WG', 'name' => 'E. YG and WG'),
                                 );
}
function get_ball_chain_category_three(){
  return array(array('id' => '0.75', 'name' => '0.75'),
               array('id' => '0.8', 'name' => '0.8'),
               array('id' => '1', 'name' => '1'),
               array('id' => '1.2', 'name' => '1.2'),
               array('id' => '1.5', 'name' => '1.5'),
               array('id' => '1.8', 'name' => '1.8'),
               array('id' => '2', 'name' => '2'),
               array('id' => '2.5', 'name' => '2.5'),
               array('id' => '3', 'name' => '3'),
              );
}
function get_ball_chain_cutting() {
  return array(array('id' => 'C-Cutting', 'name' => 'C-Cutting'),
               array('id' => 'Slash-Cutting', 'name' => 'Slash-Cutting'),
               array('id' => '3 L Frosted', 'name' => '3 L Frosted'),
               array('id' => '7 L Frosted', 'name' => '7 L Frosted'),
               array('id' => 'Flat Cutting', 'name' => 'Flat Cutting'),
               array('id' => 'Mix Cutting', 'name' => 'Mix Cutting'),
               );
}
function get_ball_chain_item_name() {
  return array(array('id' => 'SINGLE', 'name' => 'SINGLE'),
               array('id' => 'BUNCHES', 'name' => 'BUNCHES'),
               array('id' => 'TRIANGLE', 'name' => 'TRIANGLE'),
               array('id' => 'IND', 'name' => 'IND'),
               array('id' => 'SUNDARI', 'name' => 'SUNDARI'),
               array('id' => 'TVT', 'name' => 'TVT'),
               array('id' => 'ASMI', 'name' => 'ASMI'),
               array('id' => 'RDX', 'name' => 'RDX'),
               array('id' => '3LTRIDEV', 'name' => '3LTRIDEV'),
               array('id' => '4LTRIDEV', 'name' => '4LTRIDEV'),
               array('id' => '5LTRIDEV', 'name' => '5LTRIDEV'),
               array('id' => '7LTRIDEV', 'name' => '7LTRIDEV'),
               array('id' => 'SHIVA', 'name' => 'SHIVA'),
               );
}

function get_ka_chain_options() {
  return array(array('id' => 'Vishnu', 'name' => 'Vishnu'),
               array('id' => 'Hammering', 'name' => 'Hammering'),
               array('id' => 'Laser', 'name' => 'Laser'),
               array('id' => 'Ashish', 'name' => 'Ashish'),
               array('id' => 'Clipping', 'name' => 'Clipping'));
}

function get_chain_options($chain_name){
  $chain_options = array('Choco Chain' => array(
                            array('id' => 'Choco', 'name' => 'Choco'),
                            array('id' => 'Choco IMP', 'name' => 'Choco IMP'),
                            array('id' => 'Choco RND', 'name' => 'Choco RND'),
                            // array('id' => 'Casting Chain', 'name' => 'Casting Chain')
                        ),'Rolex Chain' => array(
                            array('id' => 'Rolex', 'name' => 'Rolex'),
                            array('id' => 'Rolex IMP', 'name' => 'Rolex IMP'),
                            array('id' => 'Rolex RND', 'name' => 'Rolex RND'),
                            // array('id' => 'Casting Chain', 'name' => 'Casting Chain')
                        ),
                        'KA Chain' => array(array('id' => 'Vishnu', 'name' => 'Vishnu'),
                            array('id' => 'Hammering', 'name' => 'Hammering'),
                            array('id' => 'Laser', 'name' => 'Laser'),
                            array('id' => 'Ashish', 'name' => 'Ashish'))
                        );
 
  return isset($chain_options[$chain_name])?$chain_options[$chain_name]:array();
}

function get_machine_chain_options() {
  return array(array('id' => 'Machine', 'name' => 'Machine'),
               array('id' => 'Machine Rolex', 'name' => 'Machine Rolex'));
}

function get_product_by_sort_name($sort_form){
 
  $product = array('FC'=>'Fancy Chain',
          'FC75'=>'Fancy 75 Chain',
          'RC'=>'Rope Chain',
          'SRC'=>'Solid Rope Chain',
          'R'=>'Refresh',
          'DRC'=>'Daily Drawer Rope Chain',
          'HC' =>'Hollow Chain',
          'DHC' =>'Daily Drawer Hollow Chain',
          'LC' =>'Lotus Chain',
          'LMC' =>'Lopster Making Chain',
          'HBC' =>'Hollow Bangle Chain',
          'ROC' =>'Roco Choco Chain',
          'NC' =>'Nawabi Chain',
          'CN' =>'Casting 92 Chain',
          'CS' =>'Casting 75 Chain',
          'HCC' =>'Hollow Choco Chain',
          'DHCC' =>'Daily Drawer Hollow Choco Chain',
          'IIC' => 'Imp Italy Chain',
          'DIIC' => 'Daily Drawer Imp Italy Chain',
          'ITC' =>'Indo tally Chain',
          'DITC' =>'Daily Drawer Indo tally Chain',
          'SC'=>'Sisma Chain',
          'DSC'=>'Daily Drawer Sisma Chain',
          'CC'=>'Choco Chain',
          'RC'=>'Rolex Chain',
          'DCC'=>'Daily Drawer Choco Chain',
          'MC'=>'Machine Chain',
          'SMC'=>'Solid Machine Chain',
          'DMC'=>'Daily Drawer Machine Chain',
          'RBC'=>'Round Box Chain',
          'DRBC'=>'Daily Drawer Round Box Chain',
          'OOH'=>'Office Outside Hook',
          'OOH'=>'Office Outside Pipe',
          'DOOH'=>'Daily Drawer Office Outside Hook',
          'OOK'=>'Office Outside KDM',
          'DOOK'=>'Daily Drawer Office Outside KDM',
          'OOL'=>'Office Outside Lobster',
          'DOOL'=>'Daily Drawer Office Outside Lobster',
          'OOB'=>'Office Outside Ball',
          'OOHW'=>'Office Outside Hard Wire',
          'DOOB'=>'Daily Drawer Office Outside Ball',
          'OOCW'=>'Office Outside Cutting Wire',
          'DOOCW'=>'Daily Drawer Office Outside Cutting Wire',
          'OOCP'=>'Office Outside Cutting Pipe',
          'DEOOCP'=>'Daily Drawer Office Outside Cutting Pipe',
          'OOSP'=>'Office Outside Solid Pipe',
          'DOOSP'=>'Daily Drawer Office Outside Solid Pipe',
          'OOHP'=>'Office Outside Hollow Pipe',
          'DOOHP'=>'Daily Drawer Office Outside Hollow Pipe',
          'DOOSS'=>'Daily Drawer Office Outside Sisma Stripe',
          'OOSS'=>'Office Outside Sisma Stripe',
          'OOSW'=>'Office Outside Solid wire',
          'DOOSW'=>'Daily Drawer Office Outside Solid wire',
          'GC'=>'Ghiss Cutting',
          'DGC'=>'Daily Drawer Ghiss Cutting',
          'DC'=>'Daily Drawer',
          'DDC'=>'Daily Drawer Daily Drawer',
          'OO'=>'Office Outside',
          'DOO'=>'Daily Drawer Office Outside',
          'ARC'=>'ARC',
          'DARC'=>'Daily Drawer ARC',
          'H'=>'HCL',
          'DH'=>'Daily Drawer HCL',
        );
  return isset($product[$sort_form])?$product[$sort_form]:'';
}

function get_category_one() {
  return array('Rope Chain' => array(array('id'=>'50-A','name'=>'50-A')));
}

function get_category_two() {
   if(HOST!='ARF')
  return array('Rope Chain' => array('50-A' => array(array('id' => "5Gm", 'name' => "5Gm"))),
               );
}

function get_category_three() {
   if(HOST!='ARF')
  return array('Rope Chain' => array('50-A' => array("5Gm" => array(array('id' => '26', 'name' => '26')))));
}function get_category_four() {

/*  $data=array();
    $category_four=array();
    $ci =& get_instance();
    $ci->load->model('settings/category_four_model');
    $categories= $ci->category_four_model->get('',array('product_name'=>'KA Chain'));
       if(!empty($categories)){
      foreach ($categories as $index => $category) {
        $category_one = str_replace(' ','_', $category['category_one']);      
        $product_name = $category['product_name'];
        if (!isset($data[$product_name]))
          $data[$product_name]= array();  
             
        if (!isset($data[$product_name][$category_one])) 
        $data[$product_name][$category_one] = array();     
        $data[$product_name][$category_one][]= array('id'=>$category['category'],
                                                     'name'=>$category['category']);
      
    }
   return $data;
  }*/

  return array('Rope Chain' => array('50-A' => array("5Gm" =>array('26' => array(array('id' => '3mm', 'name' => '3mm'))))));
  

}
function get_category_five() {
   if(HOST!='ARF')
   return array('Rope Chain' => array('50-A' => array("5Gm" =>array('26' => array('3mm' => array(array('id' => '350', 'name' => '350')))))));
}



function get_choco_chain_design_code($limit) {
  $design_codes = array();
  for ($i=1; $i <= $limit; $i++) {
    $design_codes[] = array('id' => ''.sprintf("%02d", $i).'', 'name' => ''.sprintf("%02d", $i).''); 
  }
  return $design_codes;
}
function get_design_code_no($limit) {
  $design_codes = array();
  for ($i=1; $i <= $limit; $i++) {
    $design_codes[] = array('id' => 'AR-'.sprintf("%02d", $i).'', 'name' => 'AR-'.sprintf("%02d", $i).''); 
  }
  return $design_codes;
}

function get_excluded_departments() {
  return array('Round Box Chain' => array('Bahubali' => array('12' => array('17' => array('Single_Tone' => array('Copper',
                                                                                                                 'Stripping'),
                                                                                          'Two_Tone' => array())),
                                                              '16' => array('18' => array('Single_Tone' => array('Copper',
                                                                                                                 'Stripping'),
                                                                                          'Two_Tone' => array()))),
                                          'Spark' => array('08' => array('14' => array('Single_Tone' => array('Hammering',
                                                                                                              'Copper',
                                                                                                              'Stripping'),
                                                                                       'Two_Tone' => array('Hammering'))),
                                                           '12' => array('16' => array('Single_Tone' => array('Hammering',
                                                                                                              'Copper',
                                                                                                              'Stripping'),
                                                                                       'Two_Tone' => array('Hammering')))),
                                          'Walzer' => array('12' => array('20' => array('Single_Tone' => array('Hammering',
                                                                                                               'Copper',
                                                                                                               'Stripping'),
                                                                                        'Two_Tone' => array('Hammering')))),
                                          'Skoda' => array('06' => array('16' => array('Single_Tone' => array('Copper',
                                                                                                              'Stripping'),
                                                                                       'Two_Tone' => array())),
                                                           '12' => array('20' => array('Single_Tone' => array('Copper',
                                                                                                              'Stripping'),
                                                                                       'Two_Tone' => array()))),
                                          'Boomer' => array('04' => array('14' => array('Single_Tone' => array('Hammering',
                                                                                                               'Copper',
                                                                                                               'Stripping'),
                                                                                        'Two_Tone' => array('Hammering'))),
                                                            '12' => array('22' => array('Single_Tone' => array('Hammering',
                                                                                                               'Copper',
                                                                                                               'Stripping')))),
                                          'Bombarto_Code' => array('04' => array('12' => array('Single_Tone' => array('Hammering',
                                                                                                                      'Copper',
                                                                                                                      'Stripping'))),
                                                                   '12' => array('18' => array('Single_Tone' => array('Hammering',
                                                                                                                      'Copper',
                                                                                                                      'Stripping')))),
                                           'Raes_Code' => array('12' => array('20' => array('Single_Tone' => array('Copper',
                                                                                                                  'Stripping'),
                                                                                           'Two_Tone' => array()))),
                                          'Pentagon' => array('12' => array('17' => array('Single_Tone' => array('Copper',
                                                                                                                 'Stripping')))),
                                          'Affair' => array('08' => array('20' => array('Single_Tone' => array('Hammering',
                                                                                                               'Copper',
                                                                                                               'Stripping'),
                                                                                        'Two_Tone' => array('Hammering')))),
                                          'New_Mercury' => array('12' => array('19' => array('Single_Tone' => array('Copper',
                                                                                                               'Stripping'),
                                                                                             'Two_Tone' => array())))));
}

function get_melting_lots_lot_purity() {
  return array(
               'Rope Chain' => array(array('id' => '92.4', 'name' => '92.4'),
                                     array('id' => '92.25', 'name' => '92.25'),
                                     array('id' => '92.1', 'name' => '92.1'),
                                     array('id' => '92', 'name' => '92'),
                                     array('id' => '83.65', 'name' => '83.65'),
                                     array('id' => '83.50', 'name' => '83.50'),
                                     array('id' => '75.15', 'name' => '75.15')),
               'Solid Rope Chain' => array(array('id' => '92.4', 'name' => '92.4'),
                                     array('id' => '92.25', 'name' => '92.25'),
                                     array('id' => '92.1', 'name' => '92.1'),
                                     array('id' => '92', 'name' => '92'),
                                     array('id' => '83.65', 'name' => '83.65'),
                                     array('id' => '83.50', 'name' => '83.50'),
                                     array('id' => '75.15', 'name' => '75.15')),
               'Machine Chain' => array(array('id' => '92.25', 'name' => '92.25'),
                                        array('id' => '92.1', 'name' => '92.1'),
                                        array('id' => '92', 'name' => '92'),
                                        array('id' => '83.65', 'name' => '83.65'),
                                        array('id' => '83.50', 'name' => '83.50'),
                                        array('id' => '75.15', 'name' => '75.15')),
                'ARC' => array(array('id' => '92', 'name' => '92'),
                               array('id' => '91.80', 'name' => '91.80'),
                               array('id' => '91.75', 'name' => '91.75'),
                               array('id' => '87.65', 'name' => '87.65'),
                               array('id' => '87.45', 'name' => '87.45'),
                               array('id' => '83.50', 'name' => '83.50'),
                               array('id' => '75.15', 'name' => '75.15')),
               'Other Chain' => array(array('id' => '92', 'name' => '92'),
                                      array('id' => '87.65', 'name' => '87.65'),
                                      array('id' => '83.65', 'name' => '83.65'),
                                      array('id' => '83.50', 'name' => '83.50'),
                                      array('id' => '75.15', 'name' => '75.15')));
}

function get_melting_lots_tone() {
  return array('Imp Italy Chain' => array(array('id' => 'Pink', 'name' => 'Pink'),
                                          array('id' => 'Yellow', 'name' => 'Yellow')),
               'Office Outside Hollow Pipe' => array(array('id' => 'Yellow', 'name' => 'Yellow'),
                                                     array('id' => 'Pink', 'name' => 'Pink')),
               'Office Outside Solid Pipe' => array(array('id' => 'Yellow', 'name' => 'Yellow'),
                                                     array('id' => 'Pink', 'name' => 'Pink')),
               'Sisma Chain' => array(array('id' => 'Pink', 'name' => 'Pink')),
               'Office Outside KDM' => array(array('id' => 'Pink', 'name' => 'Pink'),
                                             array('id' => 'Yellow', 'name' => 'Yellow')),
               'ARC' => array(array('id' => 'Pink', 'name' => 'Pink'),
                              array('id' => 'Yellow', 'name' => 'Yellow'),
                              array('id' => 'White', 'name' => 'White'),
                              array('id' => 'Green', 'name' => 'Green'),
                              ),
               'Choco Chain' => array(array('id' => 'Pink', 'name' => 'Pink'),
                                             array('id' => 'Yellow', 'name' => 'Yellow')),
                'Rolex Chain' => array(array('id' => 'Pink', 'name' => 'Pink'),
                                             array('id' => 'Yellow', 'name' => 'Yellow')));
}

function get_order_status()
{
  return array(array('name'=> 'OPEN', 'id' => 'OPEN'),
               array('name' => 'CLOSED', 'id' => 'CLOSED'));
}

function get_dashboard_side_menu_dropdown(){
    return array(
      'dashboards/common_dashboards'=>'Dashboard',
      'dashboards/wastage_melting_dashboards'=>'Wastage Melting Dashboard',
      'dashboards/office_outside_dashboards'=>'Office Outside Dashboard',
      'arcs/arc_dashboards'=>'ARC Dashboard',
     'rope_chains/dashboards'=>'Rope Chain Dashboard',
     'solid_rope_chains/dashboards'=>'Solid Rope Chain Dashboard',
     'solid_nawabi_chains/dashboards'=>'Solid Nawabi Chain Dashboard',
     'solid_nawabi_chains/dashboards'=>'Solid Rope Chain Dashboard',
     'choco_chains/dashboards'=>'Choco Chain Dashboard',
     'rolex_chains/dashboards'=>'Rolex Chain Dashboard',
     'machine_chains/dashboards' => 'Machine Chain Dashboard',
     'solid_machine_chains/dashboards' => 'Solid Machine Chain Dashboard',
     'round_box_chains/dashboards' => 'Round Box Chain Dashboard',
     'sisma_chains/dashboards' => 'Sisma Chain Dashboard',
     'imp_italy_chains/dashboards' => 'Imp Italy Chain Dashboard',
     'indo_tally_chains/dashboards' => 'Indo Tally Chain Dashboard',
     'hollow_choco_chains/dashboards' => 'Hollow Choco Chain Dashboard',
     'lotus_chains/dashboards' => 'Lotus Chain Dashboard',
     'lopster_making_chains/dashboards' => 'Lopster Making Chain Dashboard',
     'hollow_bangle_chains/dashboards' => 'Hollow Bangle Chain Dashboard',
     'roco_choco_chains/dashboards' => 'Roco Choco Chain Dashboard',
     'nawabi_chains/dashboards' => 'Nawabi Chain Dashboard',
     'fancy_chains/dashboards' => 'Fancy Chain Dashboard',
     'refresh/dashboards' => 'Refresh Chain Dashboard',
     'ka_chains/dashboards' => 'KA Chain Dashboard',
     'sisma/dashboards' => 'Refresh Chain Dashboard',
     'arcs/dashboards' => 'ARC Dashboard',
     'dashboards/hcl_dashboards' => 'HCL Dashboard',
     'dashboards/department_dashboards' => 'Department Wise Dashboard',
     'dashboards/karigar_out_dashboards' => 'Karigar Out Balance Dashboard',
     'dashboards/karigar_balance_dashboards' => 'Karigar Balance Dashboard',
     'dashboards/worker_balance_dashboards' => 'Worker Balance Dashboard',
    );
}

function get_arc_dashboard_side_menu_dropdown(){
    return array(
      // 'dashboards/wastage_melting_dashboards'=>'Wastage Melting Dashboard',
      'dashboards/process_dashboards'=>'Process Wise Dashboard',
     // 'dashboards/phase_wise_dashboards'=>'Phase Wise Dashboard',
      // 'dashboards/office_outside_dashboards'=>'Office Outside Dashboard',
      // 'stone_ring_nineties/dashboards'=>'Stone Ring 92 Dashboard',
      // 'rings/dashboards'=>'Ring Dashboard',
      // 'pendants/dashboards'=>'Pendant Dashboard',
      // 'stone_ring_seventies/dashboards'=>'Stone Ring 75 Dashboard',
      // 'plain_rings/dashboards'=>'Plain Ring Dashboard',
      // 'lock_processes/dashboards'=>'Lock Process Dashboard',
      // 'pendent_sets/dashboards'=>'Pendent Set Dashboard',
      // 'pendent_set_seventies/dashboards'=>'Pendent Set 75 Dashboard',
      // 'pendent_set_plains/dashboards'=>'Pendent Set Plain Dashboard',
     // 'dashboards/hcl_dashboards' => 'HCL Dashboard',
     'dashboards/department_dashboards' => 'Department Wise Dashboard',
     // 'dashboards/karigar_out_dashboards' => 'Karigar Out Balance Dashboard',
     //'dashboards/daily_process_dashboards' => 'Daily Process Dashboard',
     //'dashboards/arc_order_dashboards' => 'Arc Order Dashboard',
    // 'reports/order_status_report_dashboards'=>'Order Status Report Dashboards',
    );
}



function get_controller_using_code($code){//barcode updated
  $controller = array('D1'=>array('controller'=>'daily_drawers/daily_drawer_in_out_views',
                                    'column'=>'balance'),
                      'D2'=>array('controller'=>'daily_drawers/daily_drawer_in_out_views',
                                    'column'=>'balance'),
                      'D3'=>array('controller'=>'daily_drawers/daily_drawer_in_out_views',
                                    'column'=>'balance'),
                      'W1'=>array('controller'=>'daily_drawers/daily_drawer_wastage_views',
                                    'column'=>'balance'),
                      'W2'=>array('controller'=>'daily_drawers/daily_drawer_wastage_views',
                                    'column'=>'balance'),
                      'W3'=>array('controller'=>'daily_drawers/daily_drawer_wastage_views',
                                    'column'=>'balance'));
  return isset($controller[$code])?$controller[$code]:'';
}

function get_dailydrawer_summary_sort_code(){
  $codes = array('D1','D2','D3','D4','W1','W2','W3');
  return $codes;
}


function get_type_full_form_from_sort_name($code){
  $fullform =  array('H'=>'Hook',
                    'K'=>'KDM',
                    'L'=>'Lobster',
                    'B'=>'Ball',
                    'SP'=>'Solid Pipe',
                    'HP'=>'Hollow Pipe',
                    'SW'=>'Solid Wire',
                    'CW'=>'Cutting Wire',
                    'HW'=>'Hard Wire',
                    'CP'=>'Cutting Pipe',
                    'SA'=>'Sisma Accessories',
                    'KM'=>'Kala Mani',
                    'P'=>'Para',
                    'IP'=>'I/O Pic',
                    'P1'=>'Pipe',
                    'AC'=>'Anc Chain',
                    'S'=>'Stone',
                    'SP1'=>'Sisma Pic',
                    '1P'=>'1.8 pipe',
                    '1K'=>'1.8mm kajol',
                    '1C'=>'1.8mm clipping',
                    '3C'=>'3mm clipping',
                    '2BC'=>'2mm ball chain',
                    '3A'=>'30 anchor',
                    '3P'=>'30 pipe',
                    '4FB'=>'4gm fancy box',
                    'BPC'=>'Box pipe clipping',
                    'CW0'=>'Cutting wire 0.5',
                    'CW01'=>'Cutting wire 0.8',
                    'CW02'=>'Cuttring wire 0.8',
                    'CW1'=>'Cutting wire 1.1',
                    'P2'=>'Para 2mm',
                    'P3'=>'Para 3mm',
                    'P4'=>'Para 4mm',
                    'PW0'=>'Plain Wire 0.4',
                    'PW01'=>'Plain Wire 0.8',
                    'T'=>'Tibki',
                    'S1'=>'Shook',
                    'AK'=>'ARF KDM',
                    'C'=>'Cap',
                    'GP'=>'GPC Powder',
               );
  return isset($fullform[$code])?$fullform[$code]:'';
}

function chain_wise_karigar_name($process){
  $karigar_names=array();
  $ci =& get_instance();
  $ci->load->model('settings/same_karigar_model');
  $karigar_names= $ci->same_karigar_model->get('karigar_name as name,karigar_name as id',
                                      array('product_name'=>$process['product_name'],
                                            'process_name'=>$process['process_name'],
                                            'department_name'=>$process['department_name']));
  $select_karigar=array(array('id'=>'','name'=>'Select'));
  $karigar_names=array_merge($select_karigar,$karigar_names);
  return $karigar_names;
}
function get_categories($category_name){
  $category_names=array();
  $ci =& get_instance();
  $ci->load->model('settings/category_model');
  if($category_name=='category_one'){
  $category_names= $ci->category_model->get('distinct(category_one) as name,category_one as id');
  }else{
  $category_names= $ci->category_model->get('distinct(category_two) as name,category_two as id');
  }
  return $category_names;
}
function is_in_factory(){
 return array(array('id' => 'Office', 'name' => 'Office'),
              array('id' => 'Office Outside', 'name' => 'Office Outside'));
}

function process_wise_karigar_name($product_name, $process_name = '', $department_name = ''){
  $karigar_names=array();
  $ci =& get_instance();
  $ci->load->model('settings/same_karigar_model');

  $where = array();
  if (!empty($product_name)) $where['product_name'] = $product_name;
  if (!empty($process_name)) $where['process_name'] = $process_name;
  if (!empty($department_name)) $where['department_name'] = $department_name;
  $karigar_names= $ci->same_karigar_model->get('DISTINCT(karigar_name) as name,karigar_name as id', $where);
  return $karigar_names;
}

function get_karigar_name(){
  $karigar_names=array();
  $ci =& get_instance();
  $ci->load->model('settings/karigar_model');
  $karigar_names= $ci->same_karigar_model->get('DISTINCT(karigar_name) as name,karigar_name as id');
  if(HOST=='ARF'){
   $karigar_names=array(array('id'=>'Factory','name'=>'Factory')); 
  }
  return $karigar_names;
}
function get_domestic_category_name(){
  $category_names=array();
  $ci =& get_instance();
  $ci->load->model('masters/domestic_category_master_model');
  $category_names= $ci->domestic_category_master_model->get('DISTINCT(design_code) as name,design_code as id');
  return $category_names;
}

function get_city_name(){
  $city_names=array();
  $ci =& get_instance();
  $ci->load->model('settings/city_model');
  $city_names= $ci->city_model->get('DISTINCT(name) as name,name as id');
  return $city_names;
}

function get_machine_names($department_name, $process_id = 0){
  $machine_names=array();
  $ci =& get_instance();

  if ($process_id != 0) {
    $process = $ci->process_model->find('product_name, process_name, department_name,
                                        machine_size, design_code,
                                        melting_lot_category_one, melting_lot_category_two, melting_lot_category_three, melting_lot_category_four', array('id' => $process_id));
    $product_name = $process['product_name'];
    $process_name = $process['process_name'];
    $ci->load->model('masters/machine_master_model');
    $machine_names = $ci->machine_master_model->get('machine_name as name, machine_name as id',
                          array('product_name' => $process['product_name'],
                                'process_name' => $process['process_name'],
                                'department_name' => $process['department_name'],
                                'category_one' => array('All', $process['melting_lot_category_one']),
                                'category_two' => array('All', $process['melting_lot_category_two']),
                                'category_three' => array('All', $process['melting_lot_category_three']),
                                'category_four' => array('All', $process['melting_lot_category_four']),
                                'machine_size' => array('All', $process['machine_size']),
                                'design_code' => array('All', $process['design_code'])));
    
  } else {
    $product_name = $ci->load->_ci_cached_vars['product_name'] ?? (@$GLOBALS['CI']->attributes['product_name'] ?? '');
    $process_name = $ci->load->_ci_cached_vars['process_name'] ?? (@$GLOBALS['CI']->attributes['process_name'] ?? '');
    if (empty($product_name) || empty($process_name)) return;
    $ci->load->model('masters/machine_master_model');
    $machine_names= $ci->machine_master_model->get('machine_name as name, machine_name as id',
                                                 array('product_name' => $product_name,
                                                       'process_name' => $process_name,
                                                       'department_name' => $department_name));
  }

  if (count($machine_names) > 1)
    return $machine_names;
  else 
    return;
}
function get_sisma_bom_order_designs($process_id = 0){
  $machine_names=array();
  $ci =& get_instance();

  if ($process_id != 0) {
    $process = $ci->process_model->find('melting_lot_id', array('id' => $process_id));
    $melting_lot = $ci->melting_lot_model->find('order_id', array('id' => $process['melting_lot_id']));

  }
}


function purities_code($code){
  $purity_percentage = array('92.0000'=>'N2',
                            '87.6500'=>'E2',
                            '83.6500'=>'E3',
                            '83.5000'=>'E4',
                            '75.1500'=>'S7');
  return isset($purity_percentage[$code])?$purity_percentage[$code]:'';
}

function code_purities($code){
  $purity_percentage = array('N2'=>'92.0000',
                            'E2'=>'87.6500',
                            'E3'=>'83.6500',
                            'E4'=>'83.5000',
                            'S7'=>'75.1500');
  return isset($purity_percentage[$code])?$purity_percentage[$code]:'';
}


function get_conditional_convention($data){
  //pr($data);
 
  switch ($data) {
    case 'Pipe':
        return 'P1';
        break;
    case 'Sisma_Pic':
        return 'SP1';
        break;
    case 'Cutting_wire_0.8':
        return 'CW01';
        break; 
    case 'Cuttring_wire_0.8':
        return 'CW02';
        break; 
    case 'Cutting_wire_1.1':
        return 'CW1';
        break;
    case 'Plain_Wire_0.8':
        return 'PW01';
        break;
    case 'Shook':
        return 'S1';
        break;
    default:
        return '';
  }
}

function get_characters_for_barcode($string){
  if(!empty($string)){
      if(!empty($string)){
      $exploded = explode("_",$string);
        $two_characters_type = "";
        foreach ($exploded as $w) {
          $two_characters_type .= isset($w[0])?strtoupper($w[0]):'';
        }
      }
    }
    else $two_characters_type = '';
    $get_conditional_convention = get_conditional_convention($string);
    //pr($get_conditional_convention);
    
    if(!empty($get_conditional_convention))
      $two_characters_type = $get_conditional_convention;
    return $two_characters_type;
}

function get_sisma_concepts() {
  return array(array('id'=>'Lexus Bangle','name'=>'Lexus Bangle'),
               array('id'=>'Lexus Set','name'=>'Lexus Set'),
               array('id'=>'Lexus Chain','name'=>'Lexus Chain'));
}

/*'id' => '92', 'name' => '92'),
               array('id' => '87.65', 'name' => '87.65'),
               array('id' => '83.65', 'name' => '83.65'),
               array('id' => '75.15',*/
