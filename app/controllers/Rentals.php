<?php

class Rentals extends Controller{
	
	function index(){
		$aItem = $this->model('Rental');
		$userId =  $_SESSION['userID'];
		$myItems = $aItem->getMyRentals();
        if(isset($_GET['chat'])){
            $chat = $_GET['chat'];
        }else{
            $chat = "";
        }
        $completedItems = $aItem->getMyCompletedRentals();
		$proposals = $this->model('Rental');
        $proposals = $proposals->getMyItemProposals();
        $currentlyRenting = $this->model('Rental');
        $currentlyRenting = $currentlyRenting->getMyRentingItems();

		$this->view('Rentals/index',['myRentals'=>$myItems, 'myRentalProposals'=>$proposals, 'getMyRentingItems'=>$currentlyRenting,'completedItems'=>$completedItems, 'this_user'=>$_SESSION['userID'], 'chat'=>$chat]);
    }
    
    function createComment(){
        if(isset($_POST['rentalId']) && isset($_POST['content']) && isset($_POST['rating'])){

        $userId =  $_SESSION['userID'];
        $newItem = $this->model('Comment');

        $newItem->rental_id = $_POST['rentalId'];
        $newItem->content = $_POST['content'];
        $newItem->rating = $_POST['rating'];
        $newItem->poster_status = $userId;
        $newId = $newItem->insert();
        header("location:/Rentals");

        } 
        else if(isset($_POST['rentalId']))
        { 
        $aItem = $this->model('Rental');
        $aItem = $aItem->find($_POST['rentalId']);
                $this->view('Rentals/commentForm',['RentalObject'=>$aItem]);

        } else {
            var_dump($_POST);
             //header("location:/Rentals");
        }
    }


    function Action(){
    var_dump($_POST);

    if(isset($_POST['actionType'])){
        $id = $_POST['rentalId'];
        $userId =  $_SESSION['userID'];

        if($_POST['actionType'] == 'delete'){
            $aItem = $this->model('Rental');
            $aItem = $aItem->find($id);
            $aItem->status = 'declined';
            $aItem->update();   

            $newNotification = $this->model('Notification');
            $newNotification->user_id = $aItem->user_id;
            $newNotification->redirect = "/Rentals";
            $contentt = 'Someone has declined your rental request.';
            $newNotification->content = $contentt;
            $newNotification = $newNotification->insert();
        }


        if($_POST['actionType'] == 'complete'){
            $aItem = $this->model('Rental');
            $aItem = $aItem->find($id);
            $statuss = $aItem->status;
            $newNotification = $this->model('Notification');
            $newNotification->user_id = $aItem->user_id;
            $newNotification->redirect = "/Rentals";

            if($statuss == 'pending'){
                $aItem->status = 'cancelled';
                $contentt = 'One of your rentals has been terminated before starting';
                $newNotification->content = $contentt;

            } else if($statuss == 'accepted'){
                $userId =  $_SESSION['userID'];
                $aItem->status = 'reqcompleted' . $userId;
                $contentt = 'One of your rentals needs your approval to be completed';
                $newNotification->content = $contentt;

            } else {
                $aItem->status = 'completed';
                $contentt = 'One of your rentals has been completed';
                $newNotification->content = $contentt;
            }
        
            if($statuss != 'pending'){
                // Send request to rental requester for comment
            }

            $aItem->update();
        
            $newNotification = $newNotification->insert();
        }

        if($_POST['actionType'] == 'accept'){
            $aItem = $this->model('Rental');
            $aItem = $aItem->find($id);
            $aItem->status = 'accepted';
            $aItem->update();   

            $newNotification = $this->model('Notification');
            $newNotification->user_id = $aItem->user_id;
            $contentt = 'Someone has accepted your rental request.';
            $newNotification->content = $contentt;
            $newNotification->redirect = "/Rentals";
            $newNotification = $newNotification->insert();
        }

        header("location:/Rentals");
        } else {
           header("location:/Listings");
        }
    }
}
?>