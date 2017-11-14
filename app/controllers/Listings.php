<?php

class Listings extends Controller{
	
	function index(){
		$aItem = $this->model('Listing');
		$myItems = $aItem->where('status','=','enabled')->getDisplayInfo();
		$category = $this->model('Category');
		    $category = $category->get();
		
		$this->view('Listings/index',['items'=>$myItems, 'category'=>$category ]);

	}

	function search(){
		$searchTerm = $_GET['q'];
		$aItem = $this->model('Item');
		$myItems = $aItem->where('firstName','LIKE',"%$searchTerm%")->get();
		
		
			
		$this->view('Items/index',['items'=>$myItems]);

	}

	
	function newItem(){
		if(isset($_POST['action'])){
		$newItem = $this->model('Item');
		
		$userId =  $_SESSION['userID'];
		
		$newItem->user_id = $userId;
		$newItem->status = 'enabled';
		$newItem->name = $_POST['name'];
		$newItem->description = $_POST['description'];
		$newItem->image_path = $_POST['image_path'];
		$newItem->price = $_POST['price'];
		$newItem->category = $_POST['category'];

		$newItem->insert();
		header("location:/Items");
		} else {
			
			$category = $this->model('Category');
		    $category = $category->get();
			
			
			$this->view('Items/createItem',['category'=>$category ]);
		}
	}

	function viewItem($id){
		$aItem = $this->model('Item');
		$aItem = $aItem->find($id);
		if($aItem->name !=''){
		$this->view('Listings/viewItem',['item'=>$aItem]);
		} else { header("location:/Listings");}

	}
	

	function editItem($id){
		if(isset($_POST['action'])){
		$newItem = $this->model('Item');
		
		$userId =  $_SESSION['userID'];
		$newItem = $newItem->find($id);
		$newItem->user_id = $userId;
		$newItem->status = 'enabled';
		$newItem->name = $_POST['name'];
		$newItem->description = $_POST['description'];
		$newItem->image_path = $_POST['image_path'];
		$newItem->price = $_POST['price'];
		$newItem->category = $_POST['category'];

		$newItem->update();
		header("location:/Items");
		} else {
			$aItem = $this->model('Item');
		    $aItem = $aItem->find($id);
			
			$category = $this->model('Category');
		    $category = $category->get();
			
			$this->view('Items/editItem',['item'=>$aItem, 'category'=>$category ]);
		}
	}
	
	function delete($id){
		$aItem = $this->model('Item');
		$aItem = $aItem->find($id);
		$aItem->delete();
		header("location:/Items");
	}



public function getDisplayInfo(){
		$select	= "SELECT t1.id, t1.user_id, t1.name, t1.description, t1.image_path, t1.price, t2.name as category, t1.rating, t1.status FROM item t1 INNER JOIN category t2 ON t1.category = t2.id $this->_whereClause $this->_orderBy";

        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
        return $returnVal;
    }

}
?>