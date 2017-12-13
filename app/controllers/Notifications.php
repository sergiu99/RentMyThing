<?php 
class Notifications extends Controller
{
    //Get a user's unviewed notifications
    function getNotifs($lastId){
        $aItem = $this->model('Notification');
        $userId =  $_SESSION['userID'];
        $myItems = $aItem->where('id', '>', $lastId)->where('user_id','=',$userId)->where('viewed','=','0')->get();
        echo json_encode($myItems);
    }

    //Set a notification's status to viewed once the user has clicked on it
    function deleteNotif(){
    	$id = $_POST['notifId'];
    	$redirect =  $_POST['redirect'];
		$aItem = $this->model('Notification');
		$aItem = $aItem->find($id);
		$aItem->viewed = '1';
		$aItem->update();
		header("location:" . $redirect);
    }

    //View all of a user's notifications (when the user clears notifications)
    function clearNotifs(){
        $aNotification = $this->model('Notification');
		$aNotification->clearNotifications();
    }
}
?>