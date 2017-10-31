<?php

class User extends Model
{
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

	public function update(){
		$properties = $this->getProps();
		$num = count($properties);
		$update = '';
		if ($num  > 0){
			//update
			$setClause = [];
			
			foreach($properties as $item)
				$setClause[] = sprintf('%s = :%s', $item, $item);
			$setClause = implode(', ', $setClause);
			$update = 'UPDATE ' . $this->_className . ' SET ' . $setClause . " WHERE $this->_PKName = :$this->_PKName";
		}

		$properties[]=$this->_PKName;
        $stmt = $this->_connection->prepare($update);
        $stmt->execute($this->toArray($properties));
	}

}

?>