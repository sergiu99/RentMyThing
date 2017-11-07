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
	public $number_address;
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
}

?>