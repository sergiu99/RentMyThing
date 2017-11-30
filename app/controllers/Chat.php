<?php 
class Chat extends Controller
{
    function index($rentalId){
        $aMessage = $this->model('Message');
        $conversation = $aMessage->getMessages($rentalId);
        echo json_encode($conversation);
    }

    function sendMessage(){
        $rentalId = $_GET['rentalID'];
        $content = $_GET['content'];
        $newMessage = $this->model('Message');
        $newMessage->rental_id = $rentalId;
        $newMessage->sender_id = $_SESSION['userID'];
        $newMessage->content = $content;
        $newId = $newMessage->insert();
        $aRental = $this->model('Rental');
        $thisRental = $aRental->find($rentalId);
        $anItem = $this->model('Item');
        $notification = $this->model('Notification');
        $theItem =$anItem->find($thisRental->item_id);
        if($newMessage->sender_id == $theItem->user_id){
            $notification->user_id = $theItem->user_id;
        }else{
            $notification->user_id = $thisRental->user_id;
        }
        //Create notification
        $notification->content = "New message for the item rental $theItem->name #$rentalId";
        $notification->redirect = "/Rentals";
        $notification->insert();
        return $newId;
    }

    function getNewMessages(){
        $lastId = intval( $_GET['lastTimeID'] );
        $rentalId = intval($_GET['rentalID']);
        $aMessage = $this->model('Message');
        $newMessages = $aMessage->getNewMessages($lastId, $rentalId);
        echo json_encode($newMessages);
    }
}
?>