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
	
	public function getItem($id){
		$select = "SELECT t1.id, t1.user_id, t1.name, t1.description, t1.image_path, t1.price, t2.name as category, t3.postal_code_address as postal_code, t1.rating, t1.status FROM item t1 INNER JOIN category t2 ON t1.category = t2.id INNER JOIN user t3 ON t1.user_id = t3.id WHERE t1.id=$id";
		$stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
        return $returnVal;
	}

	public function search($category, $keyword, $location){
		$select = "SELECT * FROM item WHERE ";
		$categoryQuote = $this->_connection->quote($category);
		$keywordQuote = $this->_connection->quote('%' . $keyword . '%');
		$locationWhere = "LOCATIONS";
		/*if($location != null){
			$locationWhere = "AND user_id IN (SELECT id FROM user WHERE SUBSTRING(postal_code_address,0,3) IN (";
			for($i = 0; i < sizeof($location) - 1; $i++){
				$locationWhere .= $this->_connection->quote($location[$i]);
				$locationWhere .= ",";
			}
			$locationWhere .= $this->_connection->quote($location[sizeof($location) - 1]);
			$locationWhere .= ")";
		}*/

		if($category != ""){
			if($keyword != ""){
				$this->_whereClause .= "WHERE t1.category = 
							(SELECT c.id 
							FROM category c
							WHERE c.name = $categoryQuote) AND (t1.name LIKE $keywordQuote OR t1.description LIKE $keywordQuote)";
			}else{
				$this->_whereClause .= "WHERE t1.category = 
							(SELECT c.id 
							FROM category c
							WHERE c.name = $categoryQuote)";
			}
		}else{
			if($keyword != ""){
				$this->_whereClause .= "(WHERE t1.name LIKE $keywordQuote OR t1.description LIKE $keywordQuote)";
			}
		}
		$this->_whereClause .= "(WHERE t1.name LIKE $keywordQuote OR t1.description LIKE $keywordQuote)";
		$this->_whereClause .= $locationWhere;
		return $this->getDisplayInfo();

		/*$stmt = $this->_connection->prepare($select);
        $stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
		
		$returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
		return $returnVal;
		return $stmt;*/
	}

	function setStatus($itemId, $status){
		$status = $this->_connection->quote($status);
		$update	= "UPDATE item SET status = $status WHERE id = $itemId";
		$stmt = $this->_connection->prepare($update);
		$stmt->execute();
		return "updated";
	}
}
?>