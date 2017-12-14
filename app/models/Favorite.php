<?php

class Favorite extends Model{
	public $id;
	public $item_id;
	public $user_id;
	public function __construct(){
		parent::__construct();
	}
    
    //Get a user's favorited items
	function getFavorites(){
        $id = $_SESSION['userID'];
        $select	= "SELECT t1.id, t1.user_id, t1.name, t1.description, t1.image_path, t1.price, t2.name as category, t3.postal_code_address as postal_code , t1.rating, t1.status FROM item t1 INNER JOIN category t2 ON t1.category = t2.id INNER JOIN user t3 ON t1.user_id = t3.id WHERE t1.id IN (SELECT t4.item_id FROM favorite t4 WHERE t4.user_id = $id)";
        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
        return $returnVal;
    }

    //Get a user's favorite item ids
    function getUserFavoritesId(){
        $id = $_SESSION['userID'];
        $select	= "SELECT item_id FROM favorite WHERE user_id = $id";
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