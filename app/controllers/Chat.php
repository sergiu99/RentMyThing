<?php 
class Chat extends Controller
{
    function index(){
        $this->view('Listings/index');
    }
    function Conversation($rentalId){
        $aMessage = $this->model('Message');
        $conversation = $aMessage->getMessages($_SESSION['userID'], $rentalId);
        echo var_dump($conversation);
        $this->view('Chat/Chat', ['conversation'=>$conversation, 'this_user'=>$_SESSION['userID'], 'receiver'=>$receiver]);
    }

    function sendMessage(){
        $receiver = $_GET['receiverID'];
        $content = $_GET['content'];
        $newMessage = $this->model('Message');
        $newMessage->rental_id = $receiver;
        $newMessage->sender_id = $_SESSION['userID'];
        $newMessage->content = $content;
        $newId = $newMessage->insert();
        echo $newId;
        return $newId;
    }

    function getNewMessages(){
        $lastId = intval( $_GET['lastTimeID'] );
        $receiver = intval($_GET['receiverID']);
        $aMessage = $this->model('Message');
        $newMessages = $aMessage->getNewMessages($lastId, $_SESSION['userID'], $receiver);
        echo json_encode($newMessages);
    }
}
?>