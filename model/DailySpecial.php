<?php

interface DailySpecial_Interface{
	public function setDailySpecial($iID, $mID);
	public function get($iID);
	public function get_latest();
	public function setDate($sDate);
}

class DailySpecial_Model implements DailySpecial_Interface {
	private $db;    

	public $daily;

	// set an item as daily special and assign it a menu
    public function setDailySpecial($iID, $mID) {
    	$db = Database_Core::get();
    	$db->beginTransaction();
    	$sQuery = "INSERT INTO daily_special (daily_special_date, item_id, menu_id) 
    	VALUES (CURDATE(), :item_id, :menu_id)";
    	$oStmt = $db->prepare($sQuery);
    	$oStmt->bindValue(':item_id', $iID, PDO::PARAM_INT);
    	$oStmt->bindValue(':menu_id', $mID, PDO::PARAM_INT);
    	$oStmt->execute();
    	$db->commit();
    }

    // if item is daily special, get it 
	public function get($iID) {
		$db = Database_Core::get();
    	$db->beginTransaction();
    	$sQuery = "SELECT * FROM daily_special WHERE item_id = :item_id LIMIT 1";
    	$oStmt = $db->prepare($sQuery);
    	$oStmt->bindValue(':item_id', $iID, PDO::PARAM_INT);
    	$data = $oStmt->execute();
    	echo json_encode($data);
	}

	// get latest daily special
	public function get_latest() {
		$db = Database_Core::get();
    	$db->beginTransaction();
    	$sQuery = "SELECT * FROM daily_special ORDER BY daily_special_id DESC LIMIT 1";
    	$oStmt = $db->prepare($sQuery);
    	$data = $oStmt->execute();
    	var_dump($data);
    	return $data;
	}

	// construct instance of model
	public function __construct()
    {

    }

	// set a date (usually this will be today)
	public function setDate($sDate) {
		$this->date = $sDate;
		return $date;
	}
} 