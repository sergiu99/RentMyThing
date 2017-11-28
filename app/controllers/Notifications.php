<?php 
class Notifications extends Controller
{
    function getNotifs(){
            $aItem = $this->model('Notification');
        $userId =  $_SESSION['userID'];
        $myItems = $aItem->where('user_id','=',$userId)->where('viewed','=','0')->get();
        echo json_encode($myItems);
    }


    function deleteNotif(){
    	$id = $_POST['notifId'];
    	$redirect =  $_POST['redirect'];
		$aItem = $this->model('Notification');
		$aItem = $aItem->find($id);
		$aItem->viewed = '1';
		$aItem->update();
		header("location:" . $redirect);

    }

}
?>