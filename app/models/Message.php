<?php
class Message extends Model
{
    public $id;
    public $rental_id;
    public $sender_id;
    public $created_on;
    public $content;

    function getMessages($user1, $user2){
        $select = "SELECT * FROM message WHERE (sender_id = $user1 AND rental_id = $user2) OR (sender_id = $user2 AND rental_id = $user1)";
        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
			$returnVal[] = $rec;
		}
		return $returnVal;
    }

    function getNewMessages($lastId, $user1, $user2){
        $returnVal = '{"results":[';
        $select = "SELECT * FROM message WHERE id > $lastId AND ((sender_id = $user1 AND rental_id = $user2) OR (sender_id = $user2 AND rental_id = $user1))";
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