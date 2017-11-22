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

	function search($keyword){
		$keywordQuote = $this->_connection->quote('%' . $keyword . '%');
		$select = "SELECT u.id, u.display_name, u.phone_number, u.street_address, u.city_address, u.postal_code_address, u.province_address, (SELECT COUNT(i.id) FROM item i WHERE i.user_id = u.ID) as count FROM user u WHERE u.display_name LIKE $keywordQuote";
		$stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
			$returnVal[] = $rec;
		}
		return $returnVal;
	}
}

?>