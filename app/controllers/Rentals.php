<?php

class Rentals extends Controller{
	
	function index(){
		$aItem = $this->model('Rental');
		$userId =  $_SESSION['userID'];
		$myItems = $aItem->where('user_id','=', $userId)->get();
		
		$this->view('Rentals/index',['myRentals'=>$myItems]);

	}



public function getMyRentals(){
		$select	= "SELECT * FROM item t1 INNER JOIN category t2 ON t1.category = t2.id $this->_whereClause $this->_orderBy";

        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
        return $returnVal;
    }

public function getMyItemRentals(){
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


}
?>