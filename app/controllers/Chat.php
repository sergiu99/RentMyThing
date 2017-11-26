<?php 
class Chat extends Controller
{
    function index($rentalId){
        $aMessage = $this->model('Message');
        $conversation = $aMessage->getMessages($rentalId);
        echo json_encode($conversation);
    }

    function sendMessage(){
        $rentalId = $_POST['rentalID'];
        $content = $_POST['content'];
        $newMessage = $this->model('Message');
        $newMessage->rental_id = $rentalId;
        $newMessage->sender_id = $_SESSION['userID'];
        $newMessage->content = $content;
        $newId = $newMessage->insert();
        echo $newId;
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