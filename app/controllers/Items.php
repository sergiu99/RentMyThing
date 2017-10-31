<?php

class Items extends Controller{
	$userId =  $_SESSION['userID'];
	function index(){
		$aItem = $this->model('Item');
		
		$myItems = $aItem->where('user_id','=',$userId)->get();
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
		
		$newItem->user_id = $userId;
		$newItem->name = $_POST['name'];
		$newItem->description = $_POST['description'];
		$newItem->image_path = $_POST['image_path'];
		$newItem->price = $_POST['price'];
		$newItem->category = $_POST['category'];

		$newItem->insert();
		header("location:/Items/someMethod");
		} else {
			$this->view('Items/createItem');
		}
	}

	function delete($id){
		$aItem = $this->model('Item');
		$aItem = $aItem->find($id);
		$aItem->delete();
		header("location:/Items/someMethod");
	}



}
?>