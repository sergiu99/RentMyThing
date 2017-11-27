<?php 
class Notifications extends Controller
{
    function getNotifs(){
            $aItem = $this->model('Notification');
        $userId =  $_SESSION['userID'];
        $myItems = $aItem->where('user_id','=',$userId)->where('viewed','=','0')->get();
        echo json_encode($myItems);
    }


}
?>