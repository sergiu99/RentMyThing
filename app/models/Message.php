<?php
class Message extends Model
{
    public $id;
    public $rental_id;
    public $sender_id;
    public $created_on;
    public $content;

    function getMessages($rentalId){
        $select = "SELECT * FROM message WHERE id = $rentalId";
        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
			$returnVal[] = $rec;
		}
		return $returnVal;
    }

    function getNewMessages($lastId, $rentalId){
        $returnVal = '{"results":[';
        $select = "SELECT * FROM message WHERE id > $lastId AND rental_id = $rentalId";
        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $jsonResults = [];
        while($rec = $stmt->fetch()){
			$jsonResults[] = json_encode($rec);
        }
        $returnVal .=implode(",", $jsonResults); 
        $returnVal .= ']}';
		return $returnVal;
    }
}
?>