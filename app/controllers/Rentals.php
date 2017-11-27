<?php

class Rentals extends Controller{
	
	function index(){
		$aItem = $this->model('Rental');
		$userId =  $_SESSION['userID'];
		$myItems = $aItem->getMyRentals();

        $completedItems = $aItem->getMyCompletedRentals();
		$proposals = $this->model('Rental');
        $proposals = $proposals->getMyItemProposals();
        $currentlyRenting = $this->model('Rental');
        $currentlyRenting = $currentlyRenting->getMyRentingItems();

		$this->view('Rentals/index',['myRentals'=>$myItems, 'myRentalProposals'=>$proposals, 'getMyRentingItems'=>$currentlyRenting,'completedItems'=>$completedItems, 'this_user'=>$_SESSION['userID']]);


	}




    function Action(){
var_dump($_POST);

    if(isset($_POST['actionType'])){

// AUTHENTIFICATION NEEDS TO BE DONE HERE
        $id = $_POST['rentalId'];
        $userId =  $_SESSION['userID'];

        if($_POST['actionType'] == 'delete'){
        $aItem = $this->model('Rental');
        $aItem = $aItem->find($id);
        $aItem->delete();

        $newNotification = $this->model('Notification');
        $newNotification->user_id = $aItem->user_id;
        $contentt = 'Someone has declined your rental request.';
        $newNotification->content = $contentt;
        $newNotification->redirect = "/Rentals";
        $newNotification = $newNotification->insert();
        }

        if($_POST['actionType'] == 'complete'){
        $aItem = $this->model('Rental');
        $aItem = $aItem->find($id);
        $aItem->status = 'completed';
        $aItem->update();

        $newNotification = $this->model('Notification');
        $newNotification->user_id = $aItem->user_id;
        $contentt = 'One of your rentals has been completed';
        $newNotification->content = $contentt;
        $newNotification->redirect = "/Rentals";
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