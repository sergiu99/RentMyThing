<?php 
class Chat
{
    public getConversation($receiver){
        $aMessage = $this->model('Message');
        $conversation = $aMessage->getMessages($_SESSION['userID'], $receiver);
        return $conversation;
    }
}
?>