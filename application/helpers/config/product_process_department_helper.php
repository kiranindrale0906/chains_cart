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
    'Choco Chain' => array(
      'AG' => array(
        'Start'    => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Melting'  => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Flatting' => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Dye'      => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      'Machine Process' => array(
        'Start'        => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Chain Making' => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      'Hand Cutting Process' => array(
        'Hand Cutting' => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      'Final Process' => array(
        'Start'             => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Filing'            => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hook'              => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Steel Vibrator'              => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Castic Process'    => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Lobster Out'       => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Steel Vibrator II' => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Cutting'      => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Dull'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'GPC Or Rodium'     => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      'Quality Process' => array(
        'Hand Cutting'      => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Dull'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'GPC Or Rodium'     => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      ),
      'Imp Final Process' => array(
        'Start'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Filing'          => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hook'            => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Pasta'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Steel Vibrator'             => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'HCL'             => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Lobster'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Steel Vibrator II'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Cutting' => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Dull'       => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing II'      => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'GPC Or Rodium'   => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),

      'RND Process' => array(
        'Start'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Filing'          => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Lobster'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Cutting'          => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Dull'            => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'GPC'   => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      
      'Casting Final Process' => array(
        'Start'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Filing'          => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Pasta'            => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Castic Process'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Lobster Out'             => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Shampoo And Steel'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Cutting'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Dull'       => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing II'      => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'GPC Or Rodium'   => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      'Internal GPC Process' => array(
        'Steel Vibrator'        => array('Bappy Hollow', 'Soiley'),
      ),
      ),
'Rolex Chain' => array(
      'AG' => array(
        'Start'    => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Melting'  => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Flatting' => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Dye'      => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      'Machine Process' => array(
        'Start'        => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Chain Making' => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      'Hand Cutting Process' => array(
        'Hand Cutting' => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      'Final Process' => array(
        'Start'             => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Filing'            => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hook'              => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Steel Vibrator'              => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Castic Process'    => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Lobster Out'       => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Steel Vibrator II' => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Cutting'      => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Dull'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'GPC Or Rodium'     => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      'Quality Process' => array(
        'Hand Cutting'      => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Dull'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'GPC Or Rodium'     => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      ),
      'Imp Final Process' => array(
        'Start'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Filing'          => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hook'            => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Pasta'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Steel Vibrator'             => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'HCL'             => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Lobster'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Steel Vibrator II'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Cutting' => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Dull'       => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing II'      => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'GPC Or Rodium'   => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),

      'RND Process' => array(
        'Start'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Filing'          => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Lobster'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Cutting'          => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Dull'            => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'GPC'   => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      
      'Casting Final Process' => array(
        'Start'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Filing'          => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Pasta'            => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Castic Process'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Lobster Out'             => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Shampoo And Steel'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Cutting'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Dull'       => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing II'      => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'GPC Or Rodium'   => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
      'Internal GPC Process' => array(
        'Steel Vibrator'        => array('Bappy Hollow', 'Soiley'),
      ),
      ),
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

    'Solid Nawabi Chain' => array(
      'Melting' => array(
        'Melting Start'      => array('Ashish'),
        'Melting' => array('Ashish'),
        'Dye' => array('Ashish'),
      ),
     'Chain Making Process' => array(
        'Start'              => array('Ashish'),
        'Chain Making' => array('Ashish'),
      ),
      'Final Process' => array(
        'Casting' => array('Ashish'),
        'Magnet'     => array('Ashish'),
        'Lopster'     => array('Ashish'),
        'Steel Vibrator'               => array('Ashish'),
        'Hand Cutting'               => array('Ashish'),
        'Hand Dull'               => array('Ashish'),
        'Buffing'               => array('Ashish'),
        'Buffing II'               => array('Ashish'),
        'Hallmark Out'               => array('Ashish'),
        'GPC'               => array('Ashish'),
        ),
    ),


    'Machine Chain' => array(
      'AG' => array(
        'Start'        => array('Ashish'),
        'Melting'      => array('Ashish'),
        'Flatting'     => array('Ashish'),
        'AU+FE'        => array('Ashish'),
        'Tarpatta'     => array('Ashish'),
        'Wire Drawing' => array('Ashish'),
      ),
      'Machine Process' => array(
        'Start'              => array('Ashish'),
        'Machine Department' => array('Ashish'),
      ),
      'Final Process' => array(
        'Start'              => array('Ashish'),
        'Solder'             => array('Ashish'),
        'Joining Department' => array('Ashish'),
        'Cleaning'             => array('Ashish'),
        'Walnut'     => array('Ashish'),
        'HCL'                => array('Ashish'),
        'Pasta'                => array('Ashish'),
        'Tounch Department'                => array('Ashish'),
        'ReHCL'                => array('Ashish'),
        'Castic Process'     => array('Ashish'),
        'Magnet'  => array('Ashish'),
        'Cutting'            => array('Ashish'),
        'Ice Cutting'        => array('Ashish'),
        'Factory Hold'        => array('Ashish'),
        'Hook'               => array('Ashish'),
      ),
      'Final GPC Process' => array(
        'Start'              => array('Ashish'),
        'Hook'             => array('Ashish'),
        'Shampoo'             => array('Ashish'),
        'Hand Cutting' => array('Ashish'),
        'Buffing'     => array('Ashish'),
        'HCL'                => array('Ashish'),
        'GPC'     => array('Ashish'),
        'QC Department'  => array('Ashish'),
      ),
      'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      ),
      'Rolex Final Process' => array(
        'Start'              => array('Ashish'),
        'Solder'              => array('Ashish'),
        'Joining Department' => array('Ashish'),
        'Shampoo'            => array('Ashish'),
        'HCL'                => array('Ashish'),
        'Tounch Department'            => array('Ashish'),
        'Capping'            => array('Ashish'),
        'Lobster'            => array('Ashish'),
        'Filing'            => array('Ashish'),
        'Shampoo And Steel'  => array('Ashish'),
        'Hand Cutting'       => array('Ashish'),
        'Hook'       => array('Ashish'),
        'Buffing'            => array('Ashish'),
        'GPC'                => array('Ashish'),
      ),
      'Internal GPC Process' => array(
        'Cleaning'        => array('Bappy Hollow'),
        'Walnut'          => array('Bappy Hollow'),
        'Steel Vibrator'  => array('Bappy Hollow'),
        'Steel Vibrator II'=> array('Bappy Hollow'),
        'GPC'        => array('Bappy Hollow'),
      ),
    ),
    'Dus Collection' => array(
      'AG' => array(
        'Start'        => array('Ashish'),
        'Melting'      => array('Ashish'),
        'Flatting'     => array('Ashish'),
       ),
      'Machine Process' => array(
        'Machine Department' => array('Ashish'),
      ),
      'Final Process' => array(
        'Joining Department' => array('Ashish'),
        'Magnet'  => array('Ashish'),
        'Copper'  => array('Ashish'),
        'Cutting'            => array('Ashish'),
        'Stripping'            => array('Ashish'),
        'Hook'               => array('Ashish'),
        'Buffing'               => array('Ashish'),
        'Gpc'               => array('Ashish'),
      ),
    ),
      'Solid Machine Chain' => array(
      'AG' => array(
        'Melting'        => array('Ashish'),
        'Wire Making'      => array('Ashish'),
      ),
      'Machine' => array(
        'Machine Department' => array('Ashish'),
      ),
      'Final Process'        => array(
        'Solder'             => array('Ashish'),
        'Magnet'             => array('Ashish'),
        'Tounch Department'  => array('Ashish'),
        'Hammering'          => array('Ashish'),
        'DC Cutting'         => array('Ashish'),
        'Hook'               => array('Ashish'),
      ),
      'Final GPC Process' => array(
        'Buffing'     => array('Ashish'),
        'GPC'         => array('Ashish'),
      ),
    ),

    'Round Box Chain' => array(
      'AG' => array(
        'Start'    => array('Ashish'),
        'Melting'  => array('Ashish'),
        'Flatting' => array('Ashish'),
      ),
      'Final Process' => array(
        'Start'              => array('Ashish'),
        'Machine Department' => array('Ashish'),
        'Hammering'          => array('Ashish'),
        'Magnet'             => array('Ashish'),
        'Copper'             => array('Ashish'),
        'Cutting'            => array('Ashish'),
        'Recutting'          => array('Ashish'),
        'Stripping'          => array('Ashish'),
        'Factory Hold'          => array('Ashish'),
        'Hook'               => array('Ashish'),
        'Buffing'            => array('Ashish'),
        'GPC'                => array('Ashish'),
      ),
      'Final GPC Process' => array(
        'Start'              => array('Ashish'),
        'Buffing' => array('Ashish'),
        'GPC'          => array('Ashish'),
        'QC Department'             => array('Ashish'),
      ),
      'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      ),
      'Internal GPC Process' => array(
        'Magnet'        => array('Bappy Hollow', 'Soiley'),
      ),
    ),
    'Imp Italy Chain' => array(
      'AG' => array(
        'Start'      => array('Bappy Hollow'),
        'Melting' => array('Bappy Hollow'),
      ),
      'AG Flatting' => array(
        'Start'        => array('Bappy Hollow'),
        'AG Melting'      => array('Bappy Hollow'),
        'Flatting'     => array('Bappy Hollow'),
        'AU+FE'        => array('Bappy Hollow'),
        'Tarpatta'     => array('Bappy Hollow'),
        'Wire Drawing' => array('Bappy Hollow'),
        'Issue Spring' => array('Bappy Hollow'),
      ),
      'Spring Process' => array(
        'Start'  => array('Bappy Hollow'),
        'Spring' => array('Bappy Hollow'),
      ),
      'Chain Making Process' => array(
        'Start'        => array('Bappy Hollow'),
        'Chain Making' => array('Bappy Hollow'),
      ),
      'Engraving Process' => array(
        'Start'        => array('Bappy Hollow'),
        'Shampoo II' => array('Bappy Hollow'),
        'Engraving GPC' => array('Bappy Hollow'),
        'Engraving' => array('Bappy Hollow'),
      ),
      'Filing Process' => array(
        'Filing' => array('Bappy Hollow'),
      ),

      'Final Process' => array(
        'Start'                => array('Bappy Hollow'),
        'Pasta'                => array('Bappy Hollow'),
        // 'Pasta Shampoo'        => array('Bappy Hollow'),
        'HCL'                  => array('Bappy Hollow'),
        'Pasta I'              => array('Bappy Hollow'),
        'ReHCL'                  => array('Bappy Hollow'),
        'Tounch Department'                  => array('Bappy Hollow'),
        'Lobster In'           => array('Bappy Hollow'),
        'Shampoo'    => array('Bappy Hollow'),
        'Buffing'              => array('Bappy Hollow'),
        'Hand Cutting'              => array('Bappy Hollow'),
        'Buffing II'              => array('Bappy Hollow'),
        'Diamond Cutting'      => array('Bappy Hollow'),
        'Hand Dull'            => array('Bappy Hollow'),
        'Buffing II'           => array('Bappy Hollow'),
        'Shampoo II' => array('Bappy Hollow'),
        'GPC Or Rodium'        => array('Bappy Hollow'),
      ),
      'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      ),
      'Internal GPC Process' => array(
        'Pasta'        => array('Bappy Hollow', 'Soiley'),
        'Shampoo' => array('Bappy Hollow', 'Soiley'),
        'Buffing Shampoo' => array('Bappy Hollow', 'Soiley'),
        'R/d Shampoo' => array('Bappy Hollow', 'Soiley'),
      ),
    ),
    'Indo tally Chain' => array(
      'AG' => array(
        'Start'      => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Melting' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
      ),
      'AG Flatting' => array(
        'Start'        => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'AG Melting'      => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Flatting'     => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'AU+FE'        => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Tarpatta'     => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        '14 by 14'     => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Wire Drawing' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
      ),
      'PL' => array(
        'Start'      => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Melting' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
      ),  
      'PL Flatting' => array(
        'Start'         => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'PL Melting'       => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Flatting'      => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Buffing'       => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'AU+FE'         => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Rolling'       => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Strip Cutting' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Tarpatta'      => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Wire Drawing'  => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
      ),
      'Spring Process' => array(
        'Start'  => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Spring' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
      ),
      'Chain Making Process' => array(
        'Start'        => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Chain Making' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
      ),
      'Rolex Process' => array(
        'Start'        => array('Bappy Hollow', 'Soiley'),
        'Chain Making' => array('Bappy Hollow', 'Soiley'),
        'Walnut' => array('Bappy Hollow', 'Soiley'),
        'Steel Vibrator' => array('Bappy Hollow', 'Soiley'),
        'HCL' => array('Bappy Hollow', 'Soiley'),
        'Tounch Department' => array('Bappy Hollow', 'Soiley'),
        'ReHCL' => array('Bappy Hollow', 'Soiley'),
        'Castic' => array('Bappy Hollow', 'Soiley'),
        'Filing' => array('Bappy Hollow', 'Soiley'),
        'Hook' => array('Bappy Hollow', 'Soiley'),
        'Shampoo' => array('Bappy Hollow', 'Soiley'),
        'Hand Cutting' => array('Bappy Hollow', 'Soiley'),
        'Buffing' => array('Bappy Hollow', 'Soiley'),
        'GPC' => array('Bappy Hollow', 'Soiley'),
        'Quality' => array('Bappy Hollow', 'Soiley'),
        'Hallmarking' => array('Bappy Hollow', 'Soiley'),
      ),
      'Final Process' => array(
        'Start'             => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Walnut'            => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Steel Vibrator'    => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'HCL'               => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Tounch Department' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'ReHCL' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Castic Process'    => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Lobster'           => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Shampoo' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Steel Vibrator II' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        
        'GPC'               => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Quality'               => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Hallmarking'               => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
      ),'Pasta Final Process' => array(
        'Start'             => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Walnut'            => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Steel Vibrator'    => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'HCL'               => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Pasta'               => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Tounch Department' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'ReHCL' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Castic Process'    => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Lobster'           => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Shampoo' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Steel Vibrator II' => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        
        'GPC'               => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Quality'               => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
        'Hallmarking'               => array('Bappy Hollow', 'Bhim', 'Dharmendra', 'Golu', 'Soiley'),
      ),
      'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      ),
      'Internal GPC Process' => array(
        'Walnut'        => array('Bappy Hollow', 'Soiley'),
        'Steel Vibrator' => array('Bappy Hollow', 'Soiley'),
        'Castic Department' => array('Bappy Hollow', 'Soiley'),
        'Shampoo' => array('Bappy Hollow', 'Soiley'),
        'Steel Vibrator II' => array('Bappy Hollow', 'Soiley'),
        'GPC' => array('Bappy Hollow', 'Soiley'),
      ),
    ),
    'Hollow Choco Chain' => array(
      'PL' => array(
        'Start'      => array('Bappy Hollow', 'Soiley'),
        'Melting' => array('Bappy Hollow', 'Soiley'),
      ),
      'PL Flatting' => array(
        'Start'         => array('Bappy Hollow', 'Soiley'),
        'PL Melting'       => array('Bappy Hollow', 'Soiley'),
        'Flatting'      => array('Bappy Hollow', 'Soiley'),
        'PL Buffing'    => array('Bappy Hollow', 'Soiley'),
        'AU+FE'         => array('Bappy Hollow', 'Soiley'),
        'Rolling'       => array('Bappy Hollow', 'Soiley'),
        'Strip Cutting' => array('Bappy Hollow', 'Soiley'),
        'Annealing II'  => array('Bappy Hollow', 'Soiley'),
        'Draw Bench'    => array('Bappy Hollow', 'Soiley'),
        'Tarpatta'      => array('Bappy Hollow', 'Soiley'),
        'Final'         => array('Bappy Hollow', 'Soiley'),
      ),
      'Spring Process' => array(
        'Start'  => array('Bappy Hollow', 'Soiley'),
        'Spring' => array('Bappy Hollow', 'Soiley'),
      ),
      'Chain Making Process' => array(
        'Start'        => array('Bappy Hollow', 'Soiley'),
        'Chain Making' => array('Bappy Hollow', 'Soiley'),
      ),
      
      'Final Process' => array(
        'Start'             => array('Bappy Hollow', 'Soiley'),
        'Filing'            => array('Bappy Hollow', 'Soiley'),
        'Walnut'            => array('Bappy Hollow', 'Soiley'),
        'Steel Vibrator'    => array('Bappy Hollow', 'Soiley'),
        'HCL'               => array('Bappy Hollow', 'Soiley'),
        'ReHCL'               => array('Bappy Hollow', 'Soiley'),
        'Tounch Department' => array('Bappy Hollow', 'Soiley'),
        'Castic Process'    => array('Bappy Hollow', 'Soiley'),
        'Lobster Out'       => array('Bappy Hollow', 'Soiley'),
        'Shampoo' => array('Bappy Hollow', 'Soiley'),
        'Hand Cutting'      => array('Bappy Hollow', 'Soiley'),
        'Hand Dull'         => array('Bappy Hollow', 'Soiley'),
        'Steel Vibrator II' => array('Bappy Hollow','Soiley'),
        'Buffing'           => array('Bappy Hollow', 'Soiley'),
        'GPC Or Rodium'     => array('Bappy Hollow', 'Soiley'),
      ),
      'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      ),
      'Internal GPC Process' => array(
        'Walnut'        => array('Bappy Hollow', 'Soiley'),
        'Steel Vibrator' => array('Bappy Hollow', 'Soiley'),
        'Castic Department' => array('Bappy Hollow', 'Soiley'),
        'Shampoo' => array('Bappy Hollow', 'Soiley'),
        'Steel Vibrator II' => array('Bappy Hollow', 'Soiley'),
        'GPC' => array('Bappy Hollow', 'Soiley'),
      ),
    ),

    'Hand Made Chain' => array(
      'Melting' => array(
        'Start'      => array('Bappy Hollow', 'Soiley'),
        'Melting' => array('Bappy Hollow', 'Soiley'),
        'Flatting' => array('Bappy Hollow', 'Soiley'),
        'Stamping' => array('Bappy Hollow', 'Soiley'),
      ),
      'Chain Making Process' => array(
        'Start'        => array('Bappy Hollow', 'Soiley'),
        'Chain Making' => array('Bappy Hollow', 'Soiley'),
      ),
      
      'Final Process' => array(
        'Vibrator'             => array('Bappy Hollow', 'Soiley'),
        'Filing'             => array('Bappy Hollow', 'Soiley'),
        'Hammering'             => array('Bappy Hollow', 'Soiley'),
        'Hand Cutting'      => array('Bappy Hollow', 'Soiley'),
        'Cutting'         => array('Bappy Hollow', 'Soiley'),
        'Hook'         => array('Bappy Hollow', 'Soiley'),
        'Tounch Department'         => array('Bappy Hollow', 'Soiley'),
        'Buffing'           => array('Bappy Hollow', 'Soiley'),
        'GPC'     => array('Bappy Hollow', 'Soiley'),
      ),
    ),'Hollow Bangle Chain' => array(
      'Melting' => array(
         'Melting Start' => array('Bappy Hollow', 'Soiley'),
         'Melting' => array('Bappy Hollow', 'Soiley'),
         'Flatting' => array('Bappy Hollow', 'Soiley'),
         'Pipe Making' => array('Bappy Hollow', 'Soiley'),
         'AU+FE' => array('Bappy Hollow', 'Soiley'),
      ),'Assembling Process' => array(
         'Assembling' => array('Bappy Hollow', 'Soiley'),
         ),
      'Buffing Process' => array(
        'Buffing'        => array('Bappy Hollow', 'Soiley'),
        'Bangle Stamping' => array('Bappy Hollow', 'Soiley'),
        'Hollow Bangle Cutting' => array('Bappy Hollow', 'Soiley'),
        'HCL' => array('Bappy Hollow', 'Soiley'),
        'Joinning' => array('Bappy Hollow', 'Soiley'),
        'Buffing II' => array('Bappy Hollow', 'Soiley'),
        'Engraving' => array('Bappy Hollow', 'Soiley'),
        'GPC Or R/D' => array('Bappy Hollow', 'Soiley'),
      ),
    ),'Lotus Chain' => array(
      'PL' => array(
        'Start'      => array('Bappy Hollow', 'Soiley'),
        'Melting' => array('Bappy Hollow', 'Soiley'),
      ),
      'PL Flatting' => array(
        'Start'         => array('Bappy Hollow', 'Soiley'),
        'PL Melting'       => array('Bappy Hollow', 'Soiley'),
        'Flatting'      => array('Bappy Hollow', 'Soiley'),
        'PL Buffing'    => array('Bappy Hollow', 'Soiley'),
        'AU+FE'         => array('Bappy Hollow', 'Soiley'),
        'Rolling'       => array('Bappy Hollow', 'Soiley'),
        'Strip Cutting' => array('Bappy Hollow', 'Soiley'),
        'Annealing II'  => array('Bappy Hollow', 'Soiley'),
        'Draw Bench'    => array('Bappy Hollow', 'Soiley'),
        'Tarpatta'      => array('Bappy Hollow', 'Soiley'),
        'Final'         => array('Bappy Hollow', 'Soiley'),
      ),
      'Spring Process' => array(
        'Start'  => array('Bappy Hollow', 'Soiley'),
        'Spring' => array('Bappy Hollow', 'Soiley'),
      ),
      'Chain Making Process' => array(
        'Start'        => array('Bappy Hollow', 'Soiley'),
        'Chain Making' => array('Bappy Hollow', 'Soiley'),
      ),
      
      'Final Process' => array(
        'Start'             => array('Bappy Hollow', 'Soiley'),
        'Filing'            => array('Bappy Hollow', 'Soiley'),
        'Walnut'            => array('Bappy Hollow', 'Soiley'),
        'Steel Vibrator'    => array('Bappy Hollow', 'Soiley'),
        'HCL'               => array('Bappy Hollow', 'Soiley'),
        'ReHCL'               => array('Bappy Hollow', 'Soiley'),
        'Tounch Department' => array('Bappy Hollow', 'Soiley'),
        'Castic Process'    => array('Bappy Hollow', 'Soiley'),
        'Lobster Out'       => array('Bappy Hollow', 'Soiley'),
        'Shampoo' => array('Bappy Hollow', 'Soiley'),
        'Hand Cutting'      => array('Bappy Hollow', 'Soiley'),
        'Hand Dull'         => array('Bappy Hollow', 'Soiley'),
        'Hook'              => array('Bappy Hollow', 'Soiley'),
        'Buffing'           => array('Bappy Hollow', 'Soiley'),
        'GPC Or Rodium'     => array('Bappy Hollow', 'Soiley'),
      ),
      'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      ),
    ),
    'Lopster Making Chain' => array(
      'Melting'=>array('Melting Start'=> array(''),
                       'Melting'=> array(''),
                       'Flatting'=> array(''),
                       // 'Soldering'=> array(''),
                     ),
      'Soldering Process'=>array('Soldering'=> array(''),
                     ),
      'Soldering Process'=>array('Soldering'=> array('')),
      'Buffing Process'=>array('Buffing'=> array(''),
                     ),
      'Assembling Process'=>array('Assembling'=> array(''),
                       ),
    ),'Lopster' => array(
      'Lopster 92 Process'=>array(
                       'Melting'=> array(''),
                       'Lopster Stamping '=> array(''),
                       'Solder'=> array(''),
                       'Assembling'=> array('')),
      'Lopster 87 Process'=>array(
                       'Melting'=> array(''),
                       'Lopster Stamping '=> array(''),
                       'Solder'=> array(''),
                       'Assembling'=> array('')),
      'Lopster 83 Process'=>array(
                       'Melting'=> array(''),
                       'Lopster Stamping '=> array(''),
                       'Solder'=> array(''),
                       'Assembling'=> array('')),
      'Lopster 75 Process'=>array(
                       'Melting'=> array(''),
                       'Lopster Stamping '=> array(''),
                       'Solder'=> array(''),
                       'Assembling'=> array('')),
      'Lopster 58 Process'=>array(
                       'Melting'=> array(''),
                       'Lopster Stamping '=> array(''),
                       'Solder'=> array(''),
                       'Assembling'=> array('')),
      'Lopster 41 Process'=>array(
                       'Melting'=> array(''),
                       'Lopster Stamping '=> array(''),
                       'Solder'=> array(''),
                       'Assembling'=> array('')),
      'Lopster 37 Process'=>array(
                       'Melting'=> array(''),
                       'Lopster Stamping '=> array(''),
                       'Solder'=> array(''),
                       'Assembling'=> array('')),
      'Lopster Final Process'=>array(
                       'Final'=> array('')),
    ),
    'Roco Choco Chain' => array(
      'PL' => array(
        'Start'      => array('Bappy Hollow', 'Soiley'),
        'Melting' => array('Bappy Hollow', 'Soiley'),
      ),
      'PL Flatting' => array(
        'Start'         => array('Bappy Hollow', 'Soiley'),
        'PL Melting'       => array('Bappy Hollow', 'Soiley'),
        'Flatting'      => array('Bappy Hollow', 'Soiley'),
        'PL Buffing'    => array('Bappy Hollow', 'Soiley'),
        'AU+FE'         => array('Bappy Hollow', 'Soiley'),
        'Rolling'       => array('Bappy Hollow', 'Soiley'),
        'Strip Cutting' => array('Bappy Hollow', 'Soiley'),
        'Annealing II'  => array('Bappy Hollow', 'Soiley'),
        'Draw Bench'    => array('Bappy Hollow', 'Soiley'),
        'Tarpatta'      => array('Bappy Hollow', 'Soiley'),
        'Final'         => array('Bappy Hollow', 'Soiley'),
      ),
      'Spring Process' => array(
        'Start'  => array('Bappy Hollow', 'Soiley'),
        'Spring' => array('Bappy Hollow', 'Soiley'),
      ),
      'Chain Making Process' => array(
        'Start'        => array('Bappy Hollow', 'Soiley'),
        'Chain Making' => array('Bappy Hollow', 'Soiley'),
      ),
      
      'Final Process' => array(
        'Start'             => array('Bappy Hollow', 'Soiley'),
        'Filing'            => array('Bappy Hollow', 'Soiley'),
        'Walnut'            => array('Bappy Hollow', 'Soiley'),
        'Steel Vibrator'    => array('Bappy Hollow', 'Soiley'),
        'HCL'               => array('Bappy Hollow', 'Soiley'),
        'ReHCL'               => array('Bappy Hollow', 'Soiley'),
        'Tounch Department' => array('Bappy Hollow', 'Soiley'),
        'Castic Process'    => array('Bappy Hollow', 'Soiley'),
        'Lobster Out'       => array('Bappy Hollow', 'Soiley'),
        'Shampoo' => array('Bappy Hollow', 'Soiley'),
        'Hand Cutting'      => array('Bappy Hollow', 'Soiley'),
        'Hand Dull'         => array('Bappy Hollow', 'Soiley'),
        'Hook'              => array('Bappy Hollow', 'Soiley'),
        'Buffing'           => array('Bappy Hollow', 'Soiley'),
        'GPC Or Rodium'     => array('Bappy Hollow', 'Soiley'),
      ),
      'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      ),
    ),'Nawabi Chain' => array(
      'PL' => array(
        'Start'      => array('Bappy Hollow', 'Soiley'),
        'Melting' => array('Bappy Hollow', 'Soiley'),
      ),
      'PL Flatting' => array(
        'Start'         => array('Bappy Hollow', 'Soiley'),
        'PL Melting'       => array('Bappy Hollow', 'Soiley'),
        'Flatting'      => array('Bappy Hollow', 'Soiley'),
        'PL Buffing'    => array('Bappy Hollow', 'Soiley'),
        'AU+FE'         => array('Bappy Hollow', 'Soiley'),
        'Rolling'       => array('Bappy Hollow', 'Soiley'),
        'Strip Cutting' => array('Bappy Hollow', 'Soiley'),
        'Annealing II'  => array('Bappy Hollow', 'Soiley'),
        'Draw Bench'    => array('Bappy Hollow', 'Soiley'),
        'Tarpatta'      => array('Bappy Hollow', 'Soiley'),
        'Final'         => array('Bappy Hollow', 'Soiley'),
      ),
      'Spring Process' => array(
        'Start'  => array('Bappy Hollow', 'Soiley'),
        'Spring' => array('Bappy Hollow', 'Soiley'),
      ),
      'Chain Making Process' => array(
        'Start'        => array('Bappy Hollow', 'Soiley'),
        'Chain Making' => array('Bappy Hollow', 'Soiley'),
      ),
      
      'Final Process' => array(
        'Start'             => array('Bappy Hollow', 'Soiley'),
        'Filing'            => array('Bappy Hollow', 'Soiley'),
        'Walnut'            => array('Bappy Hollow', 'Soiley'),
        'Steel Vibrator'    => array('Bappy Hollow', 'Soiley'),
        'HCL'               => array('Bappy Hollow', 'Soiley'),
        'ReHCL'               => array('Bappy Hollow', 'Soiley'),
        'Tounch Department' => array('Bappy Hollow', 'Soiley'),
        'Castic Process'    => array('Bappy Hollow', 'Soiley'),
        'Lobster Out'       => array('Bappy Hollow', 'Soiley'),
        'Shampoo' => array('Bappy Hollow', 'Soiley'),
        'Hand Cutting'      => array('Bappy Hollow', 'Soiley'),
        'Hand Dull'         => array('Bappy Hollow', 'Soiley'),
        'Buffing'           => array('Bappy Hollow', 'Soiley'),
        'GPC Or Rodium'     => array('Bappy Hollow', 'Soiley'),
      ),
    ),
      'Casting chain' => array('Casting 75 Process' => array(
        'Melting Start'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Filing'          => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Pasta'            => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Lobster'             => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Shampoo'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Cutting'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Dull'       => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing II'      => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'GPC Or Rodium'   => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
    'Casting 92 Process' => array(
        'Melting Start'           => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Filing'          => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Walnut'            => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Lobster'             => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Shampoo'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Cutting'         => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Hand Dull'       => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'Buffing II'      => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
        'GPC Or Rodium'   => array('Ashish', 'Bappy Nawabi', 'Prashanto', 'Suman'),
      ),
    'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      )),
    'Hand Made Chain' => array(
      'Melting' => array(
        'Start'      => array('Bappy Hollow', 'Soiley'),
        'Melting' => array('Bappy Hollow', 'Soiley'),
        'Flatting' => array('Bappy Hollow', 'Soiley'),
        'Stamping' => array('Bappy Hollow', 'Soiley'),
      ),
      'Chain Making Process' => array(
        'Start'        => array('Bappy Hollow', 'Soiley'),
        'Chain Making' => array('Bappy Hollow', 'Soiley'),
      ),
      
      'Final Process' => array(
        'Vibrator'             => array('Bappy Hollow', 'Soiley'),
        'Hammering'             => array('Bappy Hollow', 'Soiley'),
        'Hand Cutting'      => array('Bappy Hollow', 'Soiley'),
        'Cutting'         => array('Bappy Hollow', 'Soiley'),
        'Hook'         => array('Bappy Hollow', 'Soiley'),
        'Buffing'           => array('Bappy Hollow', 'Soiley'),
        'Tounch Department'         => array('Bappy Hollow', 'Soiley'),
        'GPC'     => array('Bappy Hollow', 'Soiley'),
      ),
      'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      )
    ),
    'Fancy Chain' => array(
       'Chain Making ARG Process' => array(
        'Start'        => array(''),
        'Chain Making' => array(''),
      ),
      'Final Process' => array(
        'Start'         => array('Kashinath'),
        'Polish'        => array('Kashinath'),
        'Buffing'       => array('Kashinath'),
        'GPC Or Rodium' => array('Kashinath'),
      ),
    ),

    'Sisma Chain' => array(
      'AG' => array(
        'Start'         => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Melting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Flatting'      => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Sisma Machine' => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),
      'Sisma Machine Process' => array(
        'Start'         => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Sisma Machine'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),
      'Karigar Process' => array(
        'Start'         => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Chain Making'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Buffing'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hand Cutting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hand Dull'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Filing'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Magnet'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),'Karigar Bom Process' => array(
        'Start'         => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Chain Making'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Buffing'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hand Cutting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hand Dull'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Filing'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Magnet'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Pasta'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      'Engraving'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      'Copper'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      'Stripping'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),
      'RND Process' => array(
        'Start'         => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Chain Making'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Buffing'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hand Cutting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hand Dull'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Filing'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),
      'Mangalsutra Process' => array(
        'Start'         => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Chain Making'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Buffing'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hand Cutting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hand Dull'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Filing'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Magnet'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),
      'Final Process' => array(
        'Start'        => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Filing II'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hand Cutting II' => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hand Dull II'    => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Polish'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'GPC'          => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),
      'Hallmarking Process' => array(
        'Hallmarking' => array(), 
        'GPC' => array()
      ),
      'Issue ARC or ARF' => array(
        'Start'        => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'GPC'          => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),
    ),
    
     'Sisma Accessories Making Chain' => array(
      'Anchor Clipping Process' => array(
        'Start'         => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Melting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Wire Making'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Machine Department'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Solder'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Vishnu'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Vibrator'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'DC'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hold'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Clipping Process'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Clipping Process'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Vibrator 2'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Copper'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Cutting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Stripping'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Final'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),
      'Two Mm Ball Process' => array(
        'Start'         => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Melting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Wire Making'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Machine Department'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Clipping Process'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Vibrator'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Cutting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'R/d'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Final'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),
      'Pipe Clipping Process' => array(
        'Start'         => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Melting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Wire Making'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Machine Department'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Solder'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Vishnu'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Vibrator'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'DC'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hold'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Clipping Process'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Clipping Process'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Vibrator 2'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Copper'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Cutting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Stripping'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Final'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),
      'Para Process' => array(
        'Melting Start'         => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Melting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Flatting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Pipe and Para Making'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Cutting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Hand Cutting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Final'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),
      'Patti Making Process' => array(
        'Melting Start'         => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Melting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Flatting'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
        'Final'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
      ),
      'Final Process' => array(
        'Final'       => array('ARC', 'ARF', 'Amit', 'Ashish', 'Babby Nawabi', 'Kashinath', 'Kumar', 'Shyam sundar'),
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
