<?php

class Profile extends Controller{
	function index(){
		$aUser = $this->model('User');
		$thisUser = $aUser->find($_SESSION['userID']);
		
		$this->view('Profile/index',['user'=>$thisUser]);
	}

	function save(){
		$updateUser = $this->model('User');
		$updateUser->display_name = $_POST['display_name'];
		$updateUser->first_name = $_POST['first_name'];
		$updateUser->last_name = $_POST['last_name'];
		$updateUser->email = $_POST['email'];
		$updateUser->phone_number = $_POST['phone_number'];
		$updateUser->street_address = $_POST['street_address'];
		$updateUser->city_address = $_POST['city_address'];
		$updateUser->province_address = $_POST['province_address'];
		$updateUser->postal_code_address = $_POST['postal_code_address'];

		$updateUser->update();

		$aUser = $this->model('User');
		$thisUser = $aUser->find($_SESSION['userID']);
		$this->view('Profile/index',['user'=>$thisUser]);
	}
}
?>