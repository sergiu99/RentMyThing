<?php 
class Chat extends Controller
{
    function index(){
        $this->view('Listings/index');
    }
    function Conversation($receiver){
        $aMessage = $this->model('Message');
        $conversation = $aMessage->getMessages($_SESSION['userID'], $receiver);
        $this->view('Chat/Chat', ['conversation'=>$conversation, 'receiver'=>$receiver]);
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