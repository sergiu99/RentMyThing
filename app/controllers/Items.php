<?php

class Items extends Controller{
	function index(){
		$aItem = $this->model('Item');
		$myItems = $aItem->get();
		
		$this->view('Items/index',['items'=>$myItems]);

	}

	function search(){
		$searchTerm = $_GET['q'];
		$aItem = $this->model('Item');
		$myItems = $aItem->where('firstName','LIKE',"%$searchTerm%")->get();
		$this->view('Items/index',['items'=>$myItems]);

	}

	function newItem(){
		$newClient = $this->model('Item');
		$newClient->firstName = $_POST['firstName'];
		$newClient->lastName = $_POST['lastName'];
		$newClient->email = $_POST['email'];
		$newClient->phone = $_POST['phone'];
		$newClient->country = $_POST['country'];

		$newClient->insert();
		header("location:/Items/someMethod");

	}

	function delete($id){
		$aItem = $this->model('Item');
		$aItem = $aItem->find($id);
		$aItem->delete();
		header("location:/Items/someMethod");
	}



}
?>