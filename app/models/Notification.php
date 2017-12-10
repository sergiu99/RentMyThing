<?php

class Notification extends Model{
	public $user_id;
	public $content;
	public $created_on;
	public $redirect;

	public function __construct(){
		parent::__construct();
	}
	
	function isValid(){
		return ($this->firstName!='' && $this->country != '');
	}

    function viewChatNotifs($rental_id, $user_id){
		$redirect = $this->_connection->quote("/Rentals?chat=" . $rental_id);
		$delete = "DELETE FROM notification
					WHERE user_id = $user_id AND redirect = $redirect";
		$stmt = $this->_connection->prepare($delete);
        $stmt->execute();
	}
	
	function clearNotifications(){
		$userId =  $_SESSION['userID'];
		$update = "UPDATE notification
					SET viewed = 1
					WHERE user_id = $userId AND viewed = 0";
		$stmt = $this->_connection->prepare($update);
		$stmt->execute();
		echo json_encode("EXECUTED");
	}
}
?>