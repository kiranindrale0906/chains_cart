<?php
include_once APPPATH . "modules/receipt_departments/controllers/Pending_ghiss_receipts.php";
class Api_pending_ghiss_receipts extends Pending_ghiss_receipts {
	public function __construct() {
		parent::__construct();
	}
}