<?php

class Listings extends Controller{
	
	function index(){
		$aItem = $this->model('Listing');
		$myItems = $aItem->where('status','=','enabled')->getDisplayInfo();
		$aCategory = $this->model('Category');
		$categories = $aCategory->get();
		
		$this->view('Listings/index',['items'=>$myItems, 'categories'=>$categories, 'category'=>"", 'keyword'=>"", 'type'=>"Listings"]);
	}

	function search(){
		if(isset($_POST['category'])){
			$category = $_POST['category'];
		}else{
			$category = "";
		}
		if(isset($_POST['keyword'])){
			$keyword = $_POST['keyword'];
		}else{
			$keyword = "";
		}
		$anItem = $this->model('Listing');
		$searchItems = $anItem->search($category, $keyword);
		$aCategory = $this->model('Category');
		$categories = $aCategory->get();
		$this->view('Listings/index',['items'=>$searchItems, 'categories'=>$categories, 'category'=>$category, 'keyword'=>$keyword, 'type'=>"Listings"]);
	}

	
	function viewItem($id){
		$aItem = $this->model('Item');
		$aItem = $aItem->find($id);
		if($aItem->name !=''){
		$this->view('Listings/viewItem',['item'=>$aItem]);
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


		$newRental->total = $total;

		if ($total > 0){
		$newRental = $newRental->insert();
		}
		
		header("location:/Rentals");
		} else {
			header("location:/Listings");
		}
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