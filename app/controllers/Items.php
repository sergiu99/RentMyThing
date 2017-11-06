<?php

class Items extends Controller{
	
	function index(){
		$aItem = $this->model('Item');
		$userId =  $_SESSION['userID'];
		$myItems = $aItem->where('user_id','=',$userId)->getDisplayInfo();
		$this->view('Items/index',['items'=>$myItems]);

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



}
?>