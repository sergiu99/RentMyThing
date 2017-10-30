<?php

class Clients extends Controller{
	function index(){
		$aClient = $this->model('Client');
		$myClients = $aClient->get();
		
		$this->view('Clients/index',['clients'=>$myClients]);

	}

	function search(){
		$searchTerm = $_GET['q'];
		$aClient = $this->model('Client');
		$myClients = $aClient->where('firstName','LIKE',"%$searchTerm%")->get();
		$this->view('Clients/index',['clients'=>$myClients]);

	}

	function newClient(){
		$newClient = $this->model('Client');
		$newClient->firstName = $_POST['firstName'];
		$newClient->lastName = $_POST['lastName'];
		$newClient->email = $_POST['email'];
		$newClient->phone = $_POST['phone'];
		$newClient->country = $_POST['country'];

		$newClient->insert();
		header("location:/Clients/someMethod");

	}

	function delete($id){
		$aClient = $this->model('Client');
		$aClient = $aClient->find($id);
		$aClient->delete();
		header("location:/Clients/someMethod");
	}



}
?>