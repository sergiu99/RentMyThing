<?php 
class Chat extends Controller
{
    //Redirects to the /Rentals page, theres no dedicated chat page
    function index(){
        header("location:/Rentals");
    }

    //Sends a message using the data from a POST ajax request
    function sendMessage(){
        $rentalId = $_GET['rentalID'];
        $content = $_GET['content'];

        //Create and insert a new message
        $newMessage = $this->model('Message');
        $newMessage->rental_id = $rentalId;
        $newMessage->sender_id = $_SESSION['userID'];
        $newMessage->content = $content;
        $newId = $newMessage->insert();

        //Get the corresponding rental and rental item
        $aRental = $this->model('Rental');
        $thisRental = $aRental->find($rentalId);
        $anItem = $this->model('Item');

        //Create a new notification object
        $notification = $this->model('Notification');
        $theItem = $anItem->find($thisRental->item_id);

        //Set the appropriate sender notification receiver's id (the logged in user is always the sender)
        if($newMessage->sender_id == $theItem->user_id){
            $notification->user_id = $thisRental->user_id;
        }else{
            $notification->user_id = $theItem->user_id;
        }
        $notification->content = "New message for the item rental $theItem->name";
        $notification->redirect = "/Rentals?chat=$rentalId";

        //Disable previously unviewed notifications for the same chat conversation
        $notification->viewChatNotifs($rentalId, $notification->user_id);
        
        //Insert the notification
        $notification->insert();

        return $newId; //Return the id of the newest message as the lastId
    }

    //Gets messages created after the last update after an ajax request
    function getNewMessages(){
        $lastId = intval( $_GET['lastTimeID'] ); //The id of the last viewed message
        $rentalId = intval($_GET['rentalID']);
        $aMessage = $this->model('Message');
        $newMessages = $aMessage->getNewMessages($lastId, $rentalId);
        echo json_encode($newMessages); //Returns unviewed messages as the ajax response
    }
}
?>