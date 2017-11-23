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

    function sendMessage($message){
    }

    function getNewMessages(){
        $id = intval( $_GET['lastTimeID'] );
        $receiver = intval($_GET['receiverID']);
        $aMessage = $this->model('Message');
        $newMessages = $aMessage->getNewMessages($lastId, $_SESSION['userID'], $receiver);
        echo var_dump($newMessages);
    }
}
?>