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

    function getNewMessages($lastId){
        $aMessage = $this->model('Message');
<<<<<<< HEAD
        $newMessages = $aMessage->getNewMessages($lastId, $_SESSION['userID'], $receiver);
=======
        $newMessages = $aMessage->getMessages($lastId, $_SESSION['userID'], $receiver);
>>>>>>> 60515836c00f526af2e68dd8de565b5ce6800fe8
    }
}
?>