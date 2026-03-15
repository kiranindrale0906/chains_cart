<?php 

function remove_duplicates_in_string($str) {
  $words  = explode(",", $str);
  $sanitized_words = array();
  foreach ($words as $word) {
    if (trim($word) == '') continue;
    if (trim($word) == '0') continue;
    $sanitized_words[] = trim($word);
  }
  $unique_words = array_unique($sanitized_words);
  return implode(', ', $unique_words);
}

function get_product_process_department_data(){
if(HOST=='ARF'){
  return array(
    'KA Chain' => array(
        'Box Start Process' => array(
          'Start'      => array('Ashish'),
          'Melting' => array('Ashish'),
          'Tarpatta' => array('Ashish')),

        'Anchor Start Process' => array(
          'Start'      => array('Ashish'),
          'Melting' => array('Ashish'),
          'Tarpatta' => array('Ashish')),

        'Basket Start Process' => array(
          'Start'      => array('Ashish'),
          'Melting' => array('Ashish'),
          'Tarpatta' => array('Ashish')),

        'Dhoom Process' => array(
          'Start' => array(''), 
          'Melting'  => array(''), 
          'Flatting'  => array(''),
          'Stamping' => array(''),
          'Chain Making' => array('')
        ),

        'Box Chain Process' => array(
          'Start'        => array('Ashish'),
          'Box Tar Chain'      => array('Ashish'),
          'Solder'     => array('Ashish')),

        'Anchor Process' => array(
          'Start'        => array('Ashish'),
          'Basket Chain'      => array('Ashish'),
          'Solder'     => array('Ashish')),

        'Basket Process' => array(
          'Start'        => array('Ashish'),
          'Anchor Tar Chain'      => array('Ashish'),
          'Solder'     => array('Ashish')),

        'Factory Hold Process' => array(
          'Start'        => array('Ashish'),
          'Factory Hold'      => array('Ashish')),

        'Vishnu Process' => array(
          'Start'              => array('Ashish'),
          'Vishnu' => array('Ashish'),
        ),

        'Laser Process' => array(
          'Start'              => array('Ashish'),
          'Laser' => array('Ashish'),
        ),

        'Hammering Process' => array(
          'Start'              => array('Ashish'),
          'Hammering I' => array('Ashish'),
          
        ),'Ashish Process' => array(
          'Start'              => array('Ashish'),
          'Ashish' => array('Ashish'),
        ),

        'Hammering II Process' => array(
          'Start'              => array(''),
          'Castic Process'     => array(''),
          'Hammering II'     => array(''),
        ),

        'CNC Process' => array(
          'Start'              => array('Ashish'),
          'CNC Department' =>array('Ashish')
        ),

        'DC Process' => array(
          'Start'              => array('Ashish'),
          'DC Department' =>array('Ashish')
        ),

        'Round and Ball Chain Process' => array(
          'Start'              => array('Ashish'),
          'Round and Ball Chain' =>array('Ashish')
        ),

        'Factory Process' => array('Start'   => array('Ashish'),
                                   'Factory' => array('Ashish')),

        'Hook Process' => array('Start' => array('Ashish'),
                                'Hook'    => array('Ashish'),
                                'Buffing'    => array('Ashish'),
                                'GPC'     => array('Ashish'),
                                'Bunch GPC' => array('Ashish'),
                                'Polish' => array('Ashish'),
                                'Lobster' => array('Ashish'),
                                ),
        'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
        ),
        'CNC Recutting Process' => array('Start' => array('Ashish'),
                                'CNC Recutting'    => array('Ashish'),
                                'GPC'     => array('Ashish'),
                                'Bunch GPC' => array('Ashish')),      

        'DC Recutting Process' => array('Start' => array('Ashish'),
                                'DC Recutting'    => array('Ashish'),
                                'GPC'     => array('Ashish'),
                                'Bunch GPC' => array('Ashish')),      

        'Round and Ball Chain Recutting Process' => array('Start' => array('Ashish'),
                                'Round and Ball Chain Recutting'  => array('Ashish'),
                                'GPC'     => array('Ashish'),
                                'Bunch GPC' => array('Ashish')),      

        'Clipping Process' => array('Start' => array(),
                                    'Clipping' => array())
    ),
    

    'Ball Chain' => array(
      'Strip Start Process' => array('Start'    => array(''),
                                     'Melting'  => array(''),
                                     'Flatting' => array(''),
                                     'Ball Chain Making' => array(''),
                                     'Ball Chain Cleaning' => array()),
      'Factory Hold I Process' => array('Start'     => array(''), 
                                        'Factory Hold I'     => array('')),
      'Factory Hold Plain Process' => array('Start'              => array(''), 
                                            'Factory Hold Plain' => array('')),
      'Hook Plain Process' =>  array('Start'  => array(''), 
                                     'Hook'   => array(''), 
                                     'Polish' => array(''), 
                                     'Lobster' => array(''), 
                                     'Buffing' => array(''), 
                                     'GPC'    => array('')),
      'Hook 92 Plain Process' =>  array('Start'  => array(''), 
                                     'Hook'   => array(''), 
                                     'Polish' => array(''), 
                                     'Lobster' => array(''), 
                                     'Buffing' => array(''), 
                                     'GPC'    => array('')),
      'Laser Plain Process' => array('Start'  => array(''), 
                                     'Laser'  => array('')),
      'Plain Cutting Process' => array('Start' => array(''), 
                                       'Round and Ball Chain Cutting' => array('')),
      'Rose Gold Two Tone Process' => array('Start'    => array(''), 
                                            'Rhodium'  => array(''), 
                                            'Round and Ball Chain Cutting'    => array('')),
    ),

    'Office Outside' => array(
        'Lobster' => array(
          'Start'    => array(''),
          'Buffing'    => array(''),
        ),'Shook' => array(
          'Start'    => array(''),
          'Melting'    => array(''),
          'Tar Making'  => array(''),
          'Round and Ball Chain' => array(''),
          'S Making' => array(''),
        ),
        'KDM' => array(
          'Start'    => array(''),
          'Melting'  => array(''),
          'Wire Making' => array(''),
        ),
        'CAP' => array(
          'Start'   => array(''),
          'Melting' => array(''),
          'Flatting' => array(''),
          'Stamping' => array(''),
        ),
        'Pipe' => array(
          'Start'   => array(''),
          'Melting' => array(''),
          'Flatting' => array(''),
          'Pipe Making' => array('')
        ),
        'Pipe Cutting' => array(
          'Start'   => array(''),
          'CNC Department' => array(''),
          'Round and Ball Chain Making' => array(''),
          'Final' => array('')
        ),
        'Para' => array(
          'Start'   => array(''),
          'Melting' => array(''),
          'Flatting' => array(''),
          'Pipe And Para Making' => array(''),
        ),
        'Para Final Process' => array(
          'Start'   => array(''),
          'Dull' => array(''),
          'Round and Ball Chain'  => array(''),
          'Hand Cutting' => array(''),
          'Final'  => array('')
        ),
        'Lasiya' => array(
          'Start'   => array(''),
          'Melting' => array(''),
          'Tarpatta' => array(''),
          'Box Tar Chain' => array(''),
        ),
        'Tar' => array(
          'Start'   => array(''),
          'Melting' => array(''),
          'Tarpatta' => array(''),
        ),
        'Pipe and Para Start Process' => array(
          'Start'   => array(''),
          'Melting' => array(''),
          'Flatting' => array(''),
          'Para and Pipe Making' => array(''),
        ),
        'Pipe and Para Round and Ball Chain Process' => array(
          'Start'   => array(''),
          'Round and Ball Chain' => array(''),
          'Stripping' => array(''),
        ),
        'Pipe and Para Rhodium Process' => array(
          'Start'   => array(''),
          'Rhodium' => array(''),
        ),
        'Pipe and Para Lasiya Cutting Process' => array(
          'Start'   => array(''),
          'Lasiya Cutting' => array(''),
        ),
        'Pipe and Para Hold Process' => array(
          'Start'   => array(''),
          'Hold' => array(''),
        ),
         'Pipe and Para Stripping Process' => array(
          'Stripping' => array(''),
        ),
        'Pipe and Para Hand Cutting Process' => array(
          'Start'   => array(''),
          'Hand Cutting' => array(''),
          'Stripping' => array(''),
        ),
        'Pipe and Para Hand Cutting II Process' => array(
          'Hand Cutting II' => array(''),
           ),
        'Pipe and Para Hand Cutting III Process' => array(
          'Hand Cutting III' => array(''),
           ),
        'Pipe and Para Final Process' => array(
          'Start'   => array(''),
          'Pipe and Para Final' => array(''),
        ),
        'Pipe and Para Dull Process' => array(
          'Start'   => array(''),
          'Dull' => array(''),
        ),
        'Pipe and Para Copper Process' => array(
          'Start'   => array(''),
          'Copper' => array(''),
        ),
        'Pipe and Para Copper Dull Process' => array(
          'Start'   => array(''),
          'Dull' => array(''),
          'Round and Ball Chain' => array(''),
          'Stripping' => array(''),
        ),'Hand Cutting III Process' => array(
          'Start'   => array(''),
          'Hand Cutting III' => array(''),
        ),
    ),
    'Fancy Chain' => array(
      'Fancy Hold Process' => array(
        'Start'        => array(''),
        'Fancy Hold' => array(''),
      ),
      'Chain Making Process' => array(
        'Start'        => array(''),
        'Chain Making' => array(''),
      ),
     
      'Chain Making 75 Process' => array(
        'Start'        => array(''),
        'Chain Making' => array(''),
      ),
     
      'Final Process' => array(
        'Start'         => array(''),
        'Polish'        => array(''),
        'Lobster'       => array(''),
        'Buffing'       => array(''),
        'GPC Or Rodium' => array(''),
      ),'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      ),'Polish Process' => array(
        'Polish'         => array(''),
      ),'Assembling Process' => array(
        'Assembling'         => array(''),
      ),'Hand Cutting Process' => array(
        'Hand Cutting'         => array(''),
      ),'Hand Cutting II Process' => array(
        'Hand Cutting II'         => array(''),
      ),'Hand Cutting III Process' => array(
        'Hand Cutting III'         => array(''),
      ),'CNC Process' => array(
        'CNC Department'         => array(''),
      ),'Diamond Cutting Process' => array(
        'DC Department'         => array(''),
      ),'Buffing Process' => array(
        'Buffing'         => array(''),
      ),'Dull Process' => array(
        'Dull'         => array(''),
      ),'Sand Dull Process' => array(
        'Sand Dull'         => array(''),
      ),'Round and Ball Chain Process' => array(
        'Round and Ball Chain'         => array(''),
      ),'Rhodium Process' => array(
        'Rhodium'         => array(''),
      ),'Lasiya Cutting Process' => array(
        'Lasiya Cutting'         => array(''),
      ),
    ),

   'Fancy 75 Chain' => array(
      'Fancy Hold Process' => array(
        'Start'        => array(''),
        'Fancy Hold' => array(''),
      ),
      'Chain Making Process' => array(
        'Start'        => array(''),
        'Chain Making' => array(''),
      ),
     
      'Final Process' => array(
        'Start'         => array(''),
        'Polish'        => array(''),
        'Lobster'       => array(''),
        'Buffing'       => array(''),
        'GPC Or Rodium' => array(''),
      ),'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      ),'Polish Process' => array(
        'Polish'         => array(''),
      ),'Hand Cutting Process' => array(
        'Hand Cutting'         => array(''),
      ),'Hand Cutting II Process' => array(
        'Hand Cutting II'         => array(''),
      ),'Hand Cutting III Process' => array(
        'Hand Cutting III'         => array(''),
      ),'CNC Process' => array(
        'CNC Department'         => array(''),
      ),'Diamond Cutting Process' => array(
        'DC Department'         => array(''),
      ),'Buffing Process' => array(
        'Buffing'         => array(''),
      ),'Dull Process' => array(
        'Dull'         => array(''),
      ),'Sand Dull Process' => array(
        'Sand Dull'         => array(''),
      ),'Round and Ball Chain Process' => array(
        'Round and Ball Chain'         => array(''),
      ),'Rhodium Process' => array(
        'Rhodium'         => array(''),
      ),'Lasiya Cutting Process' => array(
        'Lasiya Cutting'         => array(''),
      ),
    ),
   'Tanishq Fancy Chain' => array(
      'Tanishq Hold Process' => array(
        'Start'        => array(''),
        'Tanishq Hold' => array(''),
      ),
      'Chain Making Process' => array(
        'Start'        => array(''),
        'Chain Making' => array(''),
      ),
     
      'Final Process' => array(
        'Buffing I'       => array(''),
        'GPC Or Rodium' => array(''),
        'Rhodium' => array(''),
      )
    ),

    'Refresh' => array(
      'Refresh' => array(
        'Start'             => array(''),
        'Refresh-Repairing' => array(''),
        'GPC'               => array(''),
      ),
      'Refresh Hold' => array(
        'Start'             => array(''),
        'Refresh Hold' => array(''),
      )
    ),
    'Internal' => array(
        'Internal Final Process' => array(
          'Start'      => array('Ashish'),
          'Final' => array('Ashish')),

        
    ),

    'Nano Process' => array(
      'Nano Process' => array(
        'Start'   => array(''),
        'Melting' => array(''),
        'Flatting' => array(''),
        'Diamond cutting' => array(''),
        'Stamping' => array(''),
        'Chain Making' => array(''),
        'Polish' => array(''),
        'GPC'     => array(''),
      ),
    ),
    'I 10 Process' => array(
      'I 10 Process' => array(
        'Start'   => array(''),
        'Melting' => array(''),
        'Flatting' => array(''),
        'Stamping' => array(''),
        'Hand cutting OR Round and Ball Chain Making' => array(''),
        'Chain Making' => array(''),
        'GPC'     => array(''),
        'GPC and Rodium'     => array(''),
      ),
    ),
    'Dhoom A' => array(
      'Dhoom A' => array(
        'Start'   => array(''),
        'Melting' => array(''),
        'Flatting' => array(''),
        'Stamping' => array(''),
        'Chain Making' => array(''),
        'Factory Hold'     => array(''),
      ),
    ),
    'Dhoom B' => array(
      'Dhoom B' => array(
        'Start'   => array(''),
        'Melting' => array(''),
        'Flatting' => array(''),
        'Stamping' => array(''),
        'Chain Making' => array(''),
        'Hammering I'     => array(''),
      ),
    ),

    'KA Chain Refresh' => array(
      'Hook Refresh Process' => array('Start' => array('Ashish'),
                                'Hook'    => array('Ashish'),
                                'GPC'     => array('Ashish'),
                                'Bunch GPC' => array('Ashish'))
    ),
      
  );

}else if(HOST=='ARC'){
  return array(
   
    'Casting Process' => array(
      'Melting' => array(
        'Melting Start'   => array('Ashish'),
        'Melting' => array('Ashish')),
      'Casting' => array(
        'Casting'         => array('Ashish')),
       'Filing Process' => array(
              'Filing'         => array('Ashish')),
       'Polish Process' => array(
              'Polish'         => array('Ashish')),
       'Stone Setting Process' => array(
              'Stone Setting'         => array('Ashish')),
       'Final Process' => array(
              'Final'         => array('Ashish')),
        ),
      'Office Outside' => array(
        'KDM' => array(
          'Start'    => array(''),
          'Melting'  => array(''),
          'Flatting' => array(''),
          'Stamping' => array(''),
        ),
        'Hook' => array(
          'Start'    => array(''),
          'Melting'  => array(''),
          'Flatting' => array(''),
          'Stamping' => array(''),
        ),
        'Lobster' => array(
          'Start'   => array(''),
          'Buffing' => array(''),
        ),
        'Ball' => array(
          'Start'       => array(''),
          'Melting'     => array(''),
          'Ball Making' => array(''),
        ),
        'Final Process' => array(
          'Office Outside Final' => array('')
        )),
      'Refresh' => array(
        'Start'             => array(''),
        'Refresh-Repairing' => array(''),
        'GPC'               => array(''),
      ),
      'Refresh Hold' => array(
        'Start'             => array(''),
        'Refresh Hold' => array(''),
      )
  );


}else if(HOST=='AR Gold Internal'){
  return array(
    'Rope Chain' => array(
        'Internal GPC Process' => array(
          'Melting Start' => array('Ashish'),
          'Cleaning' => array('Ashish'),
          'Steel Vibrator' => array('Ashish'),
          'Steel Vibrator II' => array('Ashish'),
          'GPC' => array('Ashish'))),
    'Machine Chain' => array(
        'Internal GPC Process' => array(
          'Melting Start' => array('Ashish'),
          'Cleaning' => array('Ashish'),
          'Shampoo' => array('Ashish'),
          'Steel Vibrator' => array('Ashish'),
          'GPC I' => array('Ashish'),
          'Steel Vibrator II' => array('Ashish'),
          'GPC' => array('Ashish'))),
    'Indo Tally Chain' => array(
        'Internal GPC Process' => array(
          'Melting Start' => array('Ashish'),
          'Cleaning' => array('Ashish'),
          'Walnut' => array('Ashish'),
          'Casting Department' => array('Ashish'),
          'Steel Vibrator' => array('Ashish'),
          'Steel Vibrator II' => array('Ashish'),
          'GPC' => array('Ashish')),
	'Internal Pasta GPC Process' => array(
          'Melting Start' => array('Ashish'),
          'Cleaning' => array('Ashish'),
          'Pasta' => array('Ashish'),
          'Casting Department' => array('Ashish'),
          'Steel Vibrator' => array('Ashish'),
          'Steel Vibrator II' => array('Ashish'),
          'GPC' => array('Ashish')),

    ),'Imp Italy Chain' => array(
        'Internal GPC Process' => array(
          'Melting Start' => array('Ashish'),
          'Pasta' => array('Ashish'),
          'Harding' => array('Ashish'),
          'Shampoo' => array('Ashish'),
          'Office Hold II' => array('Ashish'),
          'HCL' => array('Ashish'),
          'Office Hold' => array('Ashish'),
          'Buffing Shampoo' => array('Ashish'),
          'R/D Shampoo' => array('Ashish'),
          'GPC' => array('Ashish')),
    ),'Choco Chain' => array(
        'Internal GPC Process' => array(
          'Melting Start' => array('Ashish'),
          'Steel Vibrator' => array('Ashish'),
          'Office Hold' => array('Ashish'),
          'GPC' => array('Ashish'),
          ),
    ),'Round Box Chain' => array(
        'Internal GPC Process' => array(
          'Melting Start' => array('Ashish'),
          'Magnet' => array('Ashish'),
          'Office Hold' => array('Ashish'),
          'GPC' => array('Ashish'),
          ),
    ),
     'Hollow Choco Chain' => array(
        'Internal GPC Process' => array(
          'Melting Start' => array('Ashish'),
          'Walnut' => array('Ashish'),
          'Casting Department' => array('Ashish'),
          'Shampoo' => array('Ashish'),
          'Steel Vibrator' => array('Ashish'),
          'Office Hold' => array('Ashish'),
          'GPC' => array('Ashish')),
    )
     );}else{
  return array(
    'Rope Chain' => array(
      'Melting Process' => array(
        'Melting Start' => array('Ashish'),
        'Melting' => array('Ashish'),
        'Tounch Hold Department' => array('Ashish'),
        'Tounch Department' => array('Ashish'),
        'Flatting Hold' => array('Ashish'),
        'Flatting' => array('Ashish'),
        'Stripping Hold' => array('Ashish'),
        'Stripping' => array('Ashish'),
        'Tube Forming Hold' => array('Ashish'),
        'Tube Forming' => array('Ashish'),
        'Bull Block Hold' => array('Ashish'),
        'Bull Block' => array('Ashish'),
        'Wire Making Hold'     => array('Ashish'),
        'Wire Making'     => array('Ashish'),
      ),
      'Machine Process' => array(
        'Machine Department'      => array('Ashish'),
        'Hook'     => array('Ashish'),
        'Drum'     => array('Ashish'),
        'HCL'     => array('Ashish'),
        'Hook I'     => array('Ashish'),
        'Drum I'     => array('Ashish'),
        ),
     
      'Final Process' => array(
        'Start'              => array('Ashish'),
        'Joining Department' => array('Ashish'),
        'Steel Vibrator'     => array('Ashish'),
        'HCL'                => array('Ashish'),
        'Cleaning'                => array('Ashish'),
        'Tounch Department'                => array('Ashish'),
        'ReHCL'     => array('Ashish'),
        'Hook'               => array('Ashish'),
        'Polish'             => array('Ashish'),
        'GPC'                => array('Ashish'),
      ),
    ),

  
    'Office Outside' => array(
      'KDM' => array(
        'Start'    => array(''),
        'Melting'  => array(''),
        'Flatting' => array(''),
        'Stamping' => array(''),
      ),
      'Hook' => array(
        'Start'    => array(''),
        'Melting'  => array(''),
        'Flatting' => array(''),
        'Stamping' => array(''),
      ),
      'Lobster' => array(
        'Start'   => array(''),
        'Buffing' => array(''),
      ),
      'Ball' => array(
        'Start'       => array(''),
        'Melting'     => array(''),
        'Ball Making' => array(''),
      ),
      'Cutting Wire' => array(
        'Start'           => array(''),
        'Melting'         => array(''),
        'Wire Making'     => array(''),
        'Cutting' => array(''),
      ),
      'Mesh Gope Chain' => array(
        'Start'           => array(''),
        'Melting'         => array(''),
        'Tar Making'     => array(''),
        'Mesh Gope Chain Making' => array(''),
      ),
      'Hard Wire' => array(
        'Start'           => array(''),
        'Melting'         => array(''),
        'Wire Making'     => array(''),
      ),
      'Cutting Pipe' => array(
        'Start'        => array(''),
        'Melting'      => array(''),
        'Flatting'     => array(''),
        'Pipe Making'  => array(''),
        'Cutting'      => array(''),
        'Hand Cutting' => array(''),
      ),'Hollow Choco Cutting Pipe' => array(
        'Start'        => array(''),
        'Melting'      => array(''),
        'Flatting'     => array(''),
        'Pipe Making'  => array(''),
        'Cutting'      => array(''),
        'Hand Cutting' => array(''),
      ),
      'Solid Pipe' => array(
        'Start'        => array(''),       
        'Melting'      => array(''),     
        'Flatting'     => array(''),    
        'Pipe Making'  => array(''), 
        'Hand Cutting' => array(''),
      ),
      'Hollow Pipe' => array(
        'Start'        => array(''),
        'Melting'      => array(''),
        'Flatting'     => array(''),
        'Pipe Making'     => array(''),
        'AU+FE'        => array(''),
        'Final'        => array(''),
        'KitKat'       => array(''),
        'Hand Cutting' => array(''),
        'HCL'          => array(''),
      ),
      'Solid Wire' => array(
        'Start'       => array(''),
        'Melting'     => array(''),
        'Wire Making' => array(''),
      ),
         'Hollow Choco Dye Process' => array(
          'Start'   => array(''),
          'Melting' => array(''),
          'Flatting' => array(''),
          'Ledger And Joining' => array(''),
        ),
        'Choco Chain Dye Process' => array(
          'Start'   => array(''),
          'Melting' => array(''),
          'Flatting' => array(''),
          'Ledger And Joining' => array(''),
        ),
        'Indo Tally Dye Process' => array(
          'Start'   => array(''),
          'Melting' => array(''),
          'Flatting' => array(''),
          'Ledger And Joining' => array(''),
        ),
       'Imp Italy Dye Process' => array(
          'Start'   => array(''),
          'Melting' => array(''),
          'Flatting' => array(''),
          'Ledger And Joining' => array(''),
        ),
    ),

    'Refresh' => array(
      'Refresh' => array(
        'Start'             => array(''),
        'Refresh-Repairing' => array(''),
        'GPC'               => array(''),
      ),
      'Internal GPC Process' => array(
        'Cleaning'             => array(''),
        'Buffing' => array(''),
        'Steel Vibrator' => array(''),
        'GPC'               => array(''),
      ),
      'Refresh Hold' => array(
        'Start'             => array(''),
        'Refresh Hold' => array(''),
      )
    ),
    
    'Daily Drawer' => array(
      'Melting' => array(
        'Start'   => array(''),
        'Melting' => array(''),
      ),
      'Daily Drawer Wastage' => array(
        'Start' => array(''),
      )
    ),
    'Internal' => array(
        'Internal Final Process' => array(
          'Start'      => array('Ashish'),
          'Final' => array('Ashish')),

        
    ),
  );
}

}

