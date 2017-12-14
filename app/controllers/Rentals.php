<?php

class Rentals extends Controller{
    //Get and show a user's rentals
	function index(){
		/*$aItem = $this->model('Rental');
		$userId =  $_SESSION['userID'];
        $myItems = $aItem->getMyRentals();
        //Load a rental chat if the parameter is set
        if(isset($_GET['chat'])){
            $chat = $_GET['chat'];
        }else{
            $chat = "";
        }
        $completedItems = $aItem->getMyCompletedRentals(); //Get completed rentals
		$proposals = $this->model('Rental');
        $proposals = $proposals->getMyItemProposals(); //Get rental proposals
        $currentlyRenting = $this->model('Rental');
        $currentlyRenting = $currentlyRenting->getMyRentingItems(); //Get current rentals
        $commentedRentals = $this->model('Comment');
        $commentedRentals = $commentedRentals->getCommented($userId); //Get rentals the user has commented
        $commentedIds = [];
        foreach($commentedRentals as $comment){
            $commentedIds[] = $comment->rental_id;
        }
		$this->view('Rentals/index',['myRentals'=>$myItems, 'myRentalProposals'=>$proposals, 'getMyRentingItems'=>$currentlyRenting,'completedItems'=>$completedItems, 'this_user'=>$_SESSION['userID'], 'chat'=>$chat, 'commented'=>$commentedIds]);*/
        //Load a rental chat if the parameter is set
        if(isset($_GET['chat'])){
            $_SESSION['chat'] = $_GET['chat'];
        }else{
            $_SESSION['chat'] = "";
        }
        header("location:/Rentals/tab/main");
    }

    function tab($tab){
        $aItem = $this->model('Rental');
		$userId =  $_SESSION['userID'];
        $myItems = $aItem->getMyRentals();
        $completedItems = $aItem->getMyCompletedRentals(); //Get completed rentals
		$proposals = $this->model('Rental');
        $proposals = $proposals->getMyItemProposals(); //Get rental proposals
        $currentlyRenting = $this->model('Rental');
        $currentlyRenting = $currentlyRenting->getMyRentingItems(); //Get current rentals
        $commentedRentals = $this->model('Comment');
        $commentedRentals = $commentedRentals->getCommented($userId); //Get rentals the user has commented
        $commentedIds = [];
        foreach($commentedRentals as $comment){
            $commentedIds[] = $comment->rental_id;
        }
		$this->view('Rentals/index',['myRentals'=>$myItems, 'myRentalProposals'=>$proposals, 'getMyRentingItems'=>$currentlyRenting,'completedItems'=>$completedItems, 'this_user'=>$_SESSION['userID'], 'chat'=>$_SESSION['chat'], 'commented'=>$commentedIds, 'tab'=>$tab]);
    }
    
    //Create and insert a rental comment and rating
    function createComment(){
        if(isset($_POST['rentalId']) && isset($_POST['content']) && isset($_POST['rating'])){
            $userId =  $_SESSION['userID'];
            $newComment = $this->model('Comment');
            $newComment->rental_id = $_POST['rentalId'];
            $newComment->content = $_POST['content'];
            $newComment->rating = $_POST['rating'];
            $newComment->poster_status = $userId;
            $newId = $newComment->insert();
            $newComment->updateRating($newComment->rental_id); //Update the item rating average
            header("location:/Rentals");
        } else if(isset($_POST['rentalId'])){ 
            //Load the rating form
            $aItem = $this->model('Rental');
            $aItem = $aItem->find($_POST['rentalId']);
            $this->view('Rentals/commentForm',['RentalObject'=>$aItem]);
        } else {
            header("location:/Rentals");
        }
    }

    //Process an action on the rentals page
    function Action(){

        if(isset($_POST['actionType'])){
            $id = $_POST['rentalId'];
            $userId =  $_SESSION['userID'];

            //A rental proposal was declined
            if($_POST['actionType'] == 'delete'){
                $aRental = $this->model('Rental');
                $aRental = $aRental->find($id);
                $aRental->status = 'declined';
                $aRental->update();   

                
                $newNotification = $this->model('Notification');
                $newNotification->user_id = $aRental->user_id;
                $newNotification->redirect = "/Rentals";
                $contentt = 'Someone has declined your rental request.';
                $newNotification->content = $contentt;
                $newNotification = $newNotification->insert();
            }

            //A rental was marked as complete
            if($_POST['actionType'] == 'complete'){
                $aRental = $this->model('Rental');
                $aRental = $aRental->find($id);
                $statuss = $aRental->status;
                $newNotification = $this->model('Notification');
                if($aRental->user_id == $userId){
                    $anItem = $this->model('Item');
                    $anItem = $anItem->find($aRental->item_id);
                    $newNotification->user_id = $anItem->user_id;
                    $newNotification->redirect = "/Rentals/tab/owned";
                }else{
                    $newNotification->user_id = $aRental->user_id;
                    $newNotification->redirect = "/Rentals";
                }

                //Set the notification and rental status
                if($statuss == 'pending'){
                    $aRental->status = 'cancelled';
                    $contentt = 'One of your rentals has been terminated before starting';
                    $newNotification->content = $contentt;
                } else if($statuss == 'accepted'){
                    $userId =  $_SESSION['userID'];
                    $aRental->status = 'reqcompleted' . $userId;
                    $contentt = 'One of your rentals needs your approval to be completed';
                    $newNotification->content = $contentt;
                } else {
                    $aRental->status = 'completed';
                    $contentt = 'One of your rentals has been completed';
                    $newNotification->redirect = "/Rentals/tab/completed";
                    $newNotification->content = $contentt;
                }

                $aRental->update(); //Update the rental status
        
                $newNotification = $newNotification->insert();
            }

            //A rental proposal was accepted
            if($_POST['actionType'] == 'accept'){
                $aRental = $this->model('Rental');
                $aRental = $aRental->find($id);
                $aRental->status = 'accepted';
                $aRental->update();   

                $newNotification = $this->model('Notification');
                $newNotification->user_id = $aRental->user_id;
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