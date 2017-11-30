<?php

class Comment extends Model{
	public $content;
	public $rental_id;
	public $rating;
	public $poster_status;
	public function __construct(){
		parent::__construct();
	}
	
	function isValid(){
		return ($this->content!='' && $this->rental_id != '');
	}


	
	public function getRentalFromComment(){
		$select = "SELECT t1.id as id, t1.content as content, t1.rating as rating, t2.item_id as item_id FROM comment t1 INNER JOIN rental t2 ON t1.rental_id = t2.id $this->_whereClause $this->_orderBy";
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