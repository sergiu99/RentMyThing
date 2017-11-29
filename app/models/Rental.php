<?php

class Rental extends Model{
	public $id;
	public $user_id;
	public $item_id;
	public $start_date;
	public $end_date;
	public $total;
	public $status;

	public function __construct(){
		parent::__construct();
	}
	
public	function isValid(){
		return ($this->item_id!='' && $this->user_id != '');
	}
public function getMyRentals(){

		$userId =  $_SESSION['userID'];
		$select	= "SELECT t1.id as id, t1.user_id as user_id, t1.start_date as start_date, t1.end_date as end_date, t1.total as total, t1.status as status, t2.name as name, t2.description as description, t2.image_path as image_path FROM rental t1 INNER JOIN item t2 ON t1.item_id = t2.id WHERE t1.user_id = $userId AND t1.status != 'completed' AND t1.status != 'declined' $this->_whereClause $this->_orderBy";

        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
        return $returnVal;
    }

public function getMyCompletedRentals(){

        $userId =  $_SESSION['userID'];
        $select = "SELECT t1.id as id, t1.user_id as user_id, t1.start_date as start_date, t1.end_date as end_date, t1.total as total, t1.status as status, t2.name as name, t2.description as description, t2.image_path as image_path FROM rental t1 INNER JOIN item t2 ON t1.item_id = t2.id WHERE t1.status = 'completed' AND (t1.user_id = $userId  OR t2.user_id = $userId) $this->_whereClause $this->_orderBy";
        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
        return $returnVal;
    }


public function getMyItemProposals(){

		$userId =  $_SESSION['userID'];
		$select	= "SELECT t1.id as id, t1.user_id as user_id, t1.start_date as start_date, t1.end_date as end_date, t1.total as total, t1.status as status, t2.name as name, t2.description as description, t2.image_path as image_path FROM rental t1 INNER JOIN item t2 ON t1.item_id = t2.id WHERE t2.user_id = $userId AND t1.status = 'pending' $this->_whereClause $this->_orderBy";

        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
        return $returnVal;
    }

    public function getMyRentingItems(){

		$userId =  $_SESSION['userID'];
		$select	= "SELECT t1.id as id, t1.user_id as user_id, t1.start_date as start_date, t1.end_date as end_date, t1.total as total, t1.status as status, t2.name as name, t2.description as description, t2.image_path as image_path FROM rental t1 INNER JOIN item t2 ON t1.item_id = t2.id WHERE t2.user_id = $userId AND (t1.status = 'accepted' OR t1.status LIKE 'reqcompleted%') $this->_whereClause $this->_orderBy";

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