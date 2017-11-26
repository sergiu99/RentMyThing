<?php

class Rentals extends Controller{
	
	function index(){
		$aItem = $this->model('Rental');
		$userId =  $_SESSION['userID'];
		$myItems = $aItem->getMyRentals();

		$proposals = $this->model('Rental');
        $proposals = $proposals->getMyItemProposals();
        $currentlyRenting = $this->model('Rental');
        $currentlyRenting = $currentlyRenting->getMyRentingItems();

		$this->view('Rentals/index',['myRentals'=>$myItems, 'myRentalProposals'=>$proposals, 'getMyRentingItems'=>$currentlyRenting, 'this_user'=>$_SESSION['userID']]);


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
        }

        if($_POST['actionType'] == 'complete'){
        $aItem = $this->model('Rental');
        $aItem = $aItem->find($id);
        $aItem->status = 'completed';
        $aItem->update();
        }

        if($_POST['actionType'] == 'accept'){
        $aItem = $this->model('Rental');
        $aItem = $aItem->find($id);
        $aItem->status = 'accepted';
        $aItem->update();
        }

       header("location:/Rentals");
        } else {
           header("location:/Listings");
        }
    }

}
?>