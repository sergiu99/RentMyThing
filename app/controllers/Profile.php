<?php

class Profile extends Controller{
	function index(){
		$aUser = $this->model('User');
		$thisUser = $aUser->find($_SESSION['userID']);
		
		$this->view('Profile/index',['user'=>$thisUser]);
	}

	function save(){
		$updateUser = $this->model('User');
		$updateUser->id = $_SESSION['userID'];
		$updateUser->display_name = $_POST['display_name'];
		$updateUser->first_name = $_POST['first_name'];
		$updateUser->last_name = $_POST['last_name'];
		$updateUser->email = $_POST['email'];
		$updateUser->phone_number = $_POST['phone_number'];
		$updateUser->street_address = $_POST['street_address'];
		$updateUser->city_address = $_POST['city_address'];
		$updateUser->province_address = $_POST['province_address'];
		$updateUser->postal_code_address = $_POST['postal_code_address'];
		$updateUser->city_address = $_POST['city_address'];
		$updateUser->province_address = $_POST['province_address'];
		$updateUser->postal_code_address = $_POST['postal_code_address'];

		if(isset($_POST['show_phone'])){
			$updateUser->show_phone = 1;
		}else{
			$updateUser->show_phone = 0;
		}

		if(isset($_POST['show_email'])){
			$updateUser->show_email = 1;
		}else{
			$updateUser->show_email = 0;
		}

		if(isset($_POST['show_address'])){
			$updateUser->show_address = 1;
		}else{
			$updateUser->show_address = 0;
		}

		if($_POST['old_password'] != ""){
			echo "Password input";
			$aUser = $this->model('User');
			$thisUser = $aUser->find($_SESSION['userID']);
			echo var_dump(isset($thisUser));
			echo $thisUser->password;
			if(password_verify($_POST['old_password'], $password_hash)){
				echo ("correct pass");
			}
		}

		$updateUser->update();

		$this->index();
	}
}
?>