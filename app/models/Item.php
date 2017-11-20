<?php

class Item extends Model{
	public $id;
	public $name;
	public $user_id;
	public $description;
	public $image_path;
	public $price;
	public $category;
	public $rating;
	public $status;

	public function __construct(){
		parent::__construct();
	}
	
public	function isValid(){
		return ($this->name!='' && $this->user_id != '');
	}
	
public function getDisplayInfo(){
		$select	= "SELECT t1.id, t1.user_id, t1.name, t1.description, t1.image_path, t1.price, t2.name as category, t1.rating, t1.status FROM item t1 INNER JOIN category t2 ON t1.category = t2.id $this->_whereClause $this->_orderBy";

        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
        return $returnVal;
	}
	
	public function search($category, $keyword){
		$value = $this->_connection->quote($value);
		$this->_whereClause = 'WHERE category = (SELECT id FROM category WHERE name = "Home Renovation Materials") AND (name LIKE "%Potter%" OR description LIKE "Potter")';
		

		return $this;
		$select = 'SELECT * FROM item WHERE category = (SELECT id FROM category WHERE name = "Home Renovation Materials") AND (name LIKE "%Potter%" OR description LIKE "Potter")';
		/*if($category != ""){
			$select .= " category = 
							(SELECT id 
							FROM category 
							WHERE name = $category) AND (name LIKE '%$keyword%' OR decription LIKE '%$keyword%')";
			
		}else{
			if($keyword != ""){
				$select .= " name LIKE '%$keyword%' OR decription LIKE '%$keyword%'";
			}
		}*/

		/*$stmt = $this->_connection->prepare($select);
        $stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
		$returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
        return $returnVal;*/
	}
}
?>