/* functions for dropdowns */

function get_product_dropdown(){
  return get_product_process_department_field();
}

function get_process_dropdown($product_name){
  return get_product_process_department_field('dropdown', $product_name);
}

function get_department_dropdown($product_name, $process_name){
  return get_product_process_department_field('dropdown', $product_name, $process_name);
}

// function get_karigar_dropdown($product_name, $process_name, $department_name){
//   return get_product_process_department_field('dropdown', $product_name, $process_name, $department_name);
// }

/* end functions for dropdown */

/* functions for checkbox */

function get_product_checkbox(){
  return get_product_process_department_field('checkbox');
}

function get_process_checkbox($product_name){
  return get_product_process_department_field('checkbox', $product_name);
}

function get_department_checkbox($product_name, $process_name){
  return get_product_process_department_field('checkbox', $product_name, $process_name);
}

// function get_karigar_checkbox($product_name, $process_name, $department_name){
//   return get_product_process_department_field('checkbox', $product_name, $process_name, $department_name);
// }

/* end functions for checkboxes */


function get_product_process_department_field($field_type = 'dropdown', $product_name = null, $process_name = null, $department_name = null){

  $data         = get_product_process_department_data();
  $options      = array();
  $option_data = array();

  if($product_name == null && $process_name == null && $department_name == null) {
    $option_data = $data;
  }

  if($product_name !== null && $process_name == null && $department_name == null) {
    if(isset($data[$product_name])){
      $option_data = $data[$product_name];
    }
  }

  if($product_name !== null && $process_name != null && $department_name == null) {
    if(isset($data[$product_name][$process_name]))
      $option_data = $data[$product_name][$process_name];
  }

  // if($product_name !== null && $process_name != null && $department_name != null) {
  //   if(isset($data[$product_name][$process_name][$department_name]))
  //     $option_data = $data[$product_name][$process_name][$department_name];
  // }
  
  $options = generate_options_array($option_data);

  if($field_type == 'dropdown')
    return generate_dropdown($options);
  elseif ($field_type == 'checkbox') {
    return generate_checkboxes($options);
  }
}
