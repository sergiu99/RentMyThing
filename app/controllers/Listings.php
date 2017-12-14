<?php

class Listings extends Controller{
	
	//Display all publicly available listings
	function index(){
		$aItem = $this->model('Item');
		$myItems = $aItem->where('status','=','enabled')->getDisplayInfo(); //get the listing details
		$aCategory = $this->model('Category');
		$categories = $aCategory->get();
		$favoritesIds = $this->getFavorites();
		//Set the search parameters to empty
		$this->view('Listings/index',['items'=>$myItems, 'categories'=>$categories, 'category'=>"", 'keyword'=>"", 'type'=>"Listings", 'favorites'=>$favoritesIds]);
	}

	//Search for a 
	function search(){
		//Set the category parameter
		if(isset($_GET['category']) && $_GET['category'] != "All"){
			$category = $_GET['category'];
		}else{
			$category = "";
		}
		//Set the keyword parameter
		if(isset($_GET['keyword'])){
			$keyword = $_GET['keyword'];
		}else{
			$keyword = "";
		}

		//Set the location parameter
		if(isset($_GET['locations'])){
			if($_GET['locations'] == ""){
				$locationString = null;
				$locations = null;
			}else{
				$locations = $_GET['locations'];
				$locations = explode('-', $locations); //Retrieve the individual postal codes and populate the array
				$locationString = $_GET['locationString'];
			}
		}else{
			$locations = null;
			$locationString = null;
		}

		$anItem = $this->model('Item');
		$searchItems = $anItem->search($category, $keyword, $locations); //Get the matching items
		$aCategory = $this->model('Category');
		$categories = $aCategory->get();
		$favoritesIds = $this->getFavorites(); //Get the user favorites
		$this->view('Listings/index',['items'=>$searchItems, 'categories'=>$categories, 'category'=>$category, 'keyword'=>$keyword, 'location'=>$locationString, 'type'=>"Listings", 'favorites'=>$favoritesIds]);
	}
	
	//Get and view an item's details
	function viewItem($id){
		$thisItem = $this->model('Item');
		$thisItem = $thisItem->getItem($id)[0];
		if($thisItem->name !='' && $thisItem->status = "enabled"){
			if($thisItem->user_id == $_SESSION['userID']){
				//If the user owns the item
				header("location:/Items/editItem/$thisItem->id");
			}else{
				$comments = $this->model('Comment');
				$comments = $comments->where('item_id','=',$id)->getRentalFromComment(); //Get comments made on an item
				$this->view('Listings/viewItem',['item'=>$thisItem, 'comments'=>$comments]);
			}
		} else { header("location:/Listings");}
	}
	
	//Create and insert a new rental proposal
	function rentItem(){
		if(isset($_POST['action'])){
			$newRental = $this->model('Rental');
		
			//Set the rental information
			$userId =  $_SESSION['userID'];
			$newRental->user_id = $userId;
			$newRental->item_id = $_POST['item_id'];
			$newRental->status = "pending";
			$startDate = $_POST['start_date'];
			$endDate = $_POST['end_date'];
			$newRental->start_date = $startDate;
			$newRental->end_date = $endDate;

			//Get the rental item
			$aItem = $this->model('Item');
	   		$aItem = $aItem->find($_POST['item_id']);

			//Calculate and set a rental total
	    	$pricePerDay = $aItem->price;
			$date1 = date_create($startDate);
			$date2 = date_create($endDate);
			$diff = date_diff($date1,$date2);
			$datediff = $diff->format("%a");
			$total = ($datediff + 1) * $pricePerDay;
		
			//Create a notification for the item owner
			$newNotification = $this->model('Notification');
			$newNotification->user_id = $aItem->user_id;
			$content = 'Someone wants to rent your '. $aItem->name .' item.';
			$newNotification->content = $content;
			$newNotification->redirect = "/Rentals/tab/proposals";
 
			$newRental->total = $total;

			//Verify that the rental parameters are valid
			if ($endDate >= $startDate){
				$newRental = $newRental->insert();
				$newNotification = $newNotification->insert();
			}
		
			header("location:/Rentals");
		} else {
			header("location:/Listings");
		}
	}

	//Get a user's favorites in an array
	function getFavorites(){
		$aFavorite = $this->model('Favorite');
		$userFavorites = $aFavorite->getUserFavoritesId();
		$favoritesIds = [];
		for($item = 0; $item < sizeOf($userFavorites); $item++){
			$favoritesIds[$item] = $userFavorites[$item]->item_id;
		}
		return $favoritesIds;
	}
	
	//Check that a rental's start and end dates are valid
	function checkDates(){
        $startDate = $_GET['start'];
        $endDate = $_GET['end'];
        $itemId = $_GET['item'];
        $date1 = date_create($startDate);
		$date2 = date_create($endDate);
		$aRental = $this->model('Rental');
		$existingRentals = $aRental->checkDates($itemId , $startDate, $endDate);
		echo json_encode($existingRentals); //return the number of existing rentals for the item in the specified date range
	}
}
?>