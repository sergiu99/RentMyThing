<?php

class User extends Model
{
	public $id;
	public $first_name;
	public $last_name;
	public $email;
	public $display_name;
	public $password;
	public $phone_number;
	public $join_date;
	public $street_address;
	public $city_address;
	public $postal_code_address;
	public $province_address;
	public $account_status;

	public function __construct(){
		parent::__construct();
	}

	public static function getPasswordHash(){
		$id = $_SESSION['userID'];
		$select = "SELECT password FROM user WHERE id = $id";
		$result = $this->_connection->query($select);
        while($rec = $result->fetch()){
            $returnVal = $rec["password"];
        }
        return $returnVal;
	}

	//Get the user details for a search by keyword
	function search($keyword){
		$keywordQuote = $this->_connection->quote('%' . $keyword . '%');
		$select = "SELECT u.id, u.display_name, u.join_date, u.phone_number, u.street_address, u.city_address, u.postal_code_address, u.province_address, u.show_email, u.show_phone, u.show_address, (SELECT COUNT(i.id) FROM item i WHERE i.user_id = u.ID AND i.status = 'enabled') as count FROM user u WHERE u.account_status = 'active' AND u.display_name LIKE $keywordQuote";
		$stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
			$returnVal[] = $rec;
		}
		return $returnVal;
	}

	//Clear some user data
	function clearUserData(){
		$userId = $_SESSION['userID'];
		$deleteFavorites = "DELETE FROM favorite WHERE user_id = $userId OR item_id IN (SELECT id FROM item WHERE user_id = $userId)";
		$deleteRentals = "DELETE FROM rental WHERE status = 'pending' AND user_id = $userId"; //Delete pending rental proposals
		$disableListings = "UPDATE item SET status = 'disabled' WHERE user_id = $userId";
		$stmt = $this->_connection->prepare($deleteFavorites);
		$stmt->execute();
		$stmt = $this->_connection->prepare($deleteRentals);
		$stmt->execute();
		$stmt = $this->_connection->prepare($disableListings);
		$stmt->execute();
	}
}

?>