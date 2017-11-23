<?php
class Message extends Model
{
    public $id;
    public $rental_id;
    public $sender_id;
    public $created_on;

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

    function getMessages($user1, $user2, $lastId){
        $select = "SELECT * FROM message WHERE id >$lastId AND ((sender_id = $user1 AND rental_id = $user2) OR (sender_id = $user2 AND rental_id = $user1))";
        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
			$returnVal[] = $rec;
		}
		return $returnVal;
    }

    function postMessage($sender, $receiver){

    }
}
?>