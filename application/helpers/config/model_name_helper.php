<?php
	function get_model_name($product_name, $process_name) {
//		 print_r($process_name);		 pd($product_name);
		if ($process_name=='Refresh Final Process')
			return array('model_name'=>'Refresh_final_process_model','module_name'=>'refresh');
			
		switch ($product_name) {
			case 'Receipt':
				switch ($process_name) {
					case 'Receipt':
						$model_name = array('model_name'=>'Receipt_department_model','module_name'=>'receipt_departments');
						break;	
					case 'Fancy Chain':
					  $model_name = array('model_name'=>'Receipt_department_model','module_name'=>'receipt_departments');
						break;
					case 'Fancy Chain 75':
					  $model_name = array('model_name'=>'Receipt_department_model','module_name'=>'receipt_departments');
						break;

				}
				break;
            
			case 'Rope Chain':
				switch ($process_name) {
					case 'Melting Process':
						$model_name = array('model_name'=>'rope_chain_melting_process_model','module_name'=>'rope_chains');
						break;
					case 'Machine Process':
						$model_name = array('model_name'=>'rope_chain_machine_process_model','module_name'=>'rope_chains');
						break;
					case 'Final Process':
						$model_name = array('model_name'=>'rope_chain_final_process_model','module_name'=>'rope_chains');
						break;
				}
				break;
			case 'Choco Chain':
				switch ($process_name) {
					case 'Melting Process':
						$model_name = array('model_name'=>'choco_chain_melting_process_model','module_name'=>'choco_chains');
						break;
					case 'Chain Making Process':
						$model_name = array('model_name'=>'choco_chain_chain_making_process_model','module_name'=>'choco_chains');
						break;
					case 'Final Process':
						$model_name = array('model_name'=>'choco_chain_final_process_model','module_name'=>'choco_chains');
						break;
				}
				break;
			
			case 'Export Internal':
				switch ($process_name) {
					case 'Export Internal Receipt':
						$model_name = array('model_name'=>'Export_internal_receipt_model','module_name'=>'export_internals');
						break;
					case 'Export Internal Issue':
						$model_name = array('model_name'=>'Export_internal_issue_model','module_name'=>'export_internals');
						break;
				}
				break;
			case 'Domestic Internal':
				switch ($process_name) {
					case 'Hold Process':
						$model_name = array('model_name'=>'Domestic_internal_hold_process_model','module_name'=>'domestic_internals');
						break;
					case 'QC Process':
						$model_name = array('model_name'=>'Domestic_internal_qc_process_model','module_name'=>'domestic_internals');
						break;
					case 'GPC Process':
						$model_name = array('model_name'=>'Domestic_internal_gpc_process_model','module_name'=>'domestic_internals');
						break;
				}
				break;

			case 'Stone Receipt':
				switch ($process_name) {
					case 'Stone Receipt':
						$model_name = array('model_name'=>'Stone_receipt_model','module_name'=>'receipt_departments');
						break;
				}
				break;

			case 'Loss Receipt':
				switch ($process_name) {
					case 'Loss Receipt':
						$model_name = array('model_name'=>'Loss_receipt_model','module_name'=>'receipt_departments');
						break;
				}
				break;

			case 'Pending Ghiss Receipt':
				switch ($process_name) {
					case 'Pending Ghiss Receipt':
						$model_name = array('model_name'=>'Pending_ghiss_receipt_model','module_name'=>'receipt_departments');
						break;
				}
				break;

			case 'Finished Goods Receipt':
				switch ($process_name) {
					case 'Final Process':
						$model_name = array('model_name'=>'Finished_goods_receipt_model','module_name'=>'receipt_departments');
						break;	
				}
				break;

			case 'Rod Cleaning':
				switch ($process_name) {
					case 'Rod Cleaning Melting Process':
						$model_name = array('model_name'=>'Rod_cleaning_melting_process_model','module_name'=>'rod_cleaning');
						break;	
				}
				break;

			case 'Chain Receipt':
				$model_name = array('model_name'=>'Chain_receipt_model','module_name'=>'receipt_departments');
				break;
			case 'Hallmark Receipt':
				$model_name = array('model_name'=>'Hallmark_receipt_model','module_name'=>'receipt_departments');
				break;
			case 'Hallmark':
				switch ($process_name) {
					case 'Hallmark Receipt Process':
						$model_name = array('model_name'=>'hallmark_receipt_process_model','module_name'=>'hallmarking');
						break;
					case 'Quality Process':
						$model_name = array('model_name'=>'quality_manager_process_model','module_name'=>'hallmarking');
						break;
					case 'XRF Process':
							$model_name = array('model_name'=>'xrf_process_model','module_name'=>'hallmarking');
							break;
					case 'Fire Assay Process':
						$model_name = array('model_name'=>'fire_assay_process_model','module_name'=>'hallmarking');
						break;
					case 'Fire Assay Out Chain':
						$model_name = array('model_name'=>'fire_assay_out_chain_model','module_name'=>'hallmarking');
						break;
					case 'HUID Process':
						$model_name = array('model_name'=>'huid_process_model','module_name'=>'hallmarking');
						break;
					case 'Hallmark HUID Process':
						$model_name = array('model_name'=>'huid_process_model','module_name'=>'hallmarking');
						break;
					case 'Factory Out Process':
						$model_name = array('model_name'=>'factory_out_process_model','module_name'=>'hallmarking');
						break;
					case 'Hallmark Out Hold Process':
						$model_name = array('model_name'=>'hallmark_out_hold_process_model','module_name'=>'hallmarking');
						break;
					}
				break;
			case 'Rhodium Receipt':
				$model_name = array('model_name'=>'Rhodium_receipt_model','module_name'=>'receipt_departments');
				break;
				// switch ($process_name) {
				// 	case 'Solid Machine Chain':
				// 		$model_name = array('model_name'=>'Chain_receipt_model','module_name'=>'receipt_departments');
				// 		break;	
				// 	case 'Italy Chain':
				// 	  $model_name = array('model_name'=>'Chain_receipt_model','module_name'=>'receipt_departments');
				// 		break;
				// 	case 'Hollow Machine Chain':
				// 	  $model_name = array('model_name'=>'Chain_receipt_model','module_name'=>'receipt_departments');
				// 		break;
				// 	case 'Round Box Chain':
				// 	  $model_name = array('model_name'=>'Chain_receipt_model','module_name'=>'receipt_departments');
				// 		break;
				// 	case 'Choco Chain':
				// 	  $model_name = array('model_name'=>'Chain_receipt_model','module_name'=>'receipt_departments');
				// 		break;
				// 	case 'Box Chain':
				// 	  $model_name = array('model_name'=>'Chain_receipt_model','module_name'=>'receipt_departments');
				// 		break;
				// }
				// break;	
			case 'Alloy Receipt':
				switch ($process_name) {
					case 'ProGold-Genia 123':
						$model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
						break;	
					case 'Galorini-SY2022':
					  $model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
						break;
					case 'Silver':
					  $model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
						break;
					case 'ProGold-Genia 154':
					  $model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
						break;
					case 'Indian Co-GR30':
					  $model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
						break;
					case 'ProGold-Genia 173':
					  $model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
						break;
					case 'Ekisson-FAS10':
					  $model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
						break;
				case 'Zinc':
					  $model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
						break;
				case 'ProGold-Unibax 121':
					  $model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
						break;
				case 'Galorini-SSR-1418M':
					  $model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
						break;
				case 'Mix Alloy':
					  $model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
						break;
				case 'Prima 307ng':
					$model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
					break;
				case 'BH111RC':
					$model_name = array('model_name'=>'Alloy_receipt_model','module_name'=>'alloy_receipts');
					break;
				}
				break;	
					case 'Daily Drawer Receipt':
				switch ($process_name) {
					case 'Hook':
						$model_name = array('model_name'=>'Daily_drawer_receipt_model','module_name'=>'daily_drawer_receipts');
						break;	
					case 'KDM':
					  $model_name = array('model_name'=>'Daily_drawer_receipt_model','module_name'=>'daily_drawer_receipts');
						break;
					case 'Lobster':
					  $model_name = array('model_name'=>'Daily_drawer_receipt_model','module_name'=>'daily_drawer_receipts');
						break;
					case 'Para':
					  $model_name = array('model_name'=>'Daily_drawer_receipt_model','module_name'=>'daily_drawer_receipts');
						break;
					case 'I/O Pic':
					  $model_name = array('model_name'=>'Daily_drawer_receipt_model','module_name'=>'daily_drawer_receipts');
						break;
					case 'Pipe':
					  $model_name = array('model_name'=>'Daily_drawer_receipt_model','module_name'=>'daily_drawer_receipts');
						break;	
					case 'Anc Chain':
					  $model_name = array('model_name'=>'Daily_drawer_receipt_model','module_name'=>'daily_drawer_receipts');
						break;	
					case 'Stone':
					  $model_name = array('model_name'=>'Daily_drawer_receipt_model','module_name'=>'daily_drawer_receipts');
						break;	
					case 'Sisma Pic':
					  $model_name = array('model_name'=>'Daily_drawer_receipt_model','module_name'=>'daily_drawer_receipts');
						break;
					case 'GPC Powder':
					  $model_name = array('model_name'=>'Daily_drawer_receipt_model','module_name'=>'daily_drawer_receipts');
						break;
				}
				break;
			case 'HCL':	
				switch ($process_name) {
					case 'HCL Melting Process':
						$model_name = array('model_name'=>'Hcl_melting_process_model','module_name'=>'hcl');
						break;
				}
				break;
			case 'Office Outside':
				switch ($process_name) {
					case 'Hook':
						$model_name = array('model_name'=>'Hook_model','module_name'=>'office_outside');
						break;	
					case 'KDM':
						$model_name = array('model_name'=>'Kdm_model','module_name'=>'office_outside');
						break;
					case 'Lobster':
						$model_name = array('model_name'=>'Lobster_model','module_name'=>'office_outside');
						break;		
					}
				break;

			case 'Refresh':
				switch ($process_name) {
					case 'Refresh Hold':
						$model_name = array('model_name'=>'Refresh_hold_model','module_name'=>'refresh');
						break;
			    case 'Hand Cutting Process':
						$model_name = array('model_name'=>'Refresh_hand_cutting_process_model','module_name'=>'refresh');
						break;
				case 'Internal GPC Process':
						$model_name = array('model_name'=>'Refresh_internal_gpc_process_model','module_name'=>'refresh');
						break;
				case 'Hand Dull Process':
						$model_name = array('model_name'=>'Refresh_hand_dull_process_model','module_name'=>'refresh');
						break;
				case 'Refresh':
						$model_name = array('model_name'=>'Refresh_model','module_name'=>'refresh');
						break;
				}
				break;
			case 'Ghiss Out':
				switch ($process_name) {
					case 'Melting':
						$model_name = array('model_name'=>'ghiss_out_melting_process_model','module_name'=>'ghiss_outs');
						break;
					case 'Final Process':
						$model_name = array('model_name'=>'ghiss_out_final_process_model','module_name'=>'ghiss_outs');
						break;
				}
				break;
			case 'Melting Wastage Refine Out':
				switch ($process_name) {
					case 'Melting':
						$model_name = array('model_name'=>'melting_wastage_refine_out_melting_process_model','module_name'=>'melting_wastage_refine_outs');
						break;
				}
				break;
			case 'Loss Out':
				switch ($process_name) {
					case 'Melting':
						$model_name = array('model_name'=>'loss_out_melting_process_model','module_name'=>'loss_outs');
						break;
				}
				break;
			case 'Melting Loss Out':
				switch ($process_name) {
					case 'Melting':
						$model_name = array('model_name'=>'melting_loss_out_process_model','module_name'=>'loss_outs');
						break;
				}
				break;
			case 'Sisma Chain':
			switch ($process_name) {
				case 'AG':
					$model_name = array('model_name'=>'sisma_chain_ag_model','module_name'=>'sisma_chains');
					break;
				case 'Sisma Machine Process':
					$model_name = array('model_name'=>'sisma_chain_sisma_machine_process_model','module_name'=>'sisma_chains');
					break;
				case 'Karigar Process':
					$model_name = array('model_name'=>'sisma_chain_karigar_process_model','module_name'=>'sisma_chains');
					break;
				case 'Karigar Bom Process':
					$model_name = array('model_name'=>'sisma_chain_karigar_bom_process_model','module_name'=>'sisma_chains');
					break;
				case 'Mangalsutra Process':
					$model_name = array('model_name'=>'sisma_chain_mangalsutra_process_model','module_name'=>'sisma_chains');
					break;
				case 'RND Process':
					$model_name = array('model_name'=>'sisma_chain_rnd_process_model','module_name'=>'sisma_chains');
					break;
				case 'RND In Process':
					$model_name = array('model_name'=>'sisma_chain_rnd_in_process_model','module_name'=>'sisma_chains');
					break;
				case 'Factory Hold Process':
					$model_name = array('model_name'=>'sisma_chain_factory_hold_process_model','module_name'=>'sisma_chains');
					break;
				case 'Final Process':
					$model_name = array('model_name'=>'sisma_chain_final_process_model','module_name'=>'sisma_chains');
					break;
				case 'Hallmarking Process':
					$model_name = array('model_name'=>'sisma_chain_hallmarking_process_model','module_name'=>'sisma_chains');
					break;
				case 'Issue ARC or ARF':
					$model_name = array('model_name'=>'sisma_chain_issue_arc_or_arf_process_model','module_name'=>'sisma_chains');
					break;
			}
			break;case 'Sisma ARF Chain':
			switch ($process_name) {
				case 'AG':
					$model_name = array('model_name'=>'sisma_arf_chain_ag_model','module_name'=>'sisma_arf_chains');
					break;
				case 'Sisma Machine Process':
					$model_name = array('model_name'=>'sisma_arf_chain_sisma_machine_process_model','module_name'=>'sisma_arf_chains');
					break;
				case 'Polish Process':
					$model_name = array('model_name'=>'sisma_arf_chain_polish_process_model','module_name'=>'sisma_arf_chains');
					break;
			}
			break;
			case 'HCL Ghiss Out':
				switch ($process_name) {
					case 'Melting':
						$model_name = array('model_name'=>'hcl_ghiss_out_melting_process_model','module_name'=>'hcl_ghiss_outs');
						break;
				}
				break;		
			
			case 'Solder Wastage':
				switch ($process_name) {
					case 'Melting':
						$model_name = array('model_name'=>'solder_wastage_out_melting_process_model','module_name'=>'solder_wastage_outs');
						break;
				}
				break;
			case 'ARC':
			switch ($process_name) {
				case 'ARC':
					$model_name = array('model_name'=>'arc_model','module_name'=>'arcs');
					break;
			}
	    	case 'Stone Melting':
			switch ($process_name) {
				case 'Melting':
					$model_name = array('model_name'=>'stone_vatav_melting_process_model','module_name'=>'stone_vatav_outs');
					break;
			}	
			break;	
			

			case 'Daily Drawer':
				switch ($process_name) {
					case 'Melting':
						$model_name = array('model_name'=>'daily_drawer_melting_process_model','module_name'=>'daily_drawers');
						break;
					case 'Melting II':
						$model_name = array('model_name'=>'daily_drawer_melting_ii_process_model','module_name'=>'daily_drawers');
						break;
				}	
				break;	

			case 'Pending Ghiss Out':
			  switch ($process_name) {
					case 'Pending Ghiss Out':
						$model_name = array('model_name'=>'pending_ghiss_out_process_model',
							                  'module_name'=>'pending_ghiss_outs');
						break;
				}
				break;

			case 'Pending Loss Out':
			  switch ($process_name) {
					case 'Laser Process':
						$model_name = array('model_name'=>'pending_loss_out_model',
							                  'module_name'=>'loss_outs');
						break;
					case 'Box Process':
						$model_name = array('model_name'=>'pending_loss_out_model',
							                  'module_name'=>'loss_outs');
						break;
					case 'Basket Process':
						$model_name = array('model_name'=>'pending_loss_out_model',
							                  'module_name'=>'loss_outs');
						break;
					case 'Box Chain Process':
						$model_name = array('model_name'=>'pending_loss_out_model',
							                  'module_name'=>'loss_outs');
						break;
					case 'Anchor Process':
						$model_name = array('model_name'=>'pending_loss_out_model',
							                  'module_name'=>'loss_outs');
						break;
					case 'Strip Start Process':
						$model_name = array('model_name'=>'pending_loss_out_model',
							                  'module_name'=>'loss_outs');
						break;
			
					 case 'Casting Process':
                                                $model_name = array('model_name'=>'pending_loss_out_model',
                                                                          'module_name'=>'loss_outs');
                                                break;
}
				break;

			case 'Daily Drawer Wastage':
			  $model_name = array('model_name'=>'daily_drawer_wastage_model','module_name'=>'daily_drawers');
			  break;  

			case 'Pending Loss from Hook':
			  $model_name = array('model_name'=>'Pending_loss_from_hook_model', 'module_name'=>'daily_drawers');
			  break;  

		}
		return $model_name;
	}
?>
