<?php

class Listings extends Controller{
	
	function index(){
		$aItem = $this->model('Listing');
		$myItems = $aItem->where('status','=','enabled')->getDisplayInfo();
		$aCategory = $this->model('Category');
		$categories = $aCategory->get();
		$favoritesIds = $this->getFavorites();
		$this->view('Listings/index',['items'=>$myItems, 'categories'=>$categories, 'category'=>"", 'keyword'=>"", 'type'=>"Listings", 'favorites'=>$favoritesIds]);
	}

	function search(){
		$locations = [];
		if(isset($_GET['category'])){
			$category = $_GET['category'];
		}else{
			$category = "";
		}
		if(isset($_GET['keyword'])){
			$keyword = $_GET['keyword'];
		}else{
			$keyword = "";
		}
		if(isset($_GET['locations'])){
			if($_GET['locations'] == ""){
				$locationString = null;
				$locations = null;
			}else{
				$locations = $_GET['locations'];
				$locations = explode('-', $locations);
				$locationString = $_GET['locationString'];
			}
		}else{
			$locations = null;
			$locationString = null;
		}
		$anItem = $this->model('Listing');
		$searchItems = $anItem->search($category, $keyword, $locations);
		$aCategory = $this->model('Category');
		$categories = $aCategory->get();
		$favoritesIds = $this->getFavorites();
		$this->view('Listings/index',['items'=>$searchItems, 'categories'=>$categories, 'category'=>$category, 'keyword'=>$keyword, 'location'=>$locationString, 'type'=>"Listings", 'favorites'=>$favoritesIds]);
	}
	
	function viewItem($id){
		$thisItem = $this->model('Listing');
		$thisItem = $thisItem->getItem($id)[0];
		$comments = $this->model('Comment');
		$comments = $comments->where('item_id','=',$id)->getRentalFromComment();
		if($thisItem->name !=''){
			$this->view('Listings/viewItem',['item'=>$thisItem, 'comments'=>$comments]);
		} else { header("location:/Listings");}
	}
	

	function rentItem(){
		if(isset($_POST['action'])){
			$newRental = $this->model('Rental');
		
			$userId =  $_SESSION['userID'];
			$newRental->user_id = $userId;
			$newRental->item_id = $_POST['item_id'];
			$newRental->status = "pending";
			$startDate = $_POST['start_date'];
			$endDate = $_POST['end_date'];
			$newRental->start_date = $startDate;
			$newRental->end_date = $endDate;

			$aItem = $this->model('Item');
	   		$aItem = $aItem->find($_POST['item_id']);

	    	$pricePerDay = $aItem->price;
			$date1 = date_create($startDate);
			$date2 = date_create($endDate);
			$diff = date_diff($date1,$date2);
			$datediff = $diff->format("%a");
			$total = ($datediff + 1) * $pricePerDay;
		
			$newNotification = $this->model('Notification');
			$newNotification->user_id = $aItem->user_id;
			$contentt = 'Someone wants to rent your '. $aItem->name .' item.';
			$newNotification->content = $contentt;
			$newNotification->redirect = "/Rentals";
 
			$newRental->total = $total;

			if ($endDate >= $startDate){
				$newRental = $newRental->insert();
				$newNotification = $newNotification->insert();
			}
		
			header("location:/Rentals");
		} else {
			header("location:/Listings");
		}
	}

	function getFavorites(){
		$aFavorite = $this->model('Favorite');
		$userFavorites = $aFavorite->getUserFavoritesId();
		$favoritesIds = [];
		for($item = 0; $item < sizeOf($userFavorites); $item++){
			$favoritesIds[$item] = $userFavorites[$item]->item_id;
		}
		return $favoritesIds;
	}
	
	function checkDates(){
        $startDate = $_GET['start'];
        $endDate = $_GET['end'];
        $itemId = $_GET['item'];
        $date1 = date_create($startDate);
		$date2 = date_create($endDate);
		$aRental = $this->model('Rental');
		$existingRentals = $aRental->checkDates($itemId , $startDate, $endDate);
		echo json_encode($existingRentals);
	}


/*public function getDisplayInfo(){
		$select	= "SELECT t1.id, t1.user_id, t1.name, t1.description, t1.image_path, t1.price, t2.name as category, t1.rating, t1.status FROM item t1 INNER JOIN category t2 ON t1.category = t2.id $this->_whereClause $this->_orderBy";

        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
        return $returnVal;
    }*/

}
?